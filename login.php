<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: upload.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'admin' && $password == 'rumoadmin') {
        $_SESSION['loggedin'] = true;
        header('Location: upload.php');
        exit;
    } else {
        $error = 'Usuário ou senha incorretos.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <div class="container mt-5">
    <h2>Login</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="login.php" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Usuário</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>

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
</body>
</html>
