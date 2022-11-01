<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruteria XXI</title>
</head>
<body>
    <?php
    $cliente = $_SESSION['cliente'];
    ?>
    <h1>La Futería del siglo XXI</h1><br>
    <h3>REALICE SU COMPRA <?php echo $nombre ?></h3>
    <form action="fruteria.php" method="POST">
        <label>Seleciona la fruta: </label>
        <select name="frutas">
            <option value="Naranjas">Naranjas</option>  
            <option value="Limones">Limones</option>
            <option value="Platanos">Platanos</option>
            <option value="Manzanas">Manzanas</option>
        </select>
        <label>Cantidad</label>
        <input type="number" name="cantidad" >
        <input type="submit" name="anotar" value="Anotar">
        <input type="button" name="terminar" value="Terminar">
    </form>
</body>

</html>