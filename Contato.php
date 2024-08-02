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
              <a class=" nav-link2" aria-current="page" href="Home.html" >Home</a>
            </li>
            <li class="nav-item">
              <a class=" nav-link2 " href="Sobre.html">Sobre</a>
            </li>
            <li class="nav-item">
              <a class=" nav-link2" href="Equipe.html">Equipe </a>
            </li>
            <li class="nav-item">
              <a class=" nav-link2" aria-disabled="true" href="Publicações.html">Publicações</a>
            </li>
            <li class="nav-item">
              <a class=" nav-link2" aria-disabled="true" href="Aplicativos.html">Aplicativos</a>
            </li>
            <li class="nav-item">
              <a class=" nav-link2" aria-disabled="true" href="Materiais.html">Materiais</a>
            </li>
            <li class="nav-item">
              <a class=" nav-link2" aria-disabled="true" href="Contato.html">Contato</a>
            </li>
           
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
        <h3 style="text-transform: uppercase;">Contato</h3>

      </div>

      

    </div>
    </div>
 
    <div class="container p-5 respons-foot" style="background-color: #f4f7f7;border-radius: 7px;border: 1px solid transparent">
      <form action="https://api.staticforms.xyz/submit" method="post">
        <div class="mb-3">

          <label for="name" class="form-label"></label>
          <input type="name" id="name" name="name" class="form-control  " placeholder="Digite seu nome:" required>
          <br>
          <input type="email" id="email" name="email" class="form-control  " placeholder="Digite seu email:" required>
          <br>
          <textarea class="form-control " name="message" id="exampleFormControlTextarea1" rows="3" placeholder="Escreva sua mensagem para nós!" required></textarea>
          <br>
          <button type="submit" class="btn btn-primary  " style="width: 100%;"><strong>Enviar</strong> </button>

          <input type="hidden" name="accessKey" value="31aebb65-e62b-4cc2-8734-2537a63b1f14">
          <input type="hidden" name="redirectTo" value="http://127.0.0.1:5500Contato.html">
         



        </div>
        
      </form>
      <div></div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>