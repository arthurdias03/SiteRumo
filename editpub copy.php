
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

    $updateSql = "UPDATE arquivos SET titulo='$titulo', link='$link', descricao='$descricao', categoria='$categoria', ano='$ano', autor='$autor', periodo='$periodo' WHERE id='$id'";

    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Registro atualizado com sucesso!'); window.location.href='deletepubs.php';</script>";
        exit;
    } else {
        echo "<p class='alert alert-danger'>Erro ao atualizar registro: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
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
                <input type="text" class="form-control" name="search" placeholder="Pesquisar arquivos" value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-primary" type="submit">Pesquisar</button>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>link</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Ano</th>
                    <th>Autor</th>
                    <th>Período</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['titulo']}</td>
                                <td><a href='{$row['link']}' target='_blank'>{$row['link']}</a></td>
                                <td>{$row['descricao']}</td>
                                <td>{$row['categoria']}</td>
                                <td>{$row['ano']}</td>
                                <td>{$row['autor']}</td>
                                <td>{$row['periodo']}</td>
                                <td>
                                    <button class='btn btn-warning btn-sm' onclick=\"editRecord({$row['id']},{$row['titulo']}, '{$row['link']}', '{$row['descricao']}', '{$row['categoria']}', '{$row['ano']}', '{$row['autor']}', '{$row['periodo']}')\">Editar</button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Nenhum arquivo encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="modal" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Publicação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <input type="hidden" name="edit_id" id="edit_id">
                        <div class="mb-3">
                            <label class="form-label">Titulo</label>
                            <input type="text" class="form-control" name="titulo" id="edit_titulo" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link</label>
                            <input type="text" class="form-control" name="link" id="edit_link" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea class="form-control" name="descricao" id="edit_descricao" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Categoria</label>
                            <input type="text" class="form-control" name="categoria" id="edit_categoria" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ano</label>
                            <input type="number" class="form-control" name="ano" id="edit_ano" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Autor</label>
                            <input type="text" class="form-control" name="autor" id="edit_autor" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Período</label>
                            <input type="text" class="form-control" name="periodo" id="edit_periodo">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
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
    <script>
        function editRecord(id,titulo, link, descricao, categoria, ano, autor, periodo) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_titulo').value = titulo;
            document.getElementById('edit_link').value = link;
            document.getElementById('edit_descricao').value = descricao;
            document.getElementById('edit_categoria').value = categoria;
            document.getElementById('edit_ano').value = ano;
            document.getElementById('edit_autor').value = autor;
            document.getElementById('edit_periodo').value = periodo;

            var modalElement = document.getElementById('editModal');
            var modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
            modalInstance.show();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
