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
      <!--   <p class="login-box-msg">Iniciar sesión</p> -->

      <form method="post">
        <div class="input-group mb-3">

          <input type="text" class="form-control" placeholder="Usuario" name="usuario" pattern="[-_a-zA-Z0-9]+" required title="El usuario no debe contener caracteres especiales" autocomplete="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>

        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="password" pattern="[\-%*._a-zA-Z0-9ñÑ]{5,30}" title="La contreña debe contener minimo (5)cinco carecteres" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>

      </form>
      <p class="mb-1 mt-2">
        <a href="<?php echo $Ruta ?>forgot">Olvidé mi contraseña</a>
      </p>

      <?php
      $inicio = new ControladorUsuarios();
      $inicio->ctrlInicioSesion();
      ?>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<!-- /.login-box -->