<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruteria XXI</title>
</head>
<body>
<br>
    <h3>Muchas gracias por su pedido.</h3>
    <input type="button" value=" NUEVO CLIENTE " onclick="location.href='<?= $_SERVER['PHP_SELF']; ?>'">
    <?php
    session_destroy();
    ?>
</body>
</html>