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
        <h3 style="text-transform: uppercase;">MATERIAIS DIDÁTICOS</h3>
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



  <div class="container text-center respons-foot">
    <div class="row g-2">
      <div class="col-3">
        <div class="p-3">
          <div class="card" style="width: 100%;">
            <img src="Pages/Img/imgs_old/materiais_didáticos_1.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h3>Homotetia </h3>
              <p class="card-text" style="text-align: justify;">Esta ferramenta foi planejada para que aprendizes cegos pudessem realizar tarefas relacionadas ao estudo de homotetia.</p>
              <a onclick="downloadExe()"  href="Materiais/homotetia.pdf" class="btn btn-primary">Descrição</a>
              <a onclick="downloadExe()"  href="Materiais/homotetia-atividade.pdf" class="btn btn-primary">Atividade</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="p-3">
          <div class="card" style="width: 100%;">
            <img src="Img/imgs_old//materiais_didáticos_2.png" class="card-img-top" alt="..." style="object-fit: contain;">
            <div class="card-body">
              <h3>Matrizmat </h3>
              <p class="card-text" style="text-align: justify;">A ferramenta foi planejada para oferecer diferentes estímulos sensoriais para aprendizes de classes inclusivas, a fim de facilitar o acesso ao conceito matemático de matrizes.</p>
              <a onclick="downloadExe()"  href="Materiais/matrixmat-descricao.pdf" class="btn btn-primary">Descrição</a>
              <a onclick="downloadExe()" href="" class="btn btn-primary">Atividade</a>
            </div>
          </div>
        </div>
      </div>
     
      
    </div>
  </div>
  
  

  

    

  

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

    <script src="js/baixar_materiais.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>