
<hr>
<?= isset($msg)?$msg:'' ?>
<form   method="POST">
<table>
 <tr><td>id:</td> 
 <td><input type="number" name="id" value="<?=$cli->id ?>"  readonly  ></td></tr>
 </tr>
 <tr><td>first_name:</td> 
 <td><input type="text" name="first_name" value="<?=$cli->first_name ?>" autofocus  ></td></tr>
 </tr>
 <tr><td>last_name:</td> 
 <td><input type="text" name="last_name" value="<?=$cli->last_name ?>"  ></td></tr>
 </tr>
 <tr><td>email:</td> 
 <td><input type="email" name="email" value="<?=$cli->email ?>"  ></td></tr>
 </tr>
 <tr><td>gender</td> 
 <td><input type="text" name="gender" value="<?=$cli->gender ?>"  ></td></tr>
 </tr>
 <tr><td>ip_address:</td> 
 <td><input type="text" name="ip_address" value="<?=$cli->ip_address ?>"  ></td></tr>
 </tr>
 <tr><td>telefono:</td> 
 <td><input type="tel" name="telefono" value="<?=$cli->telefono ?>"  ></td></tr>
 </tr>
 </table>
 <input type="submit"	 name="orden" 	value="<?=$orden?>">
 <input type="submit"	 name="orden" 	value="Volver">
 <button type="submit" name="nav-detalles" value="AnteriorM" <?= isset($btn)?$btn:'' ?>> Anterior << </button>
 <button type="submit" name="nav-detalles" value="SiguienteM" <?= isset($btn)?$btn:'' ?>> Siguiente >> </button>
 <fieldset>
    <legend>Subir fotos</legend>
    <label>Elija la imagen que quieres subir:</label> 
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000" /> 
    <input name="archivos" type="file" accept="image/jpeg"> <br />
    <input type="submit" value=" Subir archivos " />
    <input type="reset"  value=" Borrar selección ">
  </fieldset>
</form> 

