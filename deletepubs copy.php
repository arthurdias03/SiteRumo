<?php
include 'config.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM arquivos";
if ($search) {
    $search = $conn->real_escape_string($search);
    $sql .= " WHERE nome_arquivo LIKE '%$search%' 
              OR descricao LIKE '%$search%' 
              OR categoria LIKE '%$search%' 
              OR ano LIKE '%$search%' 
              OR autor LIKE '%$search%' 
              OR periodo LIKE '%$search%'";
}
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_id'])) {
        $id = intval($_POST['edit_id']);
        $nome_arquivo = $conn->real_escape_string($_POST['nome_arquivo']);
        $descricao = $conn->real_escape_string($_POST['descricao']);
        $categoria = $conn->real_escape_string($_POST['categoria']);
        $ano = intval($_POST['ano']);
        $autor = $conn->real_escape_string($_POST['autor']);
        $periodo = $conn->real_escape_string($_POST['periodo']);

        $updateSql = "UPDATE arquivos SET nome_arquivo='$nome_arquivo', descricao='$descricao', categoria='$categoria', ano='$ano', autor='$autor', periodo='$periodo' WHERE id='$id'";

        if ($conn->query($updateSql) === TRUE) {
            echo "<p class='alert alert-success'>Registro atualizado com sucesso!</p>";
        } else {
            echo "<p class='alert alert-danger'>Erro ao atualizar registro: " . $conn->error . "</p>";
        }
    }
    if (isset($_POST['delete_id'])) {
        $id = intval($_POST['delete_id']);
        $deleteSql = "DELETE FROM arquivos WHERE id='$id'";
        if ($conn->query($deleteSql) === TRUE) {
            echo "<p class='alert alert-success'>Registro excluído com sucesso!</p>";
        } else {
            echo "<p class='alert alert-danger'>Erro ao excluir registro: " . $conn->error . "</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Publicações</title>
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
    <div class="container mt-5">
        <h2>Gerenciar Publicações</h2>
        <form method="get" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Pesquisar" value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-primary" type="submit">Pesquisar</button>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Arquivo</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Ano</th>
                    <th>Autor</th>
                    <th>Período</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nome_arquivo']); ?></td>
                    <td><?php echo htmlspecialchars($row['descricao']); ?></td>
                    <td><?php echo htmlspecialchars($row['categoria']); ?></td>
                    <td><?php echo htmlspecialchars($row['ano']); ?></td>
                    <td><?php echo htmlspecialchars($row['autor']); ?></td>
                    <td><?php echo htmlspecialchars($row['periodo']); ?></td>
                    <td>
                        <form method="post" class="d-inline">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este arquivo?');">Excluir</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
