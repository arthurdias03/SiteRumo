<?php
// Configurações de segurança
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_samesite', 'Strict');

session_start();

// Função para validar sessão
function validarSessao() {
    // Verificar se está logado
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: login.php');
        exit;
    }
    
    // Verificar timeout de sessão (30 minutos)
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        session_unset();
        session_destroy();
        header('Location: login.php?timeout=1');
        exit;
    }
    
    // Verificar mudança de User Agent (possível hijacking)
    if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
        session_unset();
        session_destroy();
        header('Location: login.php?security=1');
        exit;
    }
    
    // Verificar mudança de IP (opcional, pode causar problemas com proxies)
    /*
    if (isset($_SESSION['ip_address']) && $_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR']) {
        session_unset();
        session_destroy();
        header('Location: login.php?security=1');
        exit;
    }
    */
    
    // Atualizar última atividade
    $_SESSION['last_activity'] = time();
    
    // Regenerar ID da sessão periodicamente (a cada 5 minutos)
    if (!isset($_SESSION['last_regeneration']) || (time() - $_SESSION['last_regeneration'] > 300)) {
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}

// Validar sessão
validarSessao();

// Incluir configuração do banco (com tratamento de erro)
try {
    include 'config.php';
} catch (Exception $e) {
    error_log("Erro de conexão com banco: " . $e->getMessage());
    die("Erro interno do servidor. Tente novamente mais tarde.");
}

// Gerar token CSRF se não existir
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$success = '';
$error = '';
$warning = '';

