
<hr>
<form   method="POST" >
<button type="submit"	 name="orden" 	value="Volver"> Volver </button>
<br>
<?= isset($msg)?$msg:'' ?>
<br>
<table>
 <tr><td>Login:</td> 
 <td><input type="text" name="login"  ></td>
 </tr>
 <tr><td>Contraseña:</td> 
 <td><input type="password" name="passwd"></td></tr>
 </tr>
 </table>
 <br>
 <input type="submit"	 name="orden" 	value="<?=$orden?>">
</form> 

