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
    <title>Arquivos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Arquivos</h2>
    
    <form method="get" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <select class="form-control" name="categoria">
                    <option value="">Todas as categorias</option>
                    <option value="Teses">Teses</option>
                    <option value="Dissertacoes">Dissertações</option>
                    <option value="Artigos">Artigos</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control" name="ano">
                    <option value="">Todos os anos</option>
                    <?php
                    for ($year = date("Y"); $year >= 2000; $year--) {
                        echo "<option value='$year'>$year</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-control" name="autor">
                    <option value="">Todos os autores</option>
                    <?php
                    $autoresResult = $conn->query("SELECT DISTINCT autor FROM arquivos");
                    if ($autoresResult->num_rows > 0) {
                        while ($row = $autoresResult->fetch_assoc()) {
                            echo "<option value='{$row['autor']}'>{$row['autor']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Arquivo</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Ano</th>
                <th>Autor</th>
                <th>Data de Upload</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
            $ano = isset($_GET['ano']) ? $_GET['ano'] : '';
            $autor = isset($_GET['autor']) ? $_GET['autor'] : '';
            $sql = "SELECT * FROM arquivos WHERE 1=1";

            if ($categoria != '') {
                $sql .= " AND categoria = '$categoria'";
            }

            if ($ano != '') {
                $sql .= " AND ano = '$ano'";
            }

            if ($autor != '') {
                $sql .= " AND autor = '$autor'";
            }

            $sql .= " ORDER BY data_upload DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nome_arquivo'] . "</td>";
                    echo "<td>" . $row['descricao'] . "</td>";
                    echo "<td>" . $row['categoria'] . "</td>";
                    echo "<td>" . $row['ano'] . "</td>";
                    echo "<td>" . $row['autor'] . "</td>";
                    echo "<td>" . $row['data_upload'] . "</td>";
                    echo "<td><a href='" . $row['caminho_arquivo'] . "' target='_blank' class='btn btn-primary btn-sm'>Visualizar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Nenhum arquivo encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