// Função para sanitizar entrada
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Função para validar arquivo
function validarArquivo($arquivo) {
    $errors = [];
    
    // Verificar se arquivo foi enviado
    if ($arquivo['error'] !== UPLOAD_ERR_OK) {
        switch ($arquivo['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $errors[] = "Arquivo muito grande.";
                break;
            case UPLOAD_ERR_PARTIAL:
                $errors[] = "Upload incompleto.";
                break;
            case UPLOAD_ERR_NO_FILE:
                $errors[] = "Nenhum arquivo selecionado.";
                break;
            default:
                $errors[] = "Erro no upload.";
        }
        return $errors;
    }
    
    // Verificar tamanho (máximo 10MB)
    if ($arquivo['size'] > 10 * 1024 * 1024) {
        $errors[] = "Arquivo deve ter no máximo 10MB.";
    }
    
    // Verificar tipo MIME
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $arquivo['tmp_name']);
    finfo_close($finfo);
    
    if ($mimeType !== 'application/pdf') {
        $errors[] = "Apenas arquivos PDF são permitidos.";
    }
    
    // Verificar extensão
    $extension = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    if ($extension !== 'pdf') {
        $errors[] = "Extensão de arquivo inválida.";
    }
    
    // Verificar conteúdo do arquivo (assinatura PDF)
    $handle = fopen($arquivo['tmp_name'], 'r');
    $header = fread($handle, 4);
    fclose($handle);
    
    if ($header !== '%PDF') {
        $errors[] = "Arquivo não é um PDF válido.";
    }
    
    return $errors;
}

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = 'Token de segurança inválido. Recarregue a página e tente novamente.';
    } else {
        // Sanitizar entradas
        $titulo = sanitizeInput($_POST['titulo']);
        $descricao = sanitizeInput($_POST['descricao']);
        $categoria = sanitizeInput($_POST['categoria']);
        $ano = (int)$_POST['ano'];
        $autor = isset($_POST['novo_autor']) && !empty($_POST['novo_autor']) 
                ? sanitizeInput($_POST['novo_autor']) 
                : sanitizeInput($_POST['autor']);
        $periodo = sanitizeInput($_POST['periodo']);
        $link = filter_var($_POST['link'], FILTER_VALIDATE_URL);
        
        // Validações básicas
        if (empty($titulo) || empty($descricao) || empty($categoria) || empty($autor)) {
            $error = 'Todos os campos obrigatórios devem ser preenchidos.';
        } elseif ($ano < 2000 || $ano > date('Y')) {
            $error = 'Ano inválido.';
        } elseif (!in_array($categoria, ['Teses', 'Dissertacoes', 'Artigos'])) {
            $error = 'Categoria inválida.';
        } elseif ($categoria === 'Artigos' && empty($periodo)) {
            $error = 'Período é obrigatório para artigos.';
        } elseif (!empty($_POST['link']) && !$link) {
            $error = 'URL inválida.';
        } else {
            $arquivo = $_FILES['arquivo'];
            $temArquivo = !empty($arquivo['name']);
            $temLink = !empty($link);
            
            // Verificar se tem arquivo OU link
            if (!$temArquivo && !$temLink) {
                $error = 'Forneça um arquivo PDF ou um link válido.';
            } elseif ($temArquivo && $temLink) {
                $error = 'Forneça apenas um arquivo OU um link, não ambos.';
            } else {
                $uploadErrors = [];
                $caminhoArquivo = '';
                $nomeArquivo = '';
                
                if ($temArquivo) {
                    // Validar arquivo
                    $uploadErrors = validarArquivo($arquivo);
                    
                    if (empty($uploadErrors)) {
                        // Gerar nome único para o arquivo
                        $nomeArquivo = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $arquivo['name']);
                        $diretorio = 'uploads/' . $categoria . '/' . $ano . '/';
                        $caminhoArquivo = $diretorio . $nomeArquivo;
                        
                        // Criar diretórios se não existirem
                        if (!is_dir($diretorio)) {
                            if (!mkdir($diretorio, 0755, true)) {
                                $uploadErrors[] = "Erro ao criar diretório.";
                            }
                        }
                    }
                }
                
                if (!empty($uploadErrors)) {
                    $error = implode(' ', $uploadErrors);
                } else {
                    // Preparar query com prepared statement
                    if ($temLink) {
                        $stmt = $conn->prepare("INSERT INTO arquivos (titulo, nome_arquivo, descricao, caminho_arquivo, categoria, ano, autor, periodo, link, data_upload) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                        $stmt->bind_param("sssssssss", $titulo, $link, $descricao, $link, $categoria, $ano, $autor, $periodo, $link);
                    } else {
                        $stmt = $conn->prepare("INSERT INTO arquivos (titulo, nome_arquivo, descricao, caminho_arquivo, categoria, ano, autor, periodo, data_upload) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                        $stmt->bind_param("ssssssss", $titulo, $nomeArquivo, $descricao, $caminhoArquivo, $categoria, $ano, $autor, $periodo);
                    }
                    
                    if ($stmt->execute()) {
                        if ($temArquivo) {
                            // Mover arquivo
                            if (move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo)) {
                                // Definir permissões seguras
                                chmod($caminhoArquivo, 0644);
                                $success = 'Arquivo enviado com sucesso!';
                                
                                // Log de segurança
                                error_log("Upload realizado por " . $_SESSION['username'] . " - Arquivo: $nomeArquivo em " . date('Y-m-d H:i:s'));
                            } else {
                                $error = 'Erro ao salvar arquivo no servidor.';
                                // Remover entrada do banco se falhou o upload
                                $conn->query("DELETE FROM arquivos WHERE id = " . $conn->insert_id);
                            }
                        } else {
                            $success = 'Link adicionado com sucesso!';
                            
                            // Log de segurança
                            error_log("Link adicionado por " . $_SESSION['username'] . " - URL: $link em " . date('Y-m-d H:i:s'));
                        }
                        
                        // Regenerar token CSRF após sucesso
                        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    } else {
                        $error = 'Erro ao salvar no banco de dados: ' . $stmt->error;
                    }
                    
                    $stmt->close();
                }
            }
        }
    }
}

