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
       /* Hero Section */
        .hero-section {
            background: var(--gradient-primary);
            color: white;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
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
            0% { transform: translate(0, 0) rotate(0deg); }
            100% { transform: translate(-10px, -10px) rotate(360deg); }
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
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
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
            0%, 20%, 50%, 80%, 100% {
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
            padding:  0;
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
            border: 1px solid rgba(255,255,255,0.2);
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
            text-align: justify;
        }

        .app-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-app {
            background: var(--gradient-primary);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
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
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-app:hover::before {
            left: 100%;
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
            --shadow-light: 0 4px 20px rgba(0,0,0,0.1);
            --shadow-medium: 0 8px 30px rgba(0,0,0,0.15);
            --shadow-heavy: 0 15px 50px rgba(0,0,0,0.2);
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
              <a class=" nav-link2" aria-current="page" href="Home.php" >Home</a>
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
        <!--<h3 style="text-transform: uppercase;">Aplicativos</h3>-->
      </div>
    </div>
    </div>

 
    
 

<!-- Main pagina
<div class="container text-center">
      
  <div class="row row-cols-3" style="margin-left: 5%; margin-top: 5%;">
    
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <img src="Img/images.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Homotetia</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        
        <div class="card-body">
          <a href="#" class="card-link">Descrição</a>
          <a href="#" class="card-link">Atividade</a>
        </div>
      </div>
      
    </div>
    
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <img src="Img/images.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Homotetia</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        
        <div class="card-body">
          <a href="#" class="card-link">Descrição</a>
          <a href="#" class="card-link">Atividade</a>
        </div>
      </div>
    </div>
    

    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <img src="Img/images.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Homotetia</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
        
        <div class="card-body">
          <a href="#" class="card-link">Descrição</a>
          <a href="#" class="card-link">Atividade</a>
        </div>
      </div>
    </div>
    
   
  </div>
</div>-->



<!--
<div class="container text-center respons-foot">
  <div class="row g-2">
    <div class="col-3">
      <div class="p-3">
        <div class="card" style="width: 100%;">
          <img src="Img/imgs_old/aplicativo_1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h3>MusiCALcolorida </h3>
            <p class="card-text" style="text-align: justify;">A MusiCALcolorida é uma ferramenta digital planejada para abordar o conceito de número real de forma multissensorial, por meio de cores e música.</p>
            <a onclick="downloadExe()" href="Aplicativos/Calcolorida_v6.exe" class="btn btn-primary">Atividade</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="p-3">
        <div class="card" style="width: 100%;">
          <img src="Img/imgs_old/aplicativo_2.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h3>Mathsticks </h3>
            <p class="card-text" style="text-align: justify;">O Mathsticks é uma ferramenta digital que permite pensar sobre generalizações de padrões figurais, no qual podemos explorar simultaneamente interações visuais e dinâmicas e suas representações simbólicas.</p>
            <a onclick="downloadExe()" href="Aplicativos/mathsticks (portugues).exe" class="btn btn-primary">Atividade</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="p-3">
        <div class="card" style="width: 100%;">
          <img src="Img/imgs_old/aplicativo_4.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h3>Ritmática</h3>
            <p class="card-text" style="text-align: justify;">O Ritmática é um micromundo no qual o aluno pode trabalhar matematicamente com som e/ou com imagens visuais e dinâmicas para explorar ideias relacionadas à razão e proporção. O ponto de partida para o seu design foi o uso de ritmos e polirrítmos como expressões matemáticas.</p>
            <a onclick="downloadExe()" href="Aplicativos/ritmatica_beta_site.exe" class="btn btn-primary">Atividade</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-3">
      <div class="p-3">
        <div class="card" style="width: 100%;">
          <img src="Img/imgs_old/aplicativo_5.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h3>Transtaruga</h3>
            <p class="card-text" style="text-align: justify;">No micromundo Transtaruga, o aluno interage com a Geometria das Tartarugas para explorar ideias relacionadas às Transformações Geométricas.</p>
            <a onclick="downloadExe()" href="Aplicativos/trans_taruga_v1_At1-8.exe" class="btn btn-primary">Atividade</a>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div> -->

<section class="apps-section" id="aplicativos">
        <div class="container">
            <div class="section-title scroll-animate">
                <h2>Nossos Aplicativos</h2>
                <p>Descubra ferramentas digitais desenvolvidas especialmente para tornar o aprendizado de matemática mais acessível e envolvente para todos os estudantes.</p>
            </div>

            <div class="row g-4">
                <!-- MusiCALcolorida -->
                <div class="col-lg-6 col-xl-3 loading" style="animation-delay: 0.1s;">
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
                                <a class="btn-app" onclick="downloadExe()" href="Aplicativos/Calcolorida_v6.exe">
                                    <i class="fas fa-download"></i>
                                    Baixar App
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mathsticks -->
                <div class="col-lg-6 col-xl-3 loading" style="animation-delay: 0.2s;">
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
                                <a class="btn-app" onclick="downloadExe()" href="Aplicativos/mathsticks (portugues).exe">
                                    <i class="fas fa-download"></i>
                                    Baixar App
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ritmática -->
                <div class="col-lg-6 col-xl-3 loading" style="animation-delay: 0.3s;">
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
                                <a  class="btn-app" onclick="downloadExe()" href="Aplicativos/ritmatica_beta_site.exe">
                                    <i class="fas fa-download"></i>
                                    Baixar App
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transtaruga -->
                <div class="col-lg-6 col-xl-3 loading" style="animation-delay: 0.4s;">
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
                                <a  class="btn-app" onclick="downloadExe()" href="Aplicativos/trans_taruga_v1_At1-8.exe">
                                    <i class="fas fa-download"></i>
                                    Baixar App
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
  

  

    

  

  <footer class="navbar  fixed-bottom bg-footer">
    <div class="container-fluid">
      <a class="navbar-brand" href="Home.html"><img src="Img/icones/Logo_rumoPNG.png" alt="Logo" width="70" height="50" class="d-inline-block align-text-top" style="margin-left: 15px;"></a>
      <div class="d-flex" >
        <a class="navbar-brand" ><img src="Img/icones/logo_fapesp.png" alt="Logo" width="90" height="50" class="d-inline-block align-text-top" style="margin-left: 15px;"></a>
        <a class="navbar-brand" ><img src="Img/icones/CNPq_v2017_rgb.png" alt="Logo" width="90" height="40" class="d-inline-block align-text-top" style="margin-left: 15px;"></a>
        <a class="navbar-brand" ><img src="Img/icones/banner_capes-1024x871.png" alt="Logo" width="70" height="50" class="d-inline-block align-text-top" style="margin-left: 15px;object-fit:contain ;"></a>
      </div>
    </div>
  </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/baixar_app_e_descricao.js"></script>
  </body>
</html>