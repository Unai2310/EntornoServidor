
<hr>
<script>
    var loadFile = function(event) {
      var output = document.getElementById('fotografia');
      output.src = URL.createObjectURL(event.target.files[0]);
      document.getElementById("borrar").disabled = false;
      output.onload = function() {
      URL.revokeObjectURL(output.src);
    }
  };
</script>
<button onclick="location.href='./'" > Volver </button>
<br>
<?= isset($msg)?$msg:'' ?>
<br>
<form   method="POST" enctype="multipart/form-data">
<table>
 <tr><td>id:</td> 
 <td><input type="number" name="id" value="<?=$cli->id ?>"  readonly  ></td>
 <td rowspan="7">
 <img id="fotografia" src='<?= isset($foto)?$foto:'' ?>'></td> 
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
 <button type="submit" name="nav-detalles" value="AnteriorM" <?= isset($btn)?$btn:'' ?>> Anterior << </button>
 <button type="submit" name="nav-detalles" value="SiguienteM" <?= isset($btn)?$btn:'' ?>> Siguiente >> </button>
 <input type="file" name="archivo" id="foto" accept="image/jpg" onchange="loadFile(event)"/>
 <input type="button" id="borrar" onclick="borrarImg('<?= isset($foto)?$foto:'' ?>')" value="X" disabled/>
</form> 

