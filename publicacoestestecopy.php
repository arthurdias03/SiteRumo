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
            --primary-color: #4263cfff;
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
    
    
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #f8f9fa;
            --accent-color: #17a2b8;
            --text-dark: #333;
            --border-color: #dee2e6;
            --shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
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
            0% {
                box-shadow: 0 0 0 0 rgba(44, 90, 160, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(44, 90, 160, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(44, 90, 160, 0);
            }
        }

        

        .navbar{
            padding: 1rem;

        }

        

       
        .header-section {
            background: linear-gradient(135deg, var(--secondary-color), #e9ecef);
            padding: 2rem 0;
            border-bottom: 3px solid var(--primary-color);
            position: relative;
            overflow: hidden;
        }

        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23e9ecef" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
            z-index: 0;
        }

        .header-section .container {
            position: relative;
            z-index: 1;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .logo-container img {
            border-radius: 50%;
            box-shadow: var(--shadow);
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 700;
            margin: 0;
            font-size: 2.5rem;
        }

        .subtitle {
            color: #6c757d;
            font-size: 1.1rem;
            margin-top: 0.5rem;
        }

        .main-content {
            padding: 3rem 0;
            min-height: calc(100vh - 200px);
            margin-bottom: 10rem;
        }

        .filters-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
            animation: slideInLeft 0.6s ease-out;
        }

        .filters-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .filter-group::before {
            content: '';
            position: absolute;
            left: -1rem;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(to bottom, var(--primary-color), var(--accent-color));
            border-radius: 2px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .filter-group:hover::before {
            opacity: 1;
        }

        .active-filter {
            background: linear-gradient(135deg, rgba(44, 90, 160, 0.05), rgba(23, 162, 184, 0.05));
            border-radius: 0.5rem;
            padding: 0.5rem;
            margin: -0.5rem;
            border-left: 3px solid var(--primary-color);
        }

        .filter-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-select {
            border: 2px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.75rem;
            transition: all 0.3s ease;
            min-height: 120px;
        }

        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.25);
        }

        .form-select:hover {
            border-color: var(--accent-color);
            transform: translateY(-1px);
        }

        .btn-filter {
            background: linear-gradient(135deg, var(--primary-color), #1e4080);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(44, 90, 160, 0.3);
        }

        .btn-filter:active {
            animation: pulse 0.6s;
        }

        .publications-section {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }

        .publications-header {
            display: flex;
            align-items: center;
            justify-content: between;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
        }

        .publications-title {
            color: var(--primary-color);
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-results-info {
            padding: 0.5rem;
            background: rgba(44, 90, 160, 0.05);
            border-radius: 0.375rem;
            border-left: 3px solid var(--accent-color);
        }

        .input-group .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.25);
        }

        .table-responsive {
            border-radius: 0.5rem;
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .table {
            margin: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary-color), #1e4080);
            color: white;
            font-weight: 600;
            border: none;
            padding: 1rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .table thead th::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .table thead th:hover::before {
            left: 100%;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: var(--border-color);
        }

        .table tbody tr {
            animation: fadeInUp 0.4s ease-out both;
            transition: all 0.3s ease;
        }

        .table tbody tr:nth-child(1) { animation-delay: 0.1s; }
        .table tbody tr:nth-child(2) { animation-delay: 0.2s; }
        .table tbody tr:nth-child(3) { animation-delay: 0.3s; }
        .table tbody tr:nth-child(4) { animation-delay: 0.4s; }
        .table tbody tr:nth-child(5) { animation-delay: 0.5s; }

        .table tbody tr:hover {
            background-color: rgba(44, 90, 160, 0.05);
            transform: scale(1.01);
            z-index: 10;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .row-number {
            font-weight: 600;
            color: var(--primary-color);
        }

        .btn-view {
            background: linear-gradient(135deg, var(--accent-color), #138496);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-view:hover {
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(23, 162, 184, 0.3);
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.5rem 0.75rem;
            border-radius: 1rem;
            font-weight: 600;
        }

        .badge.bg-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268) !important;
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .no-results i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--border-color);
        }

        .footer {
            background: linear-gradient(135deg, var(--primary-color), #1e4080);
            padding: 2rem 0;
            margin-top: 3rem;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-logos {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .footer-logos img {
            transition: all 0.3s ease;
            border-radius: 0.375rem;
            background: white;
            padding: 0.5rem;
            filter: brightness(1.1);
        }

        .footer-logos img:hover {
            transform: scale(1.05);
            filter: brightness(1.3);
            box-shadow: 0 4px 15px rgba(255,255,255,0.2);
        }

        /* Scrollbar personalizada */
        .form-select::-webkit-scrollbar {
            width: 8px;
        }

        .form-select::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .form-select::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        .form-select::-webkit-scrollbar-thumb:hover {
            background: #1e4080;
        }

        /* Acessibilidade */
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

        .sr-only-focusable:focus {
            position: static !important;
            width: auto !important;
            height: auto !important;
            padding: inherit !important;
            margin: inherit !important;
            overflow: visible !important;
            clip: auto !important;
            white-space: normal !important;
        }

        /* Responsividade */
        @media (max-width: 992px) {
            .filters-section {
                margin-bottom: 2rem;
                animation: fadeInUp 0.6s ease-out;
            }
            
            .publications-section {
                animation-delay: 0s;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem;
            }
            
            .logo-container {
                flex-direction: column;
                text-align: center;
            }
            
            .footer-content {
                flex-direction: column;
                gap: 1rem;
            }
            
            .footer-logos {
                flex-wrap: wrap;
                justify-content: center;
            }

            .table-responsive {
                font-size: 0.875rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 0.75rem 0.5rem;
            }
            
            .btn-view {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }
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
            $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
            $ano = isset($_GET['ano']) ? $_GET['ano'] : '';
            $autor = isset($_GET['autor']) ? $_GET['autor'] : '';
            $periodo = isset($_GET['periodo']) ? $_GET['periodo'] : '';
            
            $sql = "SELECT * FROM arquivos WHERE 1=1";
            $params = array();
            $types = "";

            if ($categoria != '') {
                $sql .= " AND categoria = ?";
                $params[] = $categoria;
                $types .= "s";
            }

            if ($ano != '') {
                $sql .= " AND ano = ?";
                $params[] = $ano;
                $types .= "s";
            }

            if ($autor != '') {
                $sql .= " AND autor = ?";
                $params[] = $autor;
                $types .= "s";
            }

            if ($periodo != '') {
                $sql .= " AND periodo = ?";
                $params[] = $periodo;
                $types .= "s";
            }

            $sql .= " ORDER BY data_upload DESC";
            
            $stmt = $conn->prepare($sql);
            
            if ($stmt) {
                if (count($params) > 0) {
                    $bind_params = array($types);
                    for ($i = 0; $i < count($params); $i++) {
                        $bind_params[] = &$params[$i];
                    }
                    call_user_func_array(array($stmt, 'bind_param'), $bind_params);
                }
                
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['titulo'] . "</td>";
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
                
                $stmt->close();
            } else {
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['titulo'] . "</td>";
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
            }
            ?>
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
</body>

</html>