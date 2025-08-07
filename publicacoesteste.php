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
        
        :root {
            --primary-color: #2846a7ff;
            --secondary-color: #17a2b8;
            --accent-color: #fd7e14;
            --success-color: #20c997;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --dark-color: #343a40;
            --light-color: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
            --gradient-secondary: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            --gradient-accent: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            --shadow-light: 0 4px 20px rgba(0,0,0,0.1);
            --shadow-medium: 0 8px 30px rgba(0,0,0,0.15);
            --shadow-heavy: 0 15px 50px rgba(0,0,0,0.2);
        }
        .section-title {
              text-align: center;
              margin-top: 2rem;
              margin-bottom: 3rem;
          }
          
        .section-title h2 {
              font-size: 2.5rem;
              font-weight: 500;
              color: var(--primary-color);
              margin-bottom: 1rem;
              position: relative;
          }
        .section-title h2::after {
              content: '';
              position: absolute;
              bottom: -10px;
              left: 50%;
              transform: translateX(-50%);
              width: 80px;
              height: 4px;
              background: var(--gradient-accent);
              border-radius: 2px;
          }

          .section-title p {
              font-size: 1.1rem;
              
              max-width: 600px;
              margin: 0 auto;
          }
        .select-pub{
      border: 1px solid #194376;
      color: #194376;
      font-weight: 700;
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
        <div class="col">
            <div class="section-title scroll-animate">
                    <h2>Publicações</h2>
                    
                </div>
            </div>
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