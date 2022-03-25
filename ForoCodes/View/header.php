<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- FontAwesome-->
    <script src="https://kit.fontawesome.com/5aef946d0f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./View/css/styles.css">

    <title>Foro Codes</title>
</head>
<!-- El body se cierra en el footer-->
<body class="d-flex flex-column min-vh-100">
<div class='container-fluid'>
    <!--Menu de Navegación-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">foroC0des</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul> -->
        </li>
          <?php
          if($_SESSION['login'] == "true"){
            echo '
            <li class="nav-item">Hola '.$_SESSION['username'].' ¿No eres tú?</li>
                  <li><a "class="nav-item" aria-current="page" href="logout.php">Cerrar Sesion</a></li>
                  ';
          }else{
            echo '<a "class="nav-item" aria-current="page" href="login.php">Iniciar Sesión</a>';
          }
          ?>
      </ul>
      <?php
  if($_SESSION['login'] == "true"){
    echo '<div class="d-flex">
            <p class="navbar-brand">Bienvenido!</p>
            </div>';
  }else{
    echo '<div class="d-flex">
            <p class="navbar-brand">¿No tienes cuenta?</p>
            <a class="nav-link" href="./signup.php">Regístrate</a>
          </div>';
  }
?>

      </form>
  </div>
</nav>
</div>
<div class="container">
