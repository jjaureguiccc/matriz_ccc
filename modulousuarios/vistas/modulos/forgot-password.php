<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gestion del PAT</title>

  <?php
  require_once "../../controladores/rutas.controlador.php";

  $Ruta=Rutas::ctrlRuta();


  ?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" rel="icon" href="<?php echo $Ruta ?>vistas/img/plantilla/favicon.png">

  <!--=====================================
  =            CSS            =
  ======================================-->

  <!-- Theme style con Bootstrap -->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/fontawesome-free/css/all.min.css">

  <!-- pace-progress -->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/pace-progress/themes/blue/pace-theme-loading-bar.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">


  <!--=====================================
  =           CSS PERSONALIZADOS          =
  ======================================-->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/css/estilos.css">

  <!--=====================================
  =          JAVASCRIPT          =
  ======================================-->
  <!-- jQuery -->
  <script src="<?php echo $Ruta ?>vistas/plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="<?php echo $Ruta ?>vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- AdminLTE App -->
  <script src="<?php echo $Ruta ?>vistas/js/adminlte.js"></script>
  <!-- <script src="<?php echo $Ruta ?>vistas/js/pages/dashboard.js"></script> -->

  <!-- overlayScrollbars -->
  <script src="<?php echo $Ruta ?>vistas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

  <!-- pace-progress -->
  <script src="<?php echo $Ruta ?>vistas/plugins/pace-progress/pace.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="<?php echo $Ruta ?>vistas/plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class='login-page hold-transition'>


  <?php
  if(isset($_GET["forgot"])) {

    if ($_GET["forgot"] === "true") {

      $usuario=$_GET["user"];
      $password=$_GET["password"];

      require_once "../../controladores/usuarios.controlador.php";
      require_once "../../modelos/usuarios.modelo.php";

      $respuesta=ControladorUsuarios::ctrlConsultarUsuario($usuario);

      if ($respuesta["password_user"] === $password) {
        ?>
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
              <p class="login-box-msg">Registre su nueva contraseña.</p>

              <form method="post" >
                <input type="hidden" name="id" value="<?php echo $respuesta["id_user"] ?>">

                <div class="input-group">
                  <input type="password" class="form-control" placeholder="Ingrese su nueva contraseña" name="password1" pattern="[\-%*._a-zA-Z0-9ñÑ]{5,30}" title="La contreña debe contener minimo (5)cinco carecteres" autocomplete="off" onkeyup="valorBarra(this.value,this.name);validarContrasena(this.value,this.name)" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>

                </div>
                <div class="progress progress-xxs mb-3">
                  <div class="progress-bar bg-danger barra1" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  <div class="progress-bar bg-warning barra2" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  <div class="progress-bar bg-success barra3" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>


                <div class="input-group ">
                  <input type="password" class="form-control" placeholder="Repita su nueva contraseña" name="password2" pattern="[\-%*._a-zA-Z0-9ñÑ]{5,30}" title="La contreña debe contener minimo (5)cinco carecteres" autocomplete="off" onkeyup="valorBarra(this.value,this.name);validarContrasena(this.value,this.name)" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="progress progress-xxs mb-3">
                  <div class="progress-bar bg-danger barra4" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  <div class="progress-bar bg-warning barra5" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  <div class="progress-bar bg-success barra6" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block validarBtn ">Cambiar contraseña</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>

              <?php
              $restablecer= new ControladorUsuarios();
              $restablecer->ctrlModificarPassword();
              ?>

            </div>
            <!-- /.login-card-body -->
          </div>
        </div>
        <!-- /.login-box -->

        <?php
      }else{
        echo "<script>
        window.location='".$Ruta."login';
        </script>";
        return;
      }
    }

  }else{
    echo "<script>
    window.location='".$Ruta."login';
    </script>";
    return;
  }


  ?>

  <script src="<?php echo $Ruta ?>vistas/js/usuarios.js"></script>
</body>
</html>