// Obter autores existentes com prepared statement
$autores = [];
$stmt = $conn->prepare("SELECT DISTINCT autor FROM arquivos ORDER BY autor");
if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $autores[] = $row['autor'];
    }
}
$stmt->close();
?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo PDF</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #f8f9fa;
            --accent-color: #17a2b8;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --text-dark: #333;
            --border-color: #dee2e6;
            --shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }

        .admin-header {
            background: linear-gradient(135deg, var(--primary-color), #1e4080);
            color: white;
            padding: 1rem 0;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .admin-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.9rem;
        }

        .session-timer {
            background: rgba(255,255,255,0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .main-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
            margin-bottom: 15rem;
        }

        .upload-card {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .card-header {
            background: linear-gradient(135deg, var(--secondary-color), #e9ecef);
            padding: 1.5rem;
            border-bottom: 2px solid var(--border-color);
        }

        .card-title {
            color: var(--primary-color);
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .required {
            color: var(--danger-color);
        }

        .form-control, .form-select {
            border: 2px solid var(--border-color);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--secondary-color);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.25);
            background: white;
        }

        .input-group-text {
            background: var(--secondary-color);
            border: 2px solid var(--border-color);
            border-right: none;
            border-radius: 12px 0 0 12px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), #1e4080);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(44, 90, 160, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger-color), #c82333);
            border: none;
            border-radius: 12px;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
        }

        .file-upload-area {
            border: 2px dashed var(--border-color);
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            background: var(--secondary-color);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload-area:hover {
            border-color: var(--primary-color);
            background: rgba(44, 90, 160, 0.05);
        }

        .file-upload-area.dragover {
            border-color: var(--accent-color);
            background: rgba(23, 162, 184, 0.1);
        }

        .upload-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .security-info {
            background: linear-gradient(135deg, rgba(44, 90, 160, 0.1), rgba(23, 162, 184, 0.1));
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1rem;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .security-features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .security-badge {
            background: rgba(44, 90, 160, 0.1);
            color: var(--primary-color);
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .form-switch {
            margin-bottom: 1rem;
        }

        .switch-label {
            font-weight: 500;
            margin-left: 0.5rem;
        }

        @media (max-width: 768px) {
            .main-container {
                margin: 1rem auto;
                padding: 0 0.5rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .admin-nav {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
    
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-body-blue" aria-label="Tenth navbar example">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08"
                aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class=" nav-link2" aria-current="page" href="Home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2 " href="Sobre.php">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" href="Equipe.php">Equipe </a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="publicacoesteste.php">Publicações</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="Aplicativos.php">Aplicativos</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="Materiais.php">Materiais</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="Contato.php">Contato</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="login.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="editpub.php">Editar</a>
                    </li>
                    <li class="nav-item">
                        <a class=" nav-link2" aria-disabled="true" href="deletepub.php">deletar</a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav>

    <!--logo site-->
    <div class="icon-menu">
        <div class="row align-items-center">
            <div class="col-auto">
                <div class="logo">
                    <img src="Img/icones/Logo_rumoPNG.png" alt="Logo" width="100" height="100"
                        class="d-inline-block align-text-top">
                </div>
            </div>
            <div class="col">
                <h2>Rumo á Educação Matemática Inclusiva</h2>
            </div>
        </div>
    </div>


    <div class="main-container">
        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($warning): ?>
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo $warning; ?>
            </div>
        <?php endif; ?>

        <div class="upload-card">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="fas fa-cloud-upload-alt"></i>
                    Upload de Publicação
                </h2>
            </div>
            
            <div class="card-body">
                <form action="upload.php" method="post" enctype="multipart/form-data" id="uploadForm">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    
                    <div class="form-group">
                        <label for="titulo" class="form-label">
                            <i class="fas fa-heading"></i>
                            Título <span class="required">*</span>
                        </label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required maxlength="255">
                    </div>
                    
                    <div class="form-group">
                        <label for="descricao" class="form-label">
                            <i class="fas fa-align-left"></i>
                            Descrição <span class="required">*</span>
                        </label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required maxlength="1000"></textarea>
                        <small class="text-muted">Máximo 1000 caracteres</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoria" class="form-label">
                                    <i class="fas fa-tags"></i>
                                    Categoria <span class="required">*</span>
                                </label>
                                <select class="form-select" id="categoria" name="categoria" required onchange="togglePeriodo()">
                                    <option value="">Selecione uma categoria</option>
                                    <option value="Teses">Teses</option>
                                    <option value="Dissertacoes">Dissertações</option>
                                    <option value="Artigos">Artigos</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ano" class="form-label">
                                    <i class="fas fa-calendar"></i>
                                    Ano <span class="required">*</span>
                                </label>
                                <select class="form-select" id="ano" name="ano" required>
                                    <?php
                                    $currentYear = date("Y");
                                    for ($year = $currentYear; $year >= 2000; $year--) {
                                        echo "<option value='$year'>$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="autor" class="form-label">
                            <i class="fas fa-user-edit"></i>
                            Autor <span class="required">*</span>
                        </label>
                        <select class="form-select" id="autor" name="autor">
                            <option value="">Selecione um autor existente</option>
                            <?php foreach ($autores as $autor): ?>
                                <option value="<?php echo htmlspecialchars($autor); ?>">
                                    <?php echo htmlspecialchars($autor); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" class="form-control mt-2" id="novo_autor" name="novo_autor" 
                               placeholder="Ou digite um novo autor" maxlength="255">
                    </div>
                    
                    <div class="form-group">
                        <label for="periodo" class="form-label">
                            <i class="fas fa-clock"></i>
                            Período
                        </label>
                        <select class="form-select" id="periodo" name="periodo" disabled>
                            <option value="">Selecione o período</option>
                            <option value="periodico">Periódico</option>
                            <option value="anuais">Anuais</option>
                        </select>
                        <small class="text-muted">Obrigatório apenas para artigos</small>
                    </div>
                    
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="uploadType" onchange="toggleUploadType()">
                        <label class="form-check-label switch-label" for="uploadType">
                            Adicionar link em vez de arquivo
                        </label>
                    </div>
                    
                    <div id="linkSection" style="display: none;">
                        <div class="form-group">
                            <label for="link" class="form-label">
                                <i class="fas fa-link"></i>
                                Link da Publicação
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-globe"></i>
                                </span>
                                <input type="url" class="form-control" id="link" name="link" 
                                       placeholder="https://exemplo.com/publicacao.pdf">
                            </div>
                        </div>
                    </div>
                    
                    <div id="fileSection">
                        <div class="form-group">
                            <label for="arquivo" class="form-label">
                                <i class="fas fa-file-pdf"></i>
                                Arquivo PDF <span class="required">*</span>
                            </label>
                            <div class="file-upload-area" onclick="document.getElementById('arquivo').click()">
                                <div class="upload-icon">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <h5>Clique para selecionar ou arraste o arquivo aqui</h5>
                                <p class="text-muted">Apenas arquivos PDF • Máximo 10MB</p>
                                <input type="file" class="form-control" id="arquivo" name="arquivo" 
                                       accept="application/pdf,.pdf" style="display: none;">
                            </div>
                            <div id="fileInfo" class="mt-2" style="display: none;"></div>
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-upload me-2"></i>
                            Enviar Publicação
                        </button>
                    </div>
                </form>
                
                
            </div>
        </div>
    </div>

    

    <footer class="navbar fixed-bottom bg-footer">
        <div class="container-fluid">
            <a class="navbar-brand" href="Home.php"><img src="Img/icones/Logo_rumoPNG.png" alt="Logo" width="70"
                    height="50" class="d-inline-block align-text-top" style="margin-left: 15px;"></a>
            <div class="d-flex">
                <a class="navbar-brand"><img src="Img/icones/logo_fapesp.png" alt="Logo" width="90" height="50"
                        class="d-inline-block align-text-top" style="margin-left: 15px;"></a>
                <a class="navbar-brand"><img src="Img/icones/CNPq_v2017_rgb.png" alt="Logo" width="90" height="40"
                        class="d-inline-block align-text-top" style="margin-left: 15px;"></a>
                <a class="navbar-brand"><img src="Img/icones/banner_capes-1024x871.png" alt="Logo" width="70"
                        height="50" class="d-inline-block align-text-top"
                        style="margin-left: 15px; object-fit: contain;"></a>
            </div>
        </div>
    </footer>


   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Timer de sessão
        let sessionTime = 1800; // 30 minutos em segundos
        
        function updateTimer() {
            const minutes = Math.floor(sessionTime / 60);
            const seconds = sessionTime % 60;
            document.getElementById('timeRemaining').textContent = 
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            if (sessionTime <= 300) { // 5 minutos restantes
                document.getElementById('sessionTimer').style.background = 'rgba(220, 53, 69, 0.8)';
            }
            
            if (sessionTime <= 0) {
                alert('Sua sessão expirou. Você será redirecionado para o login.');
                window.location.href = 'login.php?timeout=1';
                return;
            }
            
            sessionTime--;
        }
        
        setInterval(updateTimer, 1000);
        
        // Reset timer em atividade
        document.addEventListener('click', () => sessionTime = 1800);
        document.addEventListener('keypress', () => sessionTime = 1800);
        
        // Toggle entre arquivo e link
        function toggleUploadType() {
            const isLink = document.getElementById('uploadType').checked;
            const linkSection = document.getElementById('linkSection');
            const fileSection = document.getElementById('fileSection');
            const linkInput = document.getElementById('link');
            const fileInput = document.getElementById('arquivo');
            
            if (isLink) {
                linkSection.style.display = 'block';
                fileSection.style.display = 'none';
                linkInput.required = true;
                fileInput.required = false;
                fileInput.value = '';
            } else {
                linkSection.style.display = 'none';
                fileSection.style.display = 'block';
                linkInput.required = false;
                fileInput.required = true;
                linkInput.value = '';
            }
        }
        
        // Toggle período para artigos
        function togglePeriodo() {
            const categoria = document.getElementById('categoria').value;
            const periodo = document.getElementById('periodo');
            
            if (categoria === 'Artigos') {
                periodo.disabled = false;
                periodo.required = true;
            } else {
                periodo.disabled = true;
                periodo.required = false;
                periodo.value = '';
            }
        }
        
        // Gerenciar seleção de autor
        document.getElementById('novo_autor').addEventListener('input', function() {
            const autorSelect = document.getElementById('autor');
            if (this.value.trim()) {
                autorSelect.disabled = true;
                autorSelect.required = false;
                this.required = true;
            } else {
                autorSelect.disabled = false;
                autorSelect.required = true;
                this.required = false;
            }
        });
        
        document.getElementById('autor').addEventListener('change', function() {
            const novoAutor = document.getElementById('novo_autor');
            if (this.value) {
                novoAutor.disabled = true;
                novoAutor.required = false;
            } else {
                novoAutor.disabled = false;
            }
        });
        
        // Upload de arquivo com drag & drop
        const fileArea = document.querySelector('.file-upload-area');
        const fileInput = document.getElementById('arquivo');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            fileArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            fileArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight(e) {
            fileArea.classList.add('dragover');
        }
        
        function unhighlight(e) {
            fileArea.classList.remove('dragover');
        }
        
        fileArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                fileInput.files = files;
                showFileInfo(files[0]);
            }
        }
        
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                showFileInfo(this.files[0]);
            }
        });
        
        function showFileInfo(file) {
            const fileInfo = document.getElementById('fileInfo');
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            
            let statusIcon = '<i class="fas fa-check-circle text-success"></i>';
            let statusText = 'Arquivo válido';
            
            if (file.type !== 'application/pdf') {
                statusIcon = '<i class="fas fa-exclamation-triangle text-warning"></i>';
                statusText = 'Atenção: Apenas PDFs são aceitos';
            }
            
            if (file.size > 10 * 1024 * 1024) {
                statusIcon = '<i class="fas fa-times-circle text-danger"></i>';
                statusText = 'Erro: Arquivo muito grande (máx. 10MB)';
            }
            
            fileInfo.innerHTML = `
                <div class="d-flex align-items-center gap-2">
                    ${statusIcon}
                    <strong>${file.name}</strong>
                    <span class="text-muted">(${fileSize} MB)</span>
                    <span class="ms-auto">${statusText}</span>
                </div>
            `;
            fileInfo.style.display = 'block';
        }
        
        // Validação do formulário
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const isLink = document.getElementById('uploadType').checked;
            
            // Validar se tem arquivo ou link
            if (!isLink && !fileInput.files.length) {
                e.preventDefault();
                alert('Selecione um arquivo PDF para upload.');
                return;
            }
            
            if (isLink && !document.getElementById('link').value.trim()) {
                e.preventDefault();
                alert('Insira um link válido.');
                return;
            }
            
            // Validar autor
            const autor = document.getElementById('autor').value;
            const novoAutor = document.getElementById('novo_autor').value.trim();
            
            if (!autor && !novoAutor) {
                e.preventDefault();
                alert('Selecione um autor existente ou digite um novo.');
                return;
            }
            
            // Mostrar loading
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enviando...';
            submitBtn.disabled = true;
        });
        
        // Contador de caracteres para descrição
        document.getElementById('descricao').addEventListener('input', function() {
            const maxLength = 1000;
            const currentLength = this.value.length;
            const remaining = maxLength - currentLength;
            
            let counter = this.parentNode.querySelector('.char-counter');
            if (!counter) {
                counter = document.createElement('small');
                counter.className = 'char-counter text-muted';
                this.parentNode.appendChild(counter);
            }
            
            counter.textContent = `${remaining} caracteres restantes`;
            
            if (remaining < 100) {
                counter.className = 'char-counter text-warning';
            } else if (remaining < 0) {
                counter.className = 'char-counter text-danger';
            } else {
                counter.className = 'char-counter text-muted';
            }
        });
    </script>


</body>

</html>