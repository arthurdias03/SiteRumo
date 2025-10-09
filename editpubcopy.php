<?php
include 'config.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Busca autores e períodos já registrados no banco de dados
$autores = [];
$periodos = [];
$sqlAutores = "SELECT DISTINCT autor FROM arquivos";
$sqlPeriodos = "SELECT DISTINCT periodo FROM arquivos";

$resultAutores = $conn->query($sqlAutores);
if ($resultAutores->num_rows > 0) {
    while ($row = $resultAutores->fetch_assoc()) {
        $autores[] = $row['autor'];
    }
}

$resultPeriodos = $conn->query($sqlPeriodos);
if ($resultPeriodos->num_rows > 0) {
    while ($row = $resultPeriodos->fetch_assoc()) {
        $periodos[] = $row['periodo'];
    }
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM arquivos";
if ($search) {
    $search = $conn->real_escape_string($search);
    $sql .= " WHERE titulo LIKE '%$search%' 
              OR link LIKE '%$search%'
              OR descricao LIKE '%$search%' 
              OR categoria LIKE '%$search%' 
              OR ano LIKE '%$search%' 
              OR autor LIKE '%$search%' 
              OR periodo LIKE '%$search%'";
}
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id = intval($_POST['edit_id']);
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $link = $conn->real_escape_string($_POST['link']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $categoria = $conn->real_escape_string($_POST['categoria']);
    $ano = intval($_POST['ano']);
    $autor = $conn->real_escape_string($_POST['autor']);
    $periodo = $conn->real_escape_string($_POST['periodo']);

    $updateSql = "UPDATE arquivos SET 
        titulo='$titulo',
        link='$link',
        descricao='$descricao',
        categoria='$categoria',
        ano='$ano',
        autor='$autor',
        periodo='$periodo' 
        WHERE id='$id'";

    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Registro atualizado com sucesso!'); window.location.href='editpub.php';</script>";
        exit;
    } else {
        echo "<p class='alert alert-danger'>Erro ao atualizar registro: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gerenciar e editar publicações acadêmicas - Rumo à Educação Matemática Inclusiva">
    <title>Editar Publicações - Rumo à Educação Matemática Inclusiva</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #f8f9fa;
            --accent-color: #17a2b8;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --text-dark: #333;
            --border-color: #dee2e6;
            --shadow: 0 4px 15px rgba(0,0,0,0.1);
            --gradient-primary: linear-gradient(135deg, #147df5ff 0%, #133efcff 100%);
            --gradient-secondary: linear-gradient(135deg, #93ddfbff 0%, #1a56fcff 100%);
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Animações */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes shimmer {
            0% { background-position: -200px 0; }
            100% { background-position: calc(200px + 100%) 0; }
        }

        /* Header - mantido original */
      

        

        .navbar{
            padding: 1rem;

        }


        /* Main Content */
        .main-content {
            padding: 3rem 0;
            min-height: calc(100vh - 200px);
        }

        .page-header {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            animation: fadeInUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 2rem;
        }

        .page-subtitle {
            color: #6c757d;
            margin: 0.5rem 0 0 0;
            font-size: 1.1rem;
        }

        /* Search Section */
        .search-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            animation: slideInLeft 0.6s ease-out 0.2s both;
        }

        .search-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-input {
            border: 2px solid var(--border-color);
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--secondary-color);
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.25);
            background: white;
        }

        .btn-search {
            background: var(--gradient-primary);
            border: none;
            padding: 0.875rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Table Section */
        .table-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 10rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            animation: fadeInUp 0.6s ease-out 0.4s both;
        }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
        }

        .table-title {
            color: var(--primary-color);
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .table-responsive {
            border-radius: 0.75rem;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .table {
            margin: 0;
            font-size: 0.95rem;
        }

        .table thead th {
            background: var(--gradient-primary);
            color: white;
            font-weight: 600;
            border: none;
            padding: 1.25rem 1rem;
            text-align: center;
            position: relative;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: var(--border-color);
        }

        .table tbody td:first-child {
            font-weight: 600;
            color: var(--primary-color);
        }

        /* Buttons */
        .btn-edit {
            background: var(--gradient-secondary);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
            font-size: 0.875rem;
        }

        .btn-edit:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(240, 147, 251, 0.4);
        }

        .btn-edit:active {
            animation: pulse 0.6s;
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }

        .modal-header {
            background: var(--gradient-primary);
            color: white;
            border-radius: 1rem 1rem 0 0;
            padding: 1.5rem 2rem;
            border-bottom: none;
        }

        .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .btn-close {
            filter: invert(1);
            opacity: 0.8;
        }

        .modal-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-control, .form-select {
            border: 2px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.75rem;
            transition: all 0.3s ease;
            background: var(--secondary-color);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.25);
            background: white;
        }

        .btn-save {
            background: var(--gradient-primary);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Loading Animation */
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
        }

       

        /* Responsividade */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
                flex-direction: column;
                text-align: center;
            }
            
            .table-responsive {
                font-size: 0.8rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 0.75rem 0.5rem;
            }
            
            .btn-edit {
                padding: 0.375rem 0.75rem;
                font-size: 0.8rem;
            }
        }

        /* Accessibility */
        .sr-only {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }

        /* Success/Error Messages */
        .alert {
            border-radius: 0.75rem;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            animation: fadeInUp 0.6s ease-out;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
        }
    </style>
