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






    <div class="container mt-5" style="margin-bottom: 20%;">
        <h2>Publicações</h2>
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
                    <select class="form-control" name="periodo">
                        <option value="">Todos os períodos</option>
                        <option value="periodico">Periódico</option>
                        <option value="anuais">Anuais</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <br>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Arquivo</th>
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
            $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
            $ano = isset($_GET['ano']) ? $_GET['ano'] : '';
            $autor = isset($_GET['autor']) ? $_GET['autor'] : '';
            $periodo = isset($_GET['periodo']) ? $_GET['periodo'] : '';
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

            if ($periodo != '') {
              $sql .= " AND periodo = '$periodo'";
          }

            $sql .= " ORDER BY data_upload DESC";
            $result = $conn->query($sql);

            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                   echo "<div class='row' style='margin-bottom: -40px;'>";
                   echo "<div class='col-12 mb-5 mt-3'>";
                   echo "<h5 class='font-weight-bold mb-1'>".$row['nome_arquivo']." </h5>";
                   echo "<div class='d-flex align-items-center border-bottom pb-3'>";
                   echo "<img class='img-fluid' src='img/usuario.png' style='width: 60px; height: 60px;margin-right:20px;' >";
                   echo "</a>";
                   echo  "<div class='d-flex flex-column pl-3'>";
                   echo "<br>";
                   echo "<p class='text-dark mb-2' href='' style='text-decoration:none;'> Descrição: ".$row['descricao']."</p>";
                   echo "<p class='text-dark mb-2' href='' style='text-decoration:none;'>Categoria: " .$row['categoria']."</p>";
                   echo "<p class='text-dark mb-2' href='' style='text-decoration:none;'>Ano: " .$row['ano']."</p>";
                   echo "<p class='text-dark mb-2' href='' style='text-decoration:none;'>Período: " .$row['periodo']."</p>";
                   echo "<p class='text-dark mb-2' href='' style='text-decoration:none;'>Data Upload: " .$row['data_upload']."</p>";
                   echo  "<div class='d-flex'>";
                   echo "<small class='mr-3'><i class='fa fa-user text-primary'>Autor: </i>".$row['autor']."</small>";
                   echo "</div>";
                   echo "<br>";
                   echo "<a href='" . $row['caminho_arquivo'] . "'  target='_blank' class='btn btn-primary btn-sm' style='max-width:150px;'>Visualizar</a>";
                   echo "</div>";
                   echo "</div>";
                   echo "</div>";
                   echo "</div>";
                }
            } else {
                echo "<tr><td colspan='8'>Nenhum arquivo encontrado.</td></tr>";
            }
            ?>
            </tbody>
        </table>

        <?php
                $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
                $ano = isset($_GET['ano']) ? $_GET['ano'] : '';
                $autor = isset($_GET['autor']) ? $_GET['autor'] : '';
                $periodo = isset($_GET['periodo']) ? $_GET['periodo'] : '';
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

                if ($periodo != '') {
                    $sql .= " AND periodo = '$periodo'";
                }

                $sql .= " ORDER BY data_upload DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='row' style='margin-bottom: -40px;'>";
                        echo "<div class='col-12 mb-5 mt-3'>";
                        echo "<h5 class='font-weight-bold mb-1'>" . htmlspecialchars($row['nome_arquivo']) . "</h5>";
                        echo "<div class='d-flex align-items-center border-bottom pb-3'>";
                        echo "<img class='img-fluid' src='img/usuario.png' style='width: 60px; height: 60px;margin-right:20px;'>";
                        echo "<div class='d-flex flex-column pl-3'>";
                        echo "<br>";
                        echo "<p class='text-dark mb-2'>Descrição: " . htmlspecialchars($row['descricao']) . "</p>";
                        echo "<p class='text-dark mb-2'>Categoria: " . htmlspecialchars($row['categoria']) . "</p>";
                        echo "<p class='text-dark mb-2'>Ano: " . htmlspecialchars($row['ano']) . "</p>";
                        echo "<p class='text-dark mb-2'>Período: " . htmlspecialchars($row['periodo']) . "</p>";
                        echo "<p class='text-dark mb-2'>Data Upload: " . htmlspecialchars($row['data_upload']) . "</p>";
                        echo "<div class='d-flex'>";
                        echo "<small class='mr-3'><i class='fa fa-user text-primary'></i> Autor: " . htmlspecialchars($row['autor']) . "</small>";
                        echo "</div>";
                        echo "<br>";

                        // Verifica se o link está preenchido
                        if (!empty($row['link'])) {
                            echo "<a href='" . htmlspecialchars($row['link']) . "' target='_blank' class='btn btn-primary btn-sm' style='max-width:150px;'>Visualizar</a>";
                        } else {
                            echo "<a href='" . htmlspecialchars($row['caminho_arquivo']) . "' target='_blank' class='btn btn-primary btn-sm' style='max-width:150px;'>Visualizar</a>";
                        }

                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Nenhum arquivo encontrado.</td></tr>";
                }
                ?>




        <div class="row" style="margin-bottom: -40px;">
            <div class="col-12 mb-5 mt-3">
                <h5 class="font-weight-bold mb-1">$row['nome_arquivo'] @item.Titulo</h5>
                <div class='d-flex align-items-center border-bottom pb-3'>
                    <!--<a href="~/pdf/@item.Titulo" target="_blank">-->
                    <img class='img-fluid' src='img/download.png' style='width: 60px; height: 60px;'>
                    </a>
                    <div class='d-flex flex-column pl-3'>
                        <a class='text-dark mb-2' href=''>$row['descricao'] Texto Resumo</a>
                        <div class="d-flex">
                            <small class='mr-3'><i class='fa fa-user text-primary'></i>$row['autor']</small>
                        </div>
                        <br>
                        <a href='' . $row[' caminho_arquivo'] . '' target='_blank'
                            class='btn btn-primary btn-sm'>Visualizar</a>
                    </div>
                </div>
            </div>
        </div>




        <div class="row" style="margin-bottom: -40px;">
            <div class="col-12 mb-5 mt-3">
                <h5 class="font-weight-bold mb-1">$row['nome_arquivo'] @item.Titulo</h5>
                <div class="d-flex align-items-center border-bottom pb-3">
                    <!--<a href="~/pdf/@item.Titulo" target="_blank">-->
                    <img class="img-fluid" src="img/download.png" style="width: 60px; height: 60px;" alt="">
                    </a>
                    <div class="d-flex flex-column pl-3">
                        <a class="text-dark mb-2" href="">$row['descricao'] Texto Resumo</a>
                        <div class="d-flex">
                            <small class="mr-3"><i class="fa fa-user text-primary"></i>$row['autor']</small>
                        </div>
                        <br>
                        <a href='" . $row[' caminho_arquivo'] . "' target='_blank' class='btn btn-primary btn-sm'>Visualizar</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <footer class=" navbar fixed-bottom bg-footer">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="Home.php"><img src="Img/icones/Logo_rumoPNG.png"
                                        alt="Logo" width="70" height="50" class="d-inline-block align-text-top"
                                        style="margin-left: 15px;"></a>
                                <div class="d-flex">
                                    <a class="navbar-brand"><img src="Img/icones/logo_fapesp.png" alt="Logo" width="90"
                                            height="50" class="d-inline-block align-text-top"
                                            style="margin-left: 15px;"></a>
                                    <a class="navbar-brand"><img src="Img/icones/CNPq_v2017_rgb.png" alt="Logo"
                                            width="90" height="40" class="d-inline-block align-text-top"
                                            style="margin-left: 15px;"></a>
                                    <a class="navbar-brand"><img src="Img/icones/banner_capes-1024x871.png" alt="Logo"
                                            width="70" height="50" class="d-inline-block align-text-top"
                                            style="margin-left: 15px; object-fit: contain;"></a>
                                </div>
                            </div>
                            </footer>
</body>

</html>