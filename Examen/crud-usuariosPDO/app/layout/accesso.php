<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CRUD DE USUARIOS</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="web/js/funciones.js"></script>
</head>
<body>
<div id="container" >
<div id="header">
<h1>GESTIÓN DE USUARIOS versión 1.1 + BD</h1>
</div>
<div id="content">
    <?= isset($msg)?$msg:'' ?>
    <hr>
    <form method="POST">
        <label>INTRODUZCA EL PIN DE ACCESSO: </label><input type="text" name="orden" >
    </form>
</div>
</div>
</body>