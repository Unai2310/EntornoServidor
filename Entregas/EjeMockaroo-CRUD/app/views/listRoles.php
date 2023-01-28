<form>
<button type="submit" name="orden" value="VolverU"> Volver </button>
<br>

<?= isset($_SESSION["msg"])?$_SESSION["msg"]:'' ?>
<br>

<table>
<tr><th></th><th>Login</th><th>Rol</th>
<?php foreach ($tvalores as $valor): ?>
<tr>

<td><input type="checkbox" name="chk[]" value="<?= $valor->login ?>"></td>
<td><?= $valor->login ?> </td>
<td><?= getDibujo($valor->rol) ?> </td>

<tr>
<?php endforeach ?>
</table>


<br>
<button type="submit" name="navU" value="Primero"> << </button>
<button type="submit" name="navU" value="Anterior"> < </button>
<button type="submit" name="navU" value="Siguiente"> > </button>
<button type="submit" name="navU" value="Ultimo"> >> </button>
<button type="submit" name="orden" value="Cambiar"> Cambiar Rol </button>
</form>
