<?php
session_start();
include_once "header.php";
include_once "include/verificacionUsuario.php";
?>
    <div class="container">
      <h2>Editar Clave</h2>
      <form role="form" action="querys/updateClaveTm.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label for="Nombre">Ingrese Clave Antigua</label>
          <input type="password" class="form-control" name="claveantigua"  placeholder="Ingrese clave antigua" required>
        </div>
          <div class="form-group">
          <label for="contraseņa">Nueva Clave</label>
          <input type="password"  class="form-control" name="clavenueva" placeholder="Ingrese nueva clave" required>
        </div>
          <div class="form-group">
          <label for="Repetircontraseņa">Repetir Clave Nueva</label>
          <input type="password"  class="form-control" name="repetirclave" placeholder="Reescribir clave nueva" required>
        </div>
        <div>
          <input type="hidden" name="id" value="<?php echo $_SESSION['idusuario'];?>"
        </div>
          <br>
        <button type="submit" class="btn btn-info">Cambiar</button>
      </form>
    </div>
      


