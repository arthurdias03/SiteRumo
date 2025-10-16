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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .search-bar-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .search-input {
            border: 2px solid #dee2e6;
            border-radius: 4px 0 0 4px;
            padding: 12px 15px;
            font-size: 15px;
        }

        .search-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .filter-sidebar {
            background: #faf7f7ff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        }

        .filter-sidebar h5 {
            color: #0d6efd;
            font-weight: bold;
            margin-bottom: 20px;
        }


        .filter-section {
            margin-bottom: 25px;


            animation: slideInLeft 0.6s ease-out;
        }

        .filter-section h6 {
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .filter-options {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 10px;
            max-height: 200px;
            overflow-y: auto;
        }


        .filter-options label {
            display: block;
            padding: 5px 0;
            cursor: pointer;
            font-size: 14px;
        }

        .filter-options input[type="checkbox"] {
            margin-right: 8px;
        }



        .filter-note {
            font-size: 11px;
            color: #6c757d;
            margin-top: 5px;
        }

        .btn-apply-filter {
            width: 100%;
            background: #0d6efd;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-apply-filter:hover {
            background: #0b5ed7;
        }

        .publications-section h5 {
            color: #0d6efd;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table-responsive {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table thead {
            background: #0d6efd;
            color: white;
        }

        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
        }

        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .btn-view {
            background: #17a2b8;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
        }

        .btn-view:hover {
            background: #138496;
            color: white;
        }

        .row-number {
            font-weight: 600;
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-apply-filter,
        .btn-clear-filter {
            flex: 1;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .btn-apply-filter {
            background: #0d6efd;
            color: white;
        }

        .btn-apply-filter:hover {
            background: #0b5ed7;
        }

        .btn-clear-filter {
            background: #6c757d;
            color: white;
        }

        .btn-clear-filter:hover {
            background: #909aa1ff;
            color: hsla(96, 43%, 85%, 1.00)
        }


        select[multiple] {
            height: 60px;
            overflow-y: auto;
        }

        :root {
            --primary-color: #2c5aa0;
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
            --shadow-light: 0 4px 20px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 8px 30px rgba(0, 0, 0, 0.15);
            --shadow-heavy: 0 15px 50px rgba(0, 0, 0, 0.2);
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

        .select-pub {
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
            --shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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



        .navbar {
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
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

        .table tbody tr:nth-child(1) {
            animation-delay: 0.1s;
        }

        .table tbody tr:nth-child(2) {
            animation-delay: 0.2s;
        }

        .table tbody tr:nth-child(3) {
            animation-delay: 0.3s;
        }

        .table tbody tr:nth-child(4) {
            animation-delay: 0.4s;
        }

        .table tbody tr:nth-child(5) {
            animation-delay: 0.5s;
        }

        .table tbody tr:hover {
            background-color: rgba(44, 90, 160, 0.05);
            transform: scale(1.01);
            z-index: 10;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }

        /* Estilos para a barra de navegação do footer */
        .bg-footer {

            /* Cor de fundo que parece na imagem, se for azul. */
            padding: 1px 0;
            /* Espaçamento vertical menor */
            height: 60px;
            /* Altura fixa para o footer */
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            /* Sombra para destacar */
        }

        /* Estilos gerais para as imagens de patrocínio no footer */
        .logo-patrocinio {
            /* Define largura máxima para as imagens para evitar que fiquem muito grandes */
            max-width: 60px;
            height: 40px;
            object-fit: contain;
            /* Garante que a imagem se ajuste sem cortar */
        }

        /* Ajuste específico para a logo da CAPES, se necessário, dado o seu tamanho original */
        .capes-logo {
            max-width: 50px;
            height: 40px;
        }

        /* Ajuste fino para a div que contém as logos de patrocínio em mobile */
        @media (max-width: 576px) {
            .logo-patrocinio-group {
                /* Reduz o espaçamento entre as logos em telas menores */
                gap: 5px;
            }
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

            .filters-section {
                background: white;
                border-radius: 1rem;
                padding: 2rem;
                box-shadow: var(--shadow);
                margin-bottom: 2rem;
                border: 1px solid var(--border-color);
                animation: slideInLeft 0.6s ease-out;
            }

            /* ========================================= */
            /* Estilos Responsivos para Tabela (Mobile First) */
            /* ========================================= */

            @media screen and (max-width: 768px) {

                /* Esconde os cabeçalhos da tabela original em telas pequenas */
                .table thead {
                    display: none;
                }

                /* Transforma cada linha (<tr>) em um bloco tipo 'cartão' */
                .table tbody tr {
                    display: block;
                    margin-bottom: 1.5rem;
                    /* Espaçamento entre os cartões */
                    border: 1px solid var(--border-color);
                    border-radius: 0.75rem;
                    /* Bordas arredondadas para o cartão */
                    box-shadow: var(--shadow-light);
                    /* Sombra para destacar o cartão */
                    overflow: hidden;
                    /* Garante que bordas e sombras funcionem bem */
                    transition: all 0.3s ease;
                }

                .table tbody tr:hover {
                    background-color: var(--light-color);
                    /* Fundo claro no hover */
                    transform: translateY(-2px);
                    box-shadow: var(--shadow-medium);
                }

                /* Estiliza cada célula (<td>) para exibir o cabeçalho antes do conteúdo */
                .table tbody td {
                    display: block;
                    /* Cada célula ocupa sua própria linha */
                    text-align: right;
                    /* Alinha o conteúdo da célula à direita */
                    padding-left: 50%;
                    /* Espaço para o pseudo-elemento do cabeçalho */
                    position: relative;
                    border: none;
                    /* Remove bordas internas das células */
                    padding-top: 0.75rem;
                    padding-bottom: 0.75rem;
                    border-bottom: 1px dashed var(--border-color);
                    /* Linha divisória entre os campos */
                }

                .table tbody tr:last-child td {
                    border-bottom: none;
                    /* Remove a borda da última célula do cartão */
                }

                /* Adiciona o cabeçalho da coluna como um pseudo-elemento */
                .table tbody td::before {
                    content: attr(data-label);
                    /* Pega o valor do atributo data-label */
                    position: absolute;
                    left: 0;
                    width: 45%;
                    /* Largura para o label */
                    padding-left: 1rem;
                    font-weight: 600;
                    color: var(--primary-color);
                    text-align: left;
                    /* Alinha o label à esquerda */
                }

                /* Ajustes específicos para a célula de Ações para centralizar o botão */
                .table tbody td:last-child {
                    text-align: center;
                    /* Centraliza o botão de Ações */
                    padding-left: 0;
                    /* Remove padding extra se não tiver label */
                }

                .table tbody td:last-child::before {
                    content: '';
                    /* Remove o label para a coluna de Ações */
                }

                /* Ajusta a largura do badge para não quebrar */
                .badge {
                    display: inline-block;
                    white-space: nowrap;
                }

                /* Garante que o número da linha se alinhe bem */
                .row-number {
                    display: inline-block;
                }

                /* Centraliza o título da tabela */
                .publications-title {
                    justify-content: center;
                    text-align: center;
                    flex-wrap: wrap;
                    /* Permite que o ícone e texto quebrem linha se necessário */
                }
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

    <div class="container-fluid mt-4" style="margin-bottom: 15rem;">
        <div class="row">
            <!-- Sidebar de Filtros -->
            <div class="col-md-3">
                <div class="filter-sidebar">
                    <h2 class='filters-title'>Filtros de Busca</h2>
                    <form method="get">
                        <!-- Categorias -->
                        <div class="filter-section">
                            <h5 style="color: black; font-weight:400;font-size:18px">Categorias</h5>
                            <div class="filter-options filter-group animate-in">
                                <label>
                                    <input type="checkbox" name="categoria[]" value="Teses"
                                        <?php echo (isset($_GET['categoria']) && in_array('Teses', $_GET['categoria'])) ? 'checked' : ''; ?>>
                                    Teses
                                </label>
                                <label>
                                    <input type="checkbox" name="categoria[]" value="Dissertacoes"
                                        <?php echo (isset($_GET['categoria']) && in_array('Dissertacoes', $_GET['categoria'])) ? 'checked' : ''; ?>>
                                    Dissertações
                                </label>
                                <label>
                                    <input type="checkbox" name="categoria[]" value="Artigos"
                                        <?php echo (isset($_GET['categoria']) && in_array('Artigos', $_GET['categoria'])) ? 'checked' : ''; ?>>
                                    Artigos
                                </label>
                            </div>
                            <div class="filter-note">Mantenha Ctrl pressionado para selecionar múltiplas opções</div>
                        </div>

                        <!-- Anos -->
                        <div class="filter-section">
                            <h5 style="color: black; font-weight:400;font-size:18px">Anos</h5>
                            <div class="filter-options">
                                <?php
                                for ($year = date("Y"); $year >= 2000; $year--) {
                                    $checked = (isset($_GET['ano']) && in_array($year, $_GET['ano'])) ? 'checked' : '';
                                    echo "<label>";
                                    echo "<input type='checkbox' name='ano[]' value='$year' $checked>";
                                    echo "$year";
                                    echo "</label>";
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Autores -->
                        <div class="filter-section">
                            <h5 style="color: black; font-weight:400;font-size:18px">Autores</h5>
                            <div class="filter-options">
                                <?php
                                $autoresResult = $conn->query("SELECT DISTINCT autor FROM arquivos ORDER BY autor ASC");
                                if ($autoresResult && $autoresResult->num_rows > 0) {
                                    while ($row = $autoresResult->fetch_assoc()) {
                                        $checked = (isset($_GET['autor']) && in_array($row['autor'], $_GET['autor'])) ? 'checked' : '';
                                        $autor = htmlspecialchars($row['autor']);
                                        echo "<label>";
                                        echo "<input type='checkbox' name='autor[]' value='$autor' $checked>";
                                        echo "$autor";
                                        echo "</label>";
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Períodos -->
                        <div class="filter-section">
                            <h5 style="color: black; font-weight:400;font-size:18px">Períodos</h5>
                            <div class="filter-options">
                                <label>
                                    <input type="checkbox" name="periodo[]" value="periodico"
                                        <?php echo (isset($_GET['periodo']) && in_array('periodico', $_GET['periodo'])) ? 'checked' : ''; ?>>
                                    Periódico
                                </label>
                                <label>
                                    <input type="checkbox" name="periodo[]" value="anuais"
                                        <?php echo (isset($_GET['periodo']) && in_array('anuais', $_GET['periodo'])) ? 'checked' : ''; ?>>
                                    Anuais
                                </label>
                            </div>
                        </div>


                        <div class="filter-buttons">
                            <button type="submit" class="btn-apply-filter">Aplicar Filtros</button>
                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn-clear-filter">Limpar Filtros</a>
                        </div>

                    </form>
                </div>
            </div>


            <!-- Lista de Publicações -->
            <div class="col-md-9">
                <div class="publications-section">
                    <h2 class='filters-title'>Lista de Publicações</h2>
                    <div class="mb-3">
                        <div class="search-bar-section">
                            <form method="get" action="">
                                <div class="input-group">
                                    <input type="text" class="form-control search-input" name="search"
                                        placeholder="Pesquisar em todas as publicações (título, descrição, autor, categoria, ano...)"
                                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search me-2"></i>Pesquisar
                                    </button>
                                    <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
                                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">
                                            <i class="fas fa-times me-2"></i>Limpar
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Título</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Ano</th>
                                        <th scope="col">Autor</th>
                                        <th scope="col">Data de Upload</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Lógica de filtros com prepared statements
                                    $sql = "SELECT * FROM arquivos WHERE 1=1";
                                    $params = array();
                                    $types = "";

                                    // Adicionar busca por termo
                                    if (!empty($_GET['search'])) {
                                        $searchTerm = '%' . $_GET['search'] . '%';
                                        $sql .= " AND (titulo LIKE ? OR descricao LIKE ? OR categoria LIKE ? OR ano LIKE ? OR autor LIKE ? OR periodo LIKE ? OR link LIKE ?)";
                                        for ($i = 0; $i < 7; $i++) {
                                            $params[] = $searchTerm;
                                            $types .= "s";
                                        }
                                    }
                                    if (!empty($_GET['categoria'])) {
                                        $placeholders = implode(',', array_fill(0, count($_GET['categoria']), '?'));
                                        $sql .= " AND categoria IN ($placeholders)";
                                        foreach ($_GET['categoria'] as $cat) {
                                            $params[] = $cat;
                                            $types .= "s";
                                        }
                                    }
                                    if (!empty($_GET['ano'])) {
                                        $placeholders = implode(',', array_fill(0, count($_GET['ano']), '?'));
                                        $sql .= " AND ano IN ($placeholders)";
                                        foreach ($_GET['ano'] as $ano) {
                                            $params[] = $ano;
                                            $types .= "s";
                                        }
                                    }
                                    if (!empty($_GET['autor'])) {
                                        $placeholders = implode(',', array_fill(0, count($_GET['autor']), '?'));
                                        $sql .= " AND autor IN ($placeholders)";
                                        foreach ($_GET['autor'] as $autor) {
                                            $params[] = $autor;
                                            $types .= "s";
                                        }
                                    }
                                    if (!empty($_GET['periodo'])) {
                                        $placeholders = implode(',', array_fill(0, count($_GET['periodo']), '?'));
                                        $sql .= " AND periodo IN ($placeholders)";
                                        foreach ($_GET['periodo'] as $periodo) {
                                            $params[] = $periodo;
                                            $types .= "s";
                                        }
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
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td><span class='row-number' data-label='ID'>" . htmlspecialchars($row['id']) . "</span></td>";
                                                echo "<td data-label='Título'><strong>" . htmlspecialchars($row['titulo']) . "</strong></td>";
                                                echo "<td data-label='Descrição'>" . htmlspecialchars($row['descricao']) . "</td>";
                                                echo "<td data-label='Categoria'><span class='badge bg-secondary'>" . htmlspecialchars($row['categoria']) . "</span></td>";
                                                echo "<td data-label='Ano'>" . htmlspecialchars($row['ano']) . "</td>";
                                                echo "<td data-label='Autor'>" . htmlspecialchars($row['autor']) . "</td>";
                                                echo "<td data-label='Data de Upload'>" . date('d/m/Y', strtotime($row['data_upload'])) . "</td>";
                                                echo "<td>";
                                                echo "<a href='" . htmlspecialchars($row['link']) . "' target='_blank' class='btn-view' aria-label='Visualizar publicação: " . htmlspecialchars($row['titulo']) . "'>";
                                                echo "<i class='fas fa-eye'></i> Visualizar";
                                                echo "</a>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='8' class='text-center text-muted py-4'>";
                                            echo "<i class='fas fa-search fa-2x mb-2 d-block'></i>";
                                            echo "Nenhuma publicação encontrada com os filtros selecionados.";
                                            echo "</td></tr>";
                                        }

                                        $stmt->close();
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center text-danger'>Erro ao preparar consulta.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="navbar fixed-bottom bg-footer">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <a class="navbar-brand" href="Home.html">
                    <img src="Img/icones/Logo_rumoPNG.png" alt="Logo Rumo" width="60" height="40" class="d-inline-block align-text-top">
                </a>

                <div class="d-flex flex-nowrap align-items-center logo-patrocinio-group">
                    <a class="navbar-brand mx-2" href="#"><img src="Img/icones/logo_fapesp.png" alt="FAPESP" class="logo-patrocinio"></a>
                    <a class="navbar-brand mx-2" href="#"><img src="Img/icones/CNPq_v2017_rgb.png" alt="CNPq" class="logo-patrocinio"></a>
                    <a class="navbar-brand mx-2" href="#"><img src="Img/icones/banner_capes-1024x871.png" alt="CAPES" class="logo-patrocinio capes-logo"></a>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>