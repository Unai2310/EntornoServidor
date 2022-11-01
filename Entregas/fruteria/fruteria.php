<!DOCTYPE html>
<html lan="es">
<head>
  <meta charset="UTF-8">
  <meta charset="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fruteria XXI</title>
  <style>
    h1, h3 {
      margin: 5px;
    }
  </style>
</head>
<body>
  <?php
    session_start(); 
    if (!isset($_GET['cliente'])) {
      include 'registro.html';
    }
    if (isset($_GET['cliente'])) {
      $_SESSION['cliente'] = $_GET['cliente'];
      include 'formulario.php';
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      if ($_POST['boton'] == 'Anotar') {
        if (empty($_SESSION['pedido'][$_POST['fruta']])) {
          $_SESSION['pedido'][$_POST['fruta']] = $_POST['cantidad'];
        } else {
          $_SESSION['pedido'][$_POST['fruta']] += $_POST['cantidad'];
        }
      include 'lista.php';
      include 'formulario.php';
    } else {
      include 'lista.php';
      include 'terminado.php';
    }
    }
?>
</body>
</html>

