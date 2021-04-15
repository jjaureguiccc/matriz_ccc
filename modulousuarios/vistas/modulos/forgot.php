<div id="back"></div>
<div class="login-box">
  <div class="login-logo">
    <div class="text-center">

      <img class="profile-user-img img-fluid img-circle" src="<?php echo $Ruta ?>vistas/img/plantilla/camara.jpg" alt="camara">
    </div>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">¿Olvidastes tú contraseña? ingreses el usuario registrado y la restableceremos.</p>

      <form method="post" >
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Usuario" name="restablecerPassword" pattern="[-_a-zA-Z0-9]+" required title="El usuario no debe contener caracteres especiales" autocomplete="username" onchange="validarUsuario();">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btnRestablecer">Restablecer contraseña</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <?php
      $restablecer= new ControladorUsuarios();
      $restablecer->ctrlRestablecerPassword();
       ?>

      <p class="mt-3 mb-1">
        <a href="<?php echo $Ruta ?>login">Iniciar sesión</a>
      </p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->