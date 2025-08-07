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
            --shadow-light: 0 4px 20px rgba(0,0,0,0.1);
            --shadow-medium: 0 8px 30px rgba(0,0,0,0.15);
            --shadow-heavy: 0 15px 50px rgba(0,0,0,0.2);
        }
        .section-title {
              text-align: center;
              margin-top: 5rem;
              margin-bottom: 7rem;
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
        .select-pub{
      border: 1px solid #194376;
      color: #194376;
      font-weight: 700;
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
         <div class="section-title scroll-animate">
                <h2>Contato</h2>
                
            </div>
        

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