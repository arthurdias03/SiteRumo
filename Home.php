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
  </head>
  <body class="test">

    <!--Menu--> 
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
        <div class="col">
          <h3 style="text-transform: uppercase;">O Projeto</h3>
        </div>
      </div>
    </div>

    <main class="container-fluid text-center">
      <div class="row">
        <div class="col-md-2 col-sm-2"></div>
        <div class="col-md-4 col-sm-4">
          <video autoplay controls src="video/home.mp4" height="400" width="100%"></video>
        </div>
        <div class="col-md-4 col-sm-4 respons-foot">
          <p style="text-align: justify; width: 100%;">
            O projeto Rumo à Educação Matemática Inclusiva reúne pesquisadores, professores e alunos no desenvolvimento de cenários inclusivos para aprendizagem matemática. Nosso compromisso é construir culturas educacionais nas quais cada aprendiz é reconhecido e respeitado em sua individualidade. <br>

            Alguns exemplos são:
            Matemática e música para aprendizes cegos.
            Cenários que valorizam representações visuais para aqueles que preferem esse tipo de raciocínio.
            Ferramentas que favorecem experiências táteis de propriedades matemáticas.
            Neste site, apresentamos alguns resultados dos nossos estudos. São teses, dissertações, aplicativos, ferramentas e atividades desenvolvidas e testadas pela equipe. Esperamos que o contato com nosso material estimule outras pessoas a partilhar desse desafio.
          </p>
        </div>
        <div class="col-md-2 col-sm-2"></div>
      </div>
    </main>

    <footer class="navbar fixed-bottom bg-footer">
      <div class="container-fluid">
        <a class="navbar-brand" href="Home.php"><img src="Img/icones/Logo_rumoPNG.png" alt="Logo" width="70" height="50" class="d-inline-block align-text-top" style="margin-left: 15px;"></a>
        <div class="d-flex">
          <a class="navbar-brand"><img src="Img/icones/logo_fapesp.png" alt="Logo" width="90" height="50" class="d-inline-block align-text-top" style="margin-left: 15px;"></a>
          <a class="navbar-brand"><img src="Img/icones/CNPq_v2017_rgb.png" alt="Logo" width="90" height="40" class="d-inline-block align-text-top" style="margin-left: 15px;"></a>
          <a class="navbar-brand"><img src="Img/icones/banner_capes-1024x871.png" alt="Logo" width="70" height="50" class="d-inline-block align-text-top" style="margin-left: 15px; object-fit: contain;"></a>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
