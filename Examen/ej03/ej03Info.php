<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frutas Favoritas</title>
</head>
<body>
<form name='entrada' method="post" action="ej03.php">
    <fieldset>
        <legend>Sus frutas preferidas </legend>
        <label for="nombre">Lista de frutas:</label><br>
        <select name="listafrutas[]" multiple >
            <option value="Platano" <?= isset($_COOKIE["Platano"])?$_COOKIE["Platano"]:'' ?> >Platano</option>
            <option value="Fresa" <?= isset($_COOKIE["Fresa"])?$_COOKIE["Fresa"]:'' ?> >Fresa</option>
            <option value="Naranja" <?= isset($_COOKIE["Naranja"])?$_COOKIE["Naranja"]:'' ?> >Naranja</option>
            <option value="Melon" <?= isset($_COOKIE["Melon"])?$_COOKIE["Melon"]:'' ?> >Melón</option>
            <option value="Manzana" <?= isset($_COOKIE["Manzana"])?$_COOKIE["Manzana"]:'' ?> >Manzana</option>
        </select>
        <input type="submit" value=" Cambiar ">
    </fieldset>
    </form>
</body>
</html>