</head>
<body>
    <!-- Header - mantido original -->
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
                    <li class="nav-item">
                          <a href="logout.php" class="  btn btn-danger" style="text-decoration: none; margin-left:2rem;font-weight:500">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Page Header -->
            <section class="page-header">
                <h1 class="page-title">
                    <i class="fas fa-edit"></i>
                    Editar Publicações
                </h1>
                <p class="page-subtitle">
                    Gerencie e edite as publicações acadêmicas do projeto
                </p>
            </section>

            <!-- Search Section -->
            <section class="search-section">
                <h2 class="search-title">
                    <i class="fas fa-search"></i>
                    Buscar Publicações
                </h2>
                <form method="get" role="search" aria-label="Buscar publicações">
                    <div class="input-group">
                        <input type="text" class="form-control search-input" name="search" 
                               placeholder="Digite título, autor, categoria ou qualquer termo..." 
                               value="<?php echo htmlspecialchars($search); ?>"
                               aria-label="Campo de busca">
                        <button class="btn btn-search" type="submit">
                            <i class="fas fa-search me-2"></i>
                            Buscar
                        </button>
                    </div>
                </form>
            </section>

            <!-- Table Section -->
            <section class="table-section">
                <div class="table-header">
                    <h2 class="table-title">
                        <i class="fas fa-list"></i>
                        Lista de Publicações
                    </h2>
                    <div class="table-info">
                        <span class="badge bg-primary">
                            <?php echo $result->num_rows; ?> publicações encontradas
                        </span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" role="table" aria-label="Tabela de publicações para edição">
                        <thead>
                            <tr>
                                <th scope="col">Título</th>
                                <th scope="col">Link</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Ano</th>
                                <th scope="col">Autor</th>
                                <th scope="col">Período</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td><strong>" . htmlspecialchars($row['titulo']) . "</strong></td>";
                                    echo "<td><a href='" . htmlspecialchars($row['link']) . "' target='_blank' class='text-primary'>" . 
                                         (strlen($row['link']) > 30 ? substr(htmlspecialchars($row['link']), 0, 30) . '...' : htmlspecialchars($row['link'])) . 
                                         "</a></td>";
                                    echo "<td>" . (strlen($row['descricao']) > 50 ? substr(htmlspecialchars($row['descricao']), 0, 50) . '...' : htmlspecialchars($row['descricao'])) . "</td>";
                                    echo "<td><span class='badge bg-secondary'>" . htmlspecialchars($row['categoria']) . "</span></td>";
                                    echo "<td>" . htmlspecialchars($row['ano']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['autor']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['periodo']) . "</td>";
                                    echo "<td>";
                                    echo "<button class='btn-edit' onclick='editRecord(" . json_encode([
                                        'id' => $row['id'],
                                        'titulo' => $row['titulo'],
                                        'link' => $row['link'],
                                        'descricao' => $row['descricao'],
                                        'categoria' => $row['categoria'],
                                        'ano' => $row['ano'],
                                        'autor' => $row['autor'],
                                        'periodo' => $row['periodo']
                                    ]) . ")' aria-label='Editar publicação: " . htmlspecialchars($row['titulo']) . "'>";
                                    echo "<i class='fas fa-edit'></i> Editar";
                                    echo "</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td colspan='8' class='empty-state'>";
                                echo "<i class='fas fa-search'></i>";
                                echo "<h4>Nenhuma publicação encontrada</h4>";
                                echo "<p>Tente ajustar os termos de busca ou verifique se há publicações cadastradas.</p>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>

    <!-- Modal de Edição -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">
                        <i class="fas fa-edit me-2"></i>
                        Editar Publicação
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="editForm">
                        <input type="hidden" name="edit_id" id="edit_id">
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="edit_titulo" class="form-label">
                                    <i class="fas fa-heading"></i>
                                    Título
                                </label>
                                <input type="text" class="form-control" name="titulo" id="edit_titulo" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="edit_link" class="form-label">
                                    <i class="fas fa-link"></i>
                                    Link
                                </label>
                                <input type="url" class="form-control" name="link" id="edit_link" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="edit_descricao" class="form-label">
                                    <i class="fas fa-align-left"></i>
                                    Descrição
                                </label>
                                <textarea class="form-control" name="descricao" id="edit_descricao" rows="3" ></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_categoria" class="form-label">
                                    <i class="fas fa-tags"></i>
                                    Categoria
                                </label>
                                <select class="form-select" name="categoria" id="edit_categoria" required>
                                    <option value="Teses">Teses</option>
                                    <option value="Artigos">Artigos</option>
                                    <option value="Dissertações">Dissertações</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_ano" class="form-label">
                                    <i class="fas fa-calendar"></i>
                                    Ano
                                </label>
                                <input type="number" class="form-control" name="ano" id="edit_ano" 
                                       min="2000" max="<?php echo date('Y'); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_autor" class="form-label">
                                    <i class="fas fa-user-edit"></i>
                                    Autor
                                </label>
                                <select class="form-select" name="autor" id="edit_autor" required>
                                    <?php
                                    foreach ($autores as $autor) {
                                        echo "<option value='" . htmlspecialchars($autor) . "'>" . htmlspecialchars($autor) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_periodo" class="form-label">
                                    <i class="fas fa-clock"></i>
                                    Período
                                </label>
                                <select class="form-select" name="periodo" id="edit_periodo" >
                                    <option value="Periódico">Periódico</option>
                                    <option value="Anais">Anais</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-save">
                            <i class="fas fa-save me-2"></i>
                            Salvar Alterações
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer - mantido original -->
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
        function editRecord(data) {
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_titulo').value = data.titulo;
            document.getElementById('edit_link').value = data.link;
            document.getElementById('edit_descricao').value = data.descricao;
            document.getElementById('edit_categoria').value = data.categoria;
            document.getElementById('edit_ano').value = data.ano;
            document.getElementById('edit_autor').value = data.autor;
            document.getElementById('edit_periodo').value = data.periodo;

            var modalElement = document.getElementById('editModal');
            var modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
            modalInstance.show();
        }

        // Funcionalidades adicionais
        document.addEventListener('DOMContentLoaded', function() {
            // Animação nos botões de editar
            const editButtons = document.querySelectorAll('.btn-edit');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });

            // Validação do formulário
            const editForm = document.getElementById('editForm');
            editForm.addEventListener('submit', function(e) {
                const titulo = document.getElementById('edit_titulo').value.trim();
                const link = document.getElementById('edit_link').value.trim();
                const descricao = document.getElementById('edit_descricao').value.trim();

                if (!titulo) {
                    e.preventDefault();
                    alert('Por favor, preencha o título da publicação.');
                    document.getElementById('edit_titulo').focus();
                    return false;
                }

                if (link && !isValidURL(link)) {
                    e.preventDefault();
                    alert('Por favor, insira um link válido (ex: https://exemplo.com).');
                    document.getElementById('edit_link').focus();
                    return false;
                }

                return true;
            });

            function isValidURL(string) {
                try {
                    new URL(string);
                    return true;
                } catch (_) {
                    return false;
                }
            }
        });
    </script>
</body>
</html>

