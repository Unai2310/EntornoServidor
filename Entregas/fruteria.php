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
  if (isset($_SESSION['timeout'])) { 
   session_start();
  }
  if (isset($_REQUEST['cliente'])) {
    $_SESSION['usuario']=$_REQUEST['cliente'];
    $_SESSION['pedido']=$pedido=[];
  }
  ?>
  <form action="fruteria.php" method="POST">
    <h1>La Futería del siglo XXI</h1><br>
    <h3>REALICE SU COMPRA <?= $_SESSION['usuario'] ?></h3><br>
    <label>Seleciona la fruta: </label>
    <select name="frutas">
      <option value="Naranjas">Naranjas</option>  
      <option value="Limones">Limones</option>
      <option value="Platanos">Platanos</option>
      <option value="Manzanas">Manzanas</option>
    </select>
    <label>Cantidad</label>
    <input type="number" min="0" max="100" value="0">
    <input type="submit" name="anotar" value="Anotar">
    <input type="button" name="terminar" value="Terminar">
  </form>
</body>
</html>

