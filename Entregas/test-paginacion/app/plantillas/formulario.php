<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CRUD DE USUARIOS</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 600px;">
<div id="header">
<h1>GESTIÓN DE USUARIOS versión 1.1 + BD</h1>
</div>
<div id="content">
<hr>
<form   method="POST">
<table>
 <tr><td>Id </td> 
 <td>
 <input type="text" 	name="id" 	value="<?=isset($cliente->id) ?>"       <?= ($orden == "Detalles" || $orden == "Modificar")?"readonly":"" ?> autofocus></td></tr>
 <tr><td>first_name  </td> <td>
 <input type="text" 	name="first_name" 	value="<?=isset($cliente->first_name) ?>"        <?= ($orden == "Detalles")?"readonly":"" ?>></td></tr>
 <tr><td>last_name  </td> <td>
 <input type="text" 	name="last_name" 	value="<?=isset($cliente->last_name) ?>"        <?= ($orden == "Detalles")?"readonly":"" ?>></td></tr>
 <tr><td>email</td> <td>
 <input type="text" name="email" 	value="<?=isset($cliente->email) ?>"        <?= ($orden == "Detalles")?"readonly":"" ?> ></td></tr>
 <tr><td>gender </td><td>
 <input type="text" 	name="gender" value="<?=isset($cliente->gender) ?>" <?= ($orden == "Detalles")?"readonly":"" ?>></td></tr>
 <tr><td>ip_address </td><td>
 <input type="text" 	name="ip" value="<?=isset($cliente->ip_address) ?>" <?= ($orden == "Detalles")?"readonly":"" ?>></td></tr>
 <tr><td>telefono </td><td>
 <input type="text" 	name="tel" value="<?=isset($cliente->telefono) ?>" <?= ($orden == "Detalles")?"readonly":"" ?>></td></tr>
 </table>
 <input type="submit"	 name="orden" 	value="<?=$orden?>" <?= ($orden == "Detalles")?"disabled":"" ?>>
 <input type="submit" onclick="window.history.back();" 	value="Volver" >
</form> 
</div>
</div>
</body>
</html>

