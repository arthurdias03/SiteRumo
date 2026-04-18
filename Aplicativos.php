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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <style>
    /* Hero Section */
    .hero-section {
      background: var(--gradient-primary);
      color: white;
      padding: 4rem 0;
      position: relative;
      overflow: hidden;
    }
        @media (min-width: 1200px) {
      .col-xl-2-4 {
        flex: 0 0 20%;
        max-width: 20%;
      }
    }

    .hero-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
      animation: float 20s linear infinite;
    }

    @keyframes float {
      0% {
        transform: translate(0, 0) rotate(0deg);
      }

      100% {
        transform: translate(-10px, -10px) rotate(360deg);
      }
    }

    .hero-content {
      position: relative;
      z-index: 1;
      text-align: center;
    }

    .hero-title {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 1rem;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
      animation: slideInUp 1s ease-out;
    }

    .hero-subtitle {
      font-size: 1.3rem;
      opacity: 0.9;
      margin-bottom: 2rem;
      animation: slideInUp 1s ease-out 0.2s both;
    }

    .hero-icon {
      font-size: 4rem;
      margin-bottom: 2rem;
      animation: bounce 2s infinite;
    }

    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
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

    /* Apps Grid */
    .apps-section {
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
      color: #6c757d;
      max-width: 600px;
      margin: 0 auto;
    }

    .app-card {
      background: white;
      border-radius: 20px;
      box-shadow: var(--shadow-light);
      overflow: hidden;
      transition: all 0.4s ease;
      height: 100%;
      position: relative;
      border: 1px solid rgba(255, 255, 255, 0.2);
      /* MODIFICAÇÃO: transforma o card em coluna flex */
      display: flex;
      flex-direction: column;
    }

    .app-card:hover {
      transform: translateY(-10px) scale(1.02);
      box-shadow: var(--shadow-heavy);
    }

    .app-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: var(--gradient-accent);
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    .app-card:hover::before {
      transform: scaleX(1);
    }

    .app-image {
      position: relative;
      overflow: hidden;
      height: 250px;
      /* MODIFICAÇÃO: garante que a imagem não encolhe */
      flex-shrink: 0;
    }

    .app-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .app-card:hover .app-image img {
      transform: scale(1.1);
    }

    .app-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(45deg, rgba(44, 90, 160, 0.8), rgba(23, 162, 184, 0.8));
      opacity: 0;
      transition: opacity 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .app-card:hover .app-overlay {
      opacity: 1;
    }

    .overlay-icon {
      color: white;
      font-size: 3rem;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.1);
      }

      100% {
        transform: scale(1);
      }
    }

    .app-content {
      padding: 2rem;
      /* MODIFICAÇÃO: ocupa o espaço restante e organiza em coluna */
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .app-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--primary-color);
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .app-description {
      color: #6c757d;
      margin-bottom: 2rem;
      line-height: 1.6;
      text-align: center;
      /* MODIFICAÇÃO: empurra os botões para o fundo */
      flex: 1;
    }

    .app-actions {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 0.5rem;
      /* MODIFICAÇÃO: garante que os botões ficam sempre no final */
      margin-top: auto;
    }

    .btn-app {
      background: var(--gradient-primary);
      border: none;
      color: white;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      text-align: center;
      gap: 0.5rem;
    }

    .btn-app:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(44, 90, 160, 0.3);
    }

    .btn-app::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s;
    }

    .btn-app:hover::before {
      left: 100%;
    }

    .btn-app i {
      position: absolute;
      left: 1.5rem;
    }

    .btn-secondary {
      background: var(--gradient-secondary);
    }

    .btn-secondary:hover {
      box-shadow: 0 8px 25px rgba(240, 147, 251, 0.3);
    }

    /* Stats Section */
    .stats-section {
      background: var(--gradient-primary);
      color: white;
      padding: 4rem 0;
      position: relative;
    }

    .stats-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
    }

    .stats-content {
      position: relative;
      z-index: 1;
    }

    .stat-item {
      text-align: center;
      padding: 2rem;
    }

    .stat-number {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
      color: var(--warning-color);
    }

    .stat-label {
      font-size: 1.1rem;
      opacity: 0.9;
    }

    :root {
      --primary-color: #2c5aa0;
      --secondary-color: #17a2b8;
      --accent-color: #6f42c1;
      --success-color: #28a745;
      --warning-color: #ffc107;
      --danger-color: #dc3545;
      --dark-color: #343a40;
      --light-color: #f8f9fa;
      --gradient-primary: linear-gradient(135deg, #667eea 0%, #2f63f0ff 100%);
      --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      --gradient-accent: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      --shadow-light: 0 4px 20px rgba(0, 0, 0, 0.1);
      --shadow-medium: 0 8px 30px rgba(0, 0, 0, 0.15);
      --shadow-heavy: 0 15px 50px rgba(0, 0, 0, 0.2);
    }

    /* Estilos para a barra de navegação do footer */
    .bg-footer {
      padding: 1px 0;
      height: 60px;
      box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Estilos gerais para as imagens de patrocínio no footer */
    .logo-patrocinio {
      max-width: 60px;
      height: 40px;
      object-fit: contain;
    }

    .capes-logo {
      max-width: 50px;
      height: 40px;
    }

    @media (max-width: 576px) {
      .logo-patrocinio-group {
        gap: 5px;
      }
    }
  </style>
</head>

<body>
  <!--Menu-->
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
      <div class="col-auto"></div>
      <div class="col"></div>
    </div>
  </div>

  <section class="apps-section" id="aplicativos">
    <div class="container">
      <div class="section-title scroll-animate">
        <h2>Nossos Aplicativos</h2>
        <p>Descubra ferramentas digitais desenvolvidas especialmente para tornar o aprendizado de matemática mais acessível e envolvente para todos os estudantes.</p>
      </div>

      <div class="row g-4">
        <!-- Brincamática -->
        <div class="col-lg-6 col-xl-2-4 loading" style="animation-delay: 0.1s;">
          <div class="app-card scroll-animate">
            <div class="app-image">
              <img src="Img/imgs_old/brincamatica.png" alt="Brincamática">
              <div class="app-overlay">
                <i class="fas fa-sync-alt overlay-icon"></i>
              </div>
            </div>
            <div class="app-content">
              <h3 class="app-title">
                <i class="fas fa-turtle"></i>
                Brincamática
              </h3>
              <p class="app-description">
                Aplicativo voltado às crianças de 5 a 7 anos, composto pelos jogos Criar Melodia,
                Sheldon, Combina Som e Jogo da Memória que constituem uma experiência que envolve diferentes sentidos,
                combinando sons, imagens, movimentos e cores, como forma de ampliar as possibilidades de interação e participação das crianças.
              </p>
              <div class="app-actions">
                <span class="fw-bold" style="color: var(--primary-color);">Versão:</span>
                <a class="btn-app" href="Aplicativos/Brincamatica_1.6.apk">
                  <i class="fas fa-download"></i>
                  Android
                </a>
                <a class="btn-app" href="Aplicativos/web_brincamatica/index.html" target="_blank" rel="noopener noreferrer">
                  <i class="fas fa-download"></i>
                  Web
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Mathsticks -->
        <div class="col-lg-6 col-xl-2-4 loading" style="animation-delay: 0.2s;">
          <div class="app-card scroll-animate">
            <div class="app-image">
              <img src="Img/imgs_old/aplicativo_2.jpg" alt="Mathsticks">
              <div class="app-overlay">
                <i class="fas fa-shapes overlay-icon"></i>
              </div>
            </div>
            <div class="app-content">
              <h3 class="app-title">
                <i class="fas fa-vector-square"></i>
                Mathsticks
              </h3>
              <p class="app-description">
                Ferramenta digital que permite explorar generalizações de padrões figurais através de interações visuais dinâmicas e suas representações simbólicas, facilitando a compreensão de conceitos matemáticos abstratos.
              </p>
              <div class="app-actions">
                <span class="fw-bold" style="color: var(--primary-color);">Versão:</span>
                <a class="btn-app" href="Aplicativos/Mathsticks_1.2.apk">
                  <i class="fas fa-download"></i>
                  Android
                </a>
                <a class="btn-app" href="../Aplicativos/web_mathsticks/index.html" target="_blank" rel="noopener noreferrer">
                  <i class="fas fa-download"></i>
                  Web
                </a>
                <a class="btn-app" onclick="downloadExe()" href="Aplicativos/mathsticks (portugues).exe">
                  <i class="fas fa-download"></i>
                  Windows
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- MusiCALcolorida -->
        <div class="col-lg-6 col-xl-2-4 loading" style="animation-delay: 0.3s;">
          <div class="app-card scroll-animate">
            <div class="app-image">
              <img src="Img/imgs_old/aplicativo_1.jpg" alt="MusiCALcolorida">
              <div class="app-overlay">
                <i class="fas fa-music overlay-icon"></i>
              </div>
            </div>
            <div class="app-content">
              <h3 class="app-title">
                <i class="fas fa-palette"></i>
                MusiCALcolorida
              </h3>
              <p class="app-description">
                Uma ferramenta digital inovadora que aborda o conceito de número real de forma multissensorial, combinando cores vibrantes e música envolvente para criar uma experiência de aprendizado única e inclusiva.
              </p>
              <div class="app-actions">
                <span class="fw-bold" style="color: var(--primary-color);">Versão:</span>
                <a class="btn-app" href="Aplicativos/MusicalColorida_1.1_android.apk">
                  <i class="fas fa-download"></i>
                  Android
                </a>
                <a class="btn-app" href="../Aplicativos/web_musicalColorida/index.html" target="_blank" rel="noopener noreferrer">
                  <i class="fas fa-download"></i>
                  Web
                </a>
                <a class="btn-app" onclick="downloadExe()" href="Aplicativos/Calcolorida_v6.exe">
                  <i class="fas fa-download"></i>
                  Windows
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Ritmática -->
        <div class="col-lg-6 col-xl-2-4 loading" style="animation-delay: 0.4s;">
          <div class="app-card scroll-animate">
            <div class="app-image">
              <img src="Img/imgs_old/aplicativo_4.jpg" alt="Ritmática">
              <div class="app-overlay">
                <i class="fas fa-drum overlay-icon"></i>
              </div>
            </div>
            <div class="app-content">
              <h3 class="app-title">
                <i class="fas fa-music"></i>
                Ritmática
              </h3>
              <p class="app-description">
                Micromundo inovador onde estudantes trabalham matematicamente com som e imagens visuais dinâmicas para explorar conceitos de razão e proporção através de ritmos e polirrítmos como expressões matemáticas.
              </p>
              <div class="app-actions">
                <span class="fw-bold" style="color: var(--primary-color);">Versão:</span>
                <a class="btn-app" href="Aplicativos/Ritmatica_1.3_android.apk">
                  <i class="fas fa-download"></i>
                  Android
                </a>
                <a class="btn-app" href="../Aplicativos/web_ritmatica/index.html" target="_blank" rel="noopener noreferrer">
                  <i class="fas fa-download"></i>
                  Web
                </a>
                <a class="btn-app" onclick="downloadExe()" href="Aplicativos/ritmatica_beta_site.exe">
                  <i class="fas fa-download"></i>
                  Windows
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Transtaruga -->
        <div class="col-lg-6 col-xl-2-4 loading" style="animation-delay: 0.5s;">
          <div class="app-card scroll-animate">
            <div class="app-image">
              <img src="Img/imgs_old/aplicativo_5.jpg" alt="Transtaruga">
              <div class="app-overlay">
                <i class="fas fa-sync-alt overlay-icon"></i>
              </div>
            </div>
            <div class="app-content">
              <h3 class="app-title">
                <i class="fas fa-turtle"></i>
                Transtaruga
              </h3>
              <p class="app-description">
                No micromundo Transtaruga, estudantes interagem com a Geometria das Tartarugas para explorar e compreender conceitos relacionados às Transformações Geométricas de forma visual e intuitiva.
              </p>
              <div class="app-actions">
                <span class="fw-bold" style="color: var(--primary-color);">Versão:</span>
                <a class="btn-app" onclick="downloadExe()" href="Aplicativos/trans_taruga_v1_At1-8.exe">
                  <i class="fas fa-download"></i>
                  Windows
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="js/baixar_app_e_descricao.js"></script>
</body>

</html>