<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Upload de Arquivo PDF</h2>
    <a href="logout.php" class="btn btn-danger mb-3">Logout</a>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $descricao = $_POST['descricao'];
        $categoria = $_POST['categoria'];
        $ano = $_POST['ano'];
        $autor = isset($_POST['novo_autor']) && !empty($_POST['novo_autor']) ? $_POST['novo_autor'] : $_POST['autor'];
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
                $sql = "INSERT INTO arquivos (nome_arquivo, descricao, caminho_arquivo, categoria, ano, autor) VALUES ('$nomeArquivo', '$descricao', '$caminhoArquivo', '$categoria', '$ano', '$autor')";
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
            <label for="arquivo" class="form-label">Arquivo PDF</label>
            <input class="form-control" type="file" id="arquivo" name="arquivo" accept="application/pdf" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
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