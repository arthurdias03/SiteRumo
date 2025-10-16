<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Site Rumo</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #1a6ddaff;
      --secondary-color: #328de2ff;
      --accent-color: #fd7e14;
      --success-color: #0077e7ff;
      --warning-color: #ffc107;
      --danger-color: #dc3545;
      --dark-color: #343a40;
      --light-color: #f8f9fa;
      --gradient-primary: linear-gradient(135deg, #40a3e6ff 0%, #2a59f5ff 100%);
      --gradient-secondary: linear-gradient(135deg, #257bebff 0%, #8fc0f8ff 100%);
      --gradient-accent: linear-gradient(135deg, #779ff7ff 0%, #1778e7ff 100%);
      --shadow-light: 0 4px 20px rgba(0, 0, 0, 0.1);
      --shadow-medium: 0 8px 30px rgba(0, 0, 0, 0.15);
      --shadow-heavy: 0 15px 50px rgba(0, 0, 0, 0.2);
    }

    /* Materials Grid */
    .materials-section {
      padding: 0;
      margin-bottom: 10rem;
    }

    .section-title {
      text-align: center;
      margin-bottom: 4rem;
    }

    .section-title h2 {
      font-size: 2.5rem;
      font-weight: 700;
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

    .material-card {
      background: white;
      border-radius: 25px;
      box-shadow: var(--shadow-light);
      overflow: hidden;
      transition: all 0.4s ease;
      height: 100%;
      position: relative;
      border: 2px solid transparent;
    }

    .material-card:hover {
      transform: translateY(-15px) rotate(1deg);
      box-shadow: var(--shadow-heavy);
      border-color: var(--primary-color);
    }

    .material-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 6px;
      background: var(--gradient-accent);
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    .material-card:hover::before {
      transform: scaleX(1);
    }

    .material-image {
      position: relative;
      overflow: hidden;
      height: 280px;
      background: var(--gradient-secondary);
    }

    .material-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .material-card:hover .material-image img {
      transform: scale(1.1) rotate(-2deg);
    }

    .material-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, rgba(65, 100, 255, 0.8), rgba(0, 132, 255, 0.8));
      opacity: 0;
      transition: opacity 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      gap: 1rem;
    }

    .material-card:hover .material-overlay {
      opacity: 1;
    }

    .overlay-icon {
      color: white;
      font-size: 3rem;
      animation: bounce 2s infinite;
    }

    .overlay-text {
      color: white;
      font-weight: 600;
      font-size: 1.1rem;
    }

    @keyframes bounce {

      0%,
      20%,
      50%,
      80%,
      100% {
        transform: translateY(0);
      }

      40% {
        transform: translateY(-10px);
      }

      60% {
        transform: translateY(-5px);
      }
    }

    .material-content {
      padding: 2.5rem;
    }

    .material-title {
      font-size: 1.6rem;
      font-weight: 700;
      color: var(--primary-color);
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .material-description {

      margin-bottom: 2.5rem;
      line-height: 1.7;
      text-align: justify;
      font-size: 1rem;
    }

    .material-actions {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .btn-material {
      background: var(--gradient-primary);
      border: none;
      color: white;
      padding: 0.875rem 2rem;
      border-radius: 30px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      font-size: 0.95rem;
    }

    .btn-material:hover {
      color: white;
      transform: translateY(-3px) scale(1.05);
      box-shadow: 0 10px 30px rgba(40, 167, 69, 0.4);
    }

    .btn-material::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.6s;
    }

    .btn-material:hover::before {
      left: 100%;
    }

    .btn-secondary {
      background: var(--gradient-secondary);
    }

    .btn-secondary:hover {
      box-shadow: 0 10px 30px rgba(255, 154, 158, 0.4);
    }



    /* Responsive Design */
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }

      .hero-subtitle {
        font-size: 1.1rem;
      }

      .section-title h2 {
        font-size: 2rem;
      }

      .material-actions {
        flex-direction: column;
      }

      .btn-material {
        text-align: center;
        justify-content: center;
      }

      .newsletter-form {
        flex-direction: column;
      }

      .newsletter-input {
        min-width: auto;
      }

      .footer-content {
        flex-direction: column;
        text-align: center;
      }

      .footer-sponsors {
        justify-content: center;
      }
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
  </style>
</head>

<body>
  <!--Menu--> <!-- CRIAR MENU SANDUICHE-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-body-blue" aria-label="Tenth navbar example">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
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
          <img src="Img/icones/Logo_rumoPNG.png" alt="Logo" width="100" height="100" class="d-inline-block align-text-top">

        </div>
      </div>
      <div class="col">
        <h2>Rumo á Educação Matemática Inclusiva</h2>
      </div>
    </div>
  </div>

  <div class="icon-menu">
    <div class="row align-items-center">
      <div class="col-auto">

      </div>
      <div class="col">
        <!--<h3 style="text-transform: uppercase;">MATERIAIS DIDÁTICOS</h3> -->
      </div>
    </div>
  </div>









  <!-- Materials Section -->
  <section class="materials-section" id="materiais">
    <div class="container">
      <div class="section-title scroll-animate">
        <h2>Nossos Materiais Didáticos</h2>
        <p>Explore nossa coleção de materiais didáticos desenvolvidos especialmente para promover uma educação matemática inclusiva e acessível a todos os estudantes.</p>
      </div>

      <div class="row g-5 justify-content-center">
        <!-- Homotetia -->
        <div class="col-lg-6 loading" style="animation-delay: 0.1s;">
          <div class="material-card scroll-animate">
            <div class="material-image">
              <img src="Pages/Img/imgs_old/materiais_didáticos_1.png" alt="Material Homotetia">
              <div class="material-overlay">
                <i class="fas fa-expand-arrows-alt overlay-icon"></i>
                <div class="overlay-text">Transformações Geométricas</div>
              </div>
            </div>
            <div class="material-content">
              <h3 class="material-title">
                <i class="fas fa-vector-square"></i>
                Homotetia
              </h3>
              <p class="material-description">
                Esta ferramenta pedagógica foi especialmente planejada para que aprendizes cegos pudessem realizar tarefas relacionadas ao estudo de homotetia de forma tátil e compreensível. O material oferece uma abordagem multissensorial que facilita a compreensão de conceitos geométricos complexos através de diferentes estímulos sensoriais.
              </p>
              <div class="material-actions">
                <a class="btn-material" target='_blank' href="Materiais/homotetia.pdf">
                  <i class="fas fa-file-pdf"></i>
                  Descrição
                </a>
                <a class="btn-material btn-secondary" target='_blank' href="Materiais/homotetia-atividade.pdf">
                  <i class="fas fa-tasks"></i>
                  Atividade
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Matrizmat -->
        <div class="col-lg-6 loading" style="animation-delay: 0.2s;">
          <div class="material-card scroll-animate">
            <div class="material-image">
              <img src="Img/imgs_old//materiais_didáticos_2.png" alt="Material Matrizmat">
              <div class="material-overlay">
                <i class="fas fa-th overlay-icon"></i>
                <div class="overlay-text">Álgebra Linear</div>
              </div>
            </div>
            <div class="material-content">
              <h3 class="material-title">
                <i class="fas fa-table"></i>
                Matrizmat
              </h3>
              <p class="material-description">
                A ferramenta Matrizmat foi cuidadosamente planejada para oferecer diferentes estímulos sensoriais para aprendizes de classes inclusivas, com o objetivo de facilitar o acesso ao conceito matemático de matrizes. Este material inovador combina elementos visuais, táteis e auditivos para criar uma experiência de aprendizado verdadeiramente inclusiva.
              </p>
              <div class="material-actions">
                <a target="_blank" class="btn-material" href="Materiais/matrixmat-descricao.pdf">
                  <i class="fas fa-file-pdf"></i>
                  Descrição
                </a>
                <a target="_blank" class="btn-material btn-secondary">
                  <i class="fas fa-clock"></i>
                  Em Breve
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>











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

  <script src="js/baixar_materiais.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>