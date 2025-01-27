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
    <script>
        function toggleFields() {
            var linkField = document.getElementById("link");
            var fileField = document.getElementById("arquivo");

            if (linkField.value !== "") {
                fileField.disabled = true;
                fileField.value = ""; // Limpa o campo de arquivo se estiver desabilitado
            } else {
                fileField.disabled = false;
            }

            if (fileField.files.length > 0) {
                linkField.disabled = true;
                linkField.value = ""; // Limpa o campo de link se o arquivo estiver selecionado
            } else {
                linkField.disabled = false;
            }
        }

        function togglePeriodo() {
            var categoria = document.getElementById("categoria").value;
            var periodo = document.getElementById("periodo");

            if (categoria === "Artigos") {
                periodo.disabled = false;
            } else {
                periodo.disabled = true;
                periodo.value = ""; // Limpa o campo quando desabilitado
            }
        }
    </script>
</head>

<body>
    <!-- Conteúdo e navegação omitidos para brevidade -->

    <div class="container mt-5" style="margin-bottom:20%">
        <h2>Upload de Arquivo PDF ou Link</h2>
        <a href="logout.php" class="btn btn-danger mb-3">Logout</a>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titulo = $_POST['titulo']; // Novo campo título
            $descricao = $_POST['descricao'];
            $categoria = $_POST['categoria'];
            $ano = $_POST['ano'];
            $autor = isset($_POST['novo_autor']) && !empty($_POST['novo_autor']) ? $_POST['novo_autor'] : $_POST['autor'];
            $periodo = $_POST['periodo'];
            $link = $_POST['link'];
            $arquivo = $_FILES['arquivo'];

            // Validar se link ou arquivo foram fornecidos
            if (!empty($link) || ($arquivo['type'] == 'application/pdf' && $arquivo['size'] > 0)) {
                $nomeArquivo = basename($arquivo['name']);
                $caminhoArquivo = 'uploads/' . $categoria . '/' . $ano . '/' . $nomeArquivo;

                // Criar diretórios se não existirem
                if (!is_dir('uploads/' . $categoria)) {
                    mkdir('uploads/' . $categoria, 0777, true);
                }
                if (!is_dir('uploads/' . $categoria . '/' . $ano)) {
                    mkdir('uploads/' . $categoria . '/' . $ano, 0777, true);
                }

                if (!empty($link)) {
                    // Se o link for fornecido, salve o link em vez do caminho do arquivo
                    $sql = "INSERT INTO arquivos (titulo, nome_arquivo, descricao, caminho_arquivo, categoria, ano, autor, periodo, link) 
                            VALUES ('$titulo', '$link', '$descricao', '$link', '$categoria', '$ano', '$autor', '$periodo', '$link')";
                    if ($conn->query($sql) === TRUE) {
                        echo '<div class="alert alert-success">Link enviado com sucesso!</div>';
                    } else {
                        echo '<div class="alert alert-danger">Erro ao salvar no banco de dados: ' . $conn->error . '</div>';
                    }
                } else if (move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo)) {
                    $sql = "INSERT INTO arquivos (titulo, nome_arquivo, descricao, caminho_arquivo, categoria, ano, autor, periodo) 
                            VALUES ('$titulo', '$nomeArquivo', '$descricao', '$caminhoArquivo', '$categoria', '$ano', '$autor', '$periodo')";
                    if ($conn->query($sql) === TRUE) {
                        echo '<div class="alert alert-success">Arquivo enviado com sucesso!</div>';
                    } else {
                        echo '<div class="alert alert-danger">Erro ao salvar no banco de dados: ' . $conn->error . '</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Erro ao mover o arquivo.</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Por favor, envie um arquivo PDF válido ou insira um link.</div>';
            }
        }
        ?>

        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input class="form-control" type="text" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <select class="form-control" id="categoria" name="categoria" onchange="togglePeriodo()" required>
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
            <!-- Restante do formulário permanece igual -->
        </form>
    </div>

    <!-- Rodapé omitido para brevidade -->
</body>

</html>
