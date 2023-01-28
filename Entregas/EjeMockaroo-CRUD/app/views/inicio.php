<div class="container-log">
<?= isset($msg)?$msg:'' ?>
  <form method="POST" >
    <input class="input-login" type="text" name="login" placeholder="Usuario" >
    <br>
    <input class="input-login" type="password" name="pass" placeholder="Contraseña" >
    <br><br>
    <input class="boton-login" type="submit" name="orden" value="Ingresar">
  </form>
  <div class="login">
    <p>¿No tienes cuenta?<a href="?orden=Registrar">Registrarse</a></p>
  </div>
</div>