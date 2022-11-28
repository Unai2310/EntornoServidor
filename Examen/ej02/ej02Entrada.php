<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contactos</title>
</head>
<body>
    <form name='entrada' method="post" action="ej02.php">
    <fieldset>
      <legend>Su agenda personal</legend>
        <label for="nombre">Nombre:</label><br>
        <input type='text' name='nombre' size=20 value ="<?= isset($nombre)?$nombre:'' ?>">
        <input type='submit' name="orden" value="Consultar"><br>
        <label for="telefono">Teléfono:</label><br>
        <input type='tel' name='telefono' size=20 value ="<?= isset($telefono)?$telefono:'' ?>">
        <input type='submit' name="orden" value="Añadir">
    </fieldset>
    </form>
    <p><?= isset($msg)?$msg:''?></p>
    </body>
</html>