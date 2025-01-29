<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicações</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        select[multiple] {
            height: 60px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <!--Menu-->
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




    

    <div class="container-fluid mt-4">
        <h2 class="text-center">Publicações</h2> <br>
        <div class="row">
            <div class="col-md-2">
                <form method="get" class="mb-3">
                    <label><strong>Categorias</strong></label><br>
                    <select name="categoria[]" multiple class="form-control">
                        <option value="Teses">Teses</option>
                        <option value="Dissertacoes">Dissertações</option>
                        <option value="Artigos">Artigos</option>
                    </select>
                    <br>
                    <label><strong>Anos</strong></label><br>
                    <select name="ano[]" multiple class="form-control">
                        <?php
                        for ($year = date("Y"); $year >= 2000; $year--) {
                            echo "<option value='$year'>$year</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <label><strong>Autores</strong></label><br>
                    <select name="autor[]" multiple class="form-control">
                        <?php
                        $autoresResult = $conn->query("SELECT DISTINCT autor FROM arquivos");
                        if ($autoresResult->num_rows > 0) {
                            while ($row = $autoresResult->fetch_assoc()) {
                                echo "<option value='{$row['autor']}'>{$row['autor']}</option>";
                            }
                        }
                        ?>
                    </select>
                    <br>
                    <label><strong>Períodos</strong></label><br>
                    <select name="periodo[]" multiple class="form-control">
                        <option value="periodico">Periódico</option>
                        <option value="anuais">Anuais</option>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </form>
            </div>
            <div class="col-md-10">
                <table class="table table-striped w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Ata de arquivo</th>
                            <th>Categoria</th>
                            <th>Ano</th>
                            <th>Autor</th>
                            <th>Data de Upload</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $sql = "SELECT * FROM arquivos WHERE 1=1";
                    if (!empty($_GET['categoria'])) {
                        $categorias = implode("','", $_GET['categoria']);
                        $sql .= " AND categoria IN ('$categorias')";
                    }
                    if (!empty($_GET['ano'])) {
                        $anos = implode("','", $_GET['ano']);
                        $sql .= " AND ano IN ('$anos')";
                    }
                    if (!empty($_GET['autor'])) {
                        $autores = implode("','", $_GET['autor']);
                        $sql .= " AND autor IN ('$autores')";
                    }
                    if (!empty($_GET['periodo'])) {
                        $periodos = implode("','", $_GET['periodo']);
                        $sql .= " AND periodo IN ('$periodos')";
                    }
                    $sql .= " ORDER BY data_upload DESC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['titulo']}</td>";
                            echo "<td>{$row['descricao']}</td>";
                            echo "<td>{$row['categoria']}</td>";
                            echo "<td>{$row['ano']}</td>";
                            echo "<td>{$row['autor']}</td>";
                            echo "<td>{$row['data_upload']}</td>";
                            echo "<td><a href='{$row['caminho_arquivo']}' target='_blank' class='btn btn-primary btn-sm'>Visualizar</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Nenhum arquivo encontrado.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
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
</body>

</html>