<?php
require_once('./View/view.php');
require_once('chartFunctions.php');
require_once('Controllers/controller.php');
session_start();
errorLog();
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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">        </script>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);

        // Set chart options
        var options = {'title':'Cantidad de Temas en cada Categoría',
                       'width':800,
                       'height':600};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

</head>
<!-- El body se cierra en el footer-->
<body class="d-flex flex-column min-vh-100">
<div class='container-fluid'>
    <!--Menu de Navegación-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" style='color:#c154c1'>foroC0des</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
        </li>

          <?php
          if($_SESSION['login'] == "true"){
            echo '
            <li class="nav-item">
              <a class="nav-link" href="search.php">Buscar</a>
            </li>
            <li class="navbar-brand">Hola '.$_SESSION['username'].' ¿No eres tú?</li>
                  <li class="nav-item">
                    <a 
                    class="nav-link" aria-current="page" href="logout.php">Cerrar Sesion</a>
                  </li>
                  ';
          }else{
            echo '<li class="nav-item">
                    <a class="nav-link" aria-current="page" href="login.php">Iniciar Sesión</a>
                    </li>';
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
            <li class="nav-item">
              <p class="navbar-brand">¿No tienes cuenta?</p>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./signup.php">Regístrate</a>
            <li/>
          </div>';
  }
?>

      </form>
  </div>
</nav>
<!--
</div>
<div class="container-lg">
  <div id="chart_div"></div>
</div>
-->
<?php
$idArray = getCatID();
$id = $idArray[0]["COUNT('catID')"];
$name = getAllCatName($id);
var_dump($name);
require_once('./View/footer.php');
?>