
<hr>
<form   method="POST" >
<button type="submit"	 name="orden" 	value="Volver"> Volver </button>
<br>
<?= isset($msg)?$msg:'' ?>
<br>
<table>
 <tr><td>login:</td> 
 <td><input type="text" name="login" value="<?=$us->login ?>" ></td>
 </tr>
 <tr><td>password:</td> 
 <td><input type="password" name="passwd" value="<?=$us->passwd ?>" ></td></tr>
 </tr>
 </table>
 <br>
 <input type="submit"	 name="orden" 	value="<?=$orden?>">
</form> 

