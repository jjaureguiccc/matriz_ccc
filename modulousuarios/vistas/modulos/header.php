<?php
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"]=="ok" ){
 $nombre=$_SESSION["nombre_usuario"];
 $cargo=$_SESSION["cargo_usuario"];
}else {
  echo '<script>
  window.location = "login";
  </script>';
  return;
}
?>
<nav class="main-header navbar navbar-expand navbar-dark navbar-secondary">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">

      <a class="nav-link" data-toggle="dropdown" href="#">

        <div class="user-panel d-flex">
          <div class="image">
            <img src="<?php echo $Ruta; ?>/vistas/img/default/user.png" class="img-circle img-thumbnail" alt="<?php echo $nombre ?>">
          </div>
          <div class="info">
            <span href="#" class="d-block text-white"><?php echo $nombre ?></span>
          </div>
        </div>

      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user mb-0">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header text-white bg-olive">
            <h3 class="widget-user-username text-right"><?php echo $nombre ?></h3>
            <h5 class="widget-user-desc text-right"><?php echo $cargo ?></h5>
          </div>
          <div class="widget-user-image">
            <img class="img-circle" src="<?php echo $Ruta; ?>/vistas/img/default/user.png" alt="<?php echo $nombre ?>">
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-8 border-right">
                <div class="description-block">
                  <h5 class="description-header">Último Ingreso</h5>
                  <?php

                  if ($_SESSION['logout_usuario']!=null) {
                    echo '<span class="description-text">'.$_SESSION['logout_usuario'].'</span>';
                  } else {
                    echo '<span class="description-text">Primera vez</span>';
                  }

                  ?>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->

              <div class="col-sm-4">

                <div class="description-block">
                  <a href="<?php echo $Ruta ?>salir" class="btn btn-dark">Salir</a>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.widget-user -->
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" title="Expandir" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>



  </ul>
</nav>
