<div class="container-log">
<?= isset($msg)?$msg:'' ?>
  <form>
    <input class="input-login" type="text" name="login" placeholder="Usuario" >
    <br>
    <input class="input-login" type="text" name="pass" placeholder="Contraseña" >
    <br><br>
    <input class="boton-login" type="submit" name="ingresar" value="Ingresar">
  </form>
  <div class="login">
    <p>¿No tienes cuenta?<a href="?orden=Ingresar">Registrarse</a></p>
  </div>
</div>