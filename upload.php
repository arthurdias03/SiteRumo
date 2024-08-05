<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

include 'config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo PDF</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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


    <div class="container mt-5" style="margin-bottom:20%">
    <h2>Upload de Arquivo PDF</h2>
    <a href="logout.php" class="btn btn-danger mb-3">Logout</a>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $descricao = $_POST['descricao'];
        $categoria = $_POST['categoria'];
        $ano = $_POST['ano'];
        $autor = isset($_POST['novo_autor']) && !empty($_POST['novo_autor']) ? $_POST['novo_autor'] : $_POST['autor'];
        $periodo = $_POST['periodo'];
        $arquivo = $_FILES['arquivo'];

        if ($arquivo['type'] == 'application/pdf' && $arquivo['size'] > 0) {
            $nomeArquivo = basename($arquivo['name']);
            $caminhoArquivo = 'uploads/' . $categoria . '/' . $ano . '/' . $nomeArquivo;

            // Criar diretórios se não existirem
            if (!is_dir('uploads/' . $categoria)) {
                mkdir('uploads/' . $categoria, 0777, true);
            }
            if (!is_dir('uploads/' . $categoria . '/' . $ano)) {
                mkdir('uploads/' . $categoria . '/' . $ano, 0777, true);
            }

            if (move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo)) {
                $sql = "INSERT INTO arquivos (nome_arquivo, descricao, caminho_arquivo, categoria, ano, autor, periodo) 
                        VALUES ('$nomeArquivo', '$descricao', '$caminhoArquivo', '$categoria', '$ano', '$autor', '$periodo')";
                if ($conn->query($sql) === TRUE) {
                    echo '<div class="alert alert-success">Arquivo enviado com sucesso!</div>';
                } else {
                    echo '<div class="alert alert-danger">Erro ao salvar no banco de dados: ' . $conn->error . '</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Erro ao mover o arquivo.</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Por favor, envie um arquivo PDF válido.</div>';
        }
    }

    // Obter autores existentes
    $autoresResult = $conn->query("SELECT DISTINCT autor FROM arquivos");
    $autores = [];
    if ($autoresResult->num_rows > 0) {
        while ($row = $autoresResult->fetch_assoc()) {
            $autores[] = $row['autor'];
        }
    }
    ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <select class="form-control" id="categoria" name="categoria" required>
                <option value="">Selecione uma categoria</option>
                <option value="Teses">Teses</option>
                <option value="Dissertacoes">Dissertações</option>
                <option value="Artigos">Artigos</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="ano" class="form-label">Ano</label>
            <select class="form-control" id="ano" name="ano" required>
                <?php
                for ($year = date("Y"); $year >= 2000; $year--) {
                    echo "<option value='$year'>$year</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="autor" class="form-label">Autor</label>
            <select class="form-control" id="autor" name="autor">
                <option value="">Selecione um autor existente ou adicione um novo</option>
                <?php foreach ($autores as $autor) { echo "<option value='$autor'>$autor</option>"; } ?>
            </select>
            <input class="form-control mt-2" type="text" id="novo_autor" name="novo_autor" placeholder="Novo Autor (se aplicável)">
        </div>
        <div class="mb-3">
            <label for="periodo" class="form-label">Período</label>
            <select class="form-control" id="periodo" name="periodo" required>
                <option value="periodico">Periódico</option>
                <option value="anuais">Anuais</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="arquivo" class="form-label">Arquivo PDF</label>
            <input class="form-control" type="file" id="arquivo" name="arquivo" accept="application/pdf" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
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


    <script>
    document.getElementById('novo_autor').addEventListener('input', function() {
        if (this.value) {
            document.getElementById('autor').disabled = true;
        } else {
            document.getElementById('autor').disabled = false;
        }
    });
    </script>
</body>

</html>