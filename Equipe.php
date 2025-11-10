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
      --shadow-light: 0 4px 20px rgba(0, 0, 0, 0.1);
      --shadow-medium: 0 8px 30px rgba(0, 0, 0, 0.15);
      --shadow-heavy: 0 15px 50px rgba(0, 0, 0, 0.2);
    }

    .section-title {
      text-align: center;
      margin-top: 5rem;
      margin-bottom: 7rem;
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
        <div class="section-title scroll-animate">
          <h2>Nossa Equipe</h2>

        </div>
      </div>
    </div>
  </div>

  <!-- Main pagina-->
  <div class="container-fluid py-0 respons-foot">
    <div class="container">
      <h3 class=" text-center mb-5" style="text-transform: uppercase;"></h3>
      <div class="row align-items-center">
        <div class="col-md-4" style="text-align:center;padding-bottom:40px;">
          <img class="position-relative rounded-circle shadow mx-auto card-hover" src="img/equipe rumo/foto1.jfif"
            style="width: 150px; height: 150px; margin-bottom: -50px; z-index: 1;object-fit: cover;border-radius: 5px;"
            alt="">
          <div class=" text-center p-4 pt-0" style="min-height: 220px;margin-top: 80px;">
            <h4 class="font-weight-medium mt-5">Roberta Caetano Fleira</h4>

            <a class="btn btn-primary" href="http://lattes.cnpq.br/3052067471176140" target="_blank" role="button"
              style="width: 150px;height:50px;margin-top: 10px;">

              <h5 class="align-items-center" style="margin-top: 5px;">Lattes <img src="Img/icones/icone-lattes.png"
                  width="30px" height="30px" alt="" style="object-fit: cover;margin-bottom: 2px;"></h5>

            </a>


          </div>
        </div>

        <div class="col-md-4" style="text-align:center;padding-bottom:40px;">
          <img class="position-relative rounded-circle shadow mx-auto card-hover" src="img/equipe rumo/luis fernando.jfif"
            style="width: 150px; height: 150px; margin-bottom: -50px; z-index: 1;object-fit: cover;border-radius: 5px;"
            alt="">
          <div class=" text-center p-4 pt-0" style="min-height: 220px;margin-top: 80px;">
            <h4 class="font-weight-medium mt-5">Prof. Dr. Luis Fernando Pacheco Pereira</h4>

            <a class="btn btn-primary" href="https://lattes.cnpq.br/9238876200298387" target="_blank" role="button"
              style="width: 150px;height:50px;margin-top: 10px;">

              <h5 class="align-items-center" style="margin-top: 5px;">Lattes <img src="Img/icones/icone-lattes.png"
                  width="30px" height="30px" alt="" style="object-fit: cover;margin-bottom: 2px;"></h5>

            </a>


          </div>
        </div>

        <div class="col-md-4" style="text-align:center;padding-bottom:40px;">
          <img class="position-relative rounded-circle shadow mx-auto card-hover" src="img/equipe rumo/CarlosEduardo.jfif"
            style="width: 150px; height: 150px; margin-bottom: -50px; z-index: 1;object-fit: cover;border-radius: 5px;"
            alt="">
          <div class=" text-center p-4 pt-0" style="min-height: 220px;margin-top: 80px;">
            <h4 class="font-weight-medium mt-5">Carlos Eduardo Rocha dos Santos</h4>

            <a class="btn btn-primary" href="http://lattes.cnpq.br/1577127826706948" target="_blank" role="button"
              style="width: 150px;height:50px;margin-top: 10px;">

              <h5 class="align-items-center" style="margin-top: 5px;">Lattes <img src="Img/icones/icone-lattes.png"
                  width="30px" height="30px" alt="" style="object-fit: cover;margin-bottom: 2px;"></h5>

            </a>


          </div>
        </div>


        <div class="col-md-4" style="text-align:center;padding-bottom:40px;">
          <img class="position-relative rounded-circle shadow mx-auto card-hover" src="img/equipe rumo/Elizabete.jfif"
            style="width: 150px; height: 150px; margin-bottom: -50px; z-index: 1;object-fit: cover;border-radius: 5px;"
            alt="">
          <div class=" text-center p-4 pt-0" style="min-height: 220px;margin-top: 80px;">
            <h4 class="font-weight-medium mt-5">Elizabete Leopoldina da Silva</h4>

            <a class="btn btn-primary" href="http://lattes.cnpq.br/2173053955944201" target="_blank" role="button"
              style="width: 150px;height:50px;margin-top: 10px;">

              <h5 class="align-items-center" style="margin-top: 5px;">Lattes <img src="Img/icones/icone-lattes.png"
                  width="30px" height="30px" alt="" style="object-fit: cover;margin-bottom: 2px;"></h5>

            </a>


          </div>
        </div>

        <div class="col-md-4" style="text-align:center;padding-bottom:40px;">
          <img class="position-relative rounded-circle shadow mx-auto card-hover" src="img/equipe rumo/paulaSoares.jfif"
            style="width: 150px; height: 150px; margin-bottom: -50px; z-index: 1;object-fit: cover;border-radius: 5px;"
            alt="">
          <div class=" text-center p-4 pt-0" style="min-height: 220px;margin-top: 80px;">
            <h4 class="font-weight-medium mt-5">Paula Soares Gomes da Silva</h4>

            <a class="btn btn-primary" href="http://lattes.cnpq.br/2605878541424554" target="_blank" role="button"
              style="width: 150px;height:50px;margin-top: 10px;">

              <h5 class="align-items-center" style="margin-top: 5px;">Lattes <img src="Img/icones/icone-lattes.png"
                  width="30px" height="30px" alt="" style="object-fit: cover;margin-bottom: 2px;"></h5>

            </a>


          </div>
        </div>
        

        <div class="col-md-4" style="text-align:center;padding-bottom:40px;">
          <img class="position-relative rounded-circle shadow mx-auto card-hover" src="img/equipe rumo/Tula.jfif"
            style="width: 150px; height: 150px; margin-bottom: -50px; z-index: 1;object-fit: cover;border-radius: 5px;"
            alt="">
          <div class=" text-center p-4 pt-0" style="min-height: 220px;margin-top: 80px;">
            <h4 class="font-weight-medium mt-5">Tula Rocha Morais</h4>

            <a class="btn btn-primary" href="http://lattes.cnpq.br/7247136336655770" target="_blank" role="button"
              style="width: 150px;height:50px;margin-top: 10px;">

              <h5 class="align-items-center" style="margin-top: 5px;">Lattes <img src="Img/icones/icone-lattes.png"
                  width="30px" height="30px" alt="" style="object-fit: cover;margin-bottom: 2px;"></h5>

            </a>


          </div>
        </div>
        

        <div class="col-md-4" style="text-align:center;padding-bottom:40px;">
          <img class="position-relative rounded-circle shadow mx-auto card-hover" src="img/equipe rumo/foto 2.jfif"
            style="width: 150px; height: 150px; margin-bottom: -50px; z-index: 1;object-fit: cover;border-radius: 5px;"
            alt="">
          <div class=" text-center p-4 pt-0" style="min-height: 220px;margin-top: 80px;">
            <h4 class="font-weight-medium mt-5">Célia Regina Roncato</h4>

            <a class="btn btn-primary" href="http://lattes.cnpq.br/7645512199834626" target="_blank" role="button"
              style="width: 150px;height:50px;margin-top: 10px;">

              <h5 class="align-items-center" style="margin-top: 5px;">Lattes <img src="Img/icones/icone-lattes.png"
                  width="30px" height="30px" alt="" style="object-fit: cover;margin-bottom: 2px;"></h5>

            </a>


          </div>
        </div>

        <div class="col-md-4" style="text-align:center;padding-bottom:40px;">
          <img class="position-relative rounded-circle shadow mx-auto card-hover" src="Img/equipe rumo/foto 4.jfif"
            style="width: 150px; height: 150px; margin-bottom: -50px; z-index: 1;object-fit: cover;border-radius: 5px;"
            alt="">
          <div class=" text-center p-4 pt-0" style="min-height: 220px;margin-top: 80px;">
            <h4 class="font-weight-medium mt-5">Siobhan Victoria Healy</h4>

            <a class="btn btn-primary" href="http://lattes.cnpq.br/8731431789517806" target="_blank" role="button"
              style="width: 150px;height:50px;margin-top: 10px;">

              <h5 class="align-items-center" style="margin-top: 5px;">Lattes <img src="Img/icones/icone-lattes.png"
                  width="30px" height="30px" alt="" style="object-fit: cover;margin-bottom: 2px;"></h5>

            </a>


          </div>
        </div>

        <div class="col-md-4" style="text-align:center;padding-bottom:40px;">
          <img class="position-relative rounded-circle shadow mx-auto card-hover" src="Img/equipe rumo/foto 3.jfif"
            style="width: 150px; height: 150px; margin-bottom: -50px; z-index: 1;object-fit: cover;border-radius: 5px;"
            alt="">
          <div class=" text-center p-4 pt-0" style="min-height: 220px;margin-top: 80px;">
            <h4 class="font-weight-medium mt-5">Talita Araújo Salgado Alvarez Faustino</h4>

            <a class="btn btn-primary" href="http://lattes.cnpq.br/6387873764746310" target="_blank" role="button"
              style="width: 150px;height:50px;margin-top: 10px;">

              <h5 class="align-items-center" style="margin-top: 5px;">Lattes <img src="Img/icones/icone-lattes.png"
                  width="30px" height="30px" alt="" style="object-fit: cover;margin-bottom: 2px;"></h5>

            </a>


          </div>
        </div>

        <div class="col-md-4" style="text-align:center;padding-bottom:40px;">
          <img class="position-relative rounded-circle shadow mx-auto card-hover" src="Img/equipe rumo/Solange.jfif"
            style="width: 150px; height: 150px; margin-bottom: -50px; z-index: 1;object-fit: cover;border-radius: 5px;"
            alt="">
          <div class=" text-center p-4 pt-0" style="min-height: 220px;margin-top: 80px;">
            <h4 class="font-weight-medium mt-5">Solange Hassan Ahmad Ali Fernandes</h4>

            <a class="btn btn-primary" href="http://lattes.cnpq.br/9597455795635724" target="_blank" role="button"
              style="width: 150px;height:50px;margin-top: 10px;">

              <h5 class="align-items-center" style="margin-top: 5px;">Lattes <img src="Img/icones/icone-lattes.png"
                  width="30px" height="30px" alt="" style="object-fit: cover;margin-bottom: 2px;"></h5>

            </a>


          </div>
        </div>

        <div class="col-md-4" style="text-align:center;padding-bottom:40px;">
          <img class="position-relative rounded-circle shadow mx-auto card-hover" src="Img/equipe rumo/foto 6.jpg"
            style="width: 150px; height: 150px; margin-bottom: -50px; z-index: 1;object-fit: cover;border-radius: 5px;"
            alt="">
          <div class=" text-center p-4 pt-0" style="min-height: 220px;margin-top: 80px;">
            <h4 class="font-weight-medium mt-5">Roseli Rosalino Dias Da Silva Angelino</h4>

            <a class="btn btn-primary" href="http://lattes.cnpq.br/5346323918637330" target="_blank" role="button"
              style="width: 150px;height:50px;margin-top: 10px;">

              <h5 class="align-items-center" style="margin-top: 5px;">Lattes <img src="Img/icones/icone-lattes.png"
                  width="30px" height="30px" alt="" style="object-fit: cover;margin-bottom: 2px;"></h5>

            </a>


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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>