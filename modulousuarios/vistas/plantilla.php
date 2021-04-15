<?php
session_start();
$Ruta = Rutas::ctrlRuta();
/*error_reporting(0);

if(isset($_SESSION['tiempo']) ) {

  //15min en este caso.
  $inactivo = 90000;

  $vida_session = time() - $_SESSION['tiempo'];

  if($vida_session > $inactivo)
  {
          //Removemos sesión.
    session_unset();
          //Destruimos sesión.
    session_destroy();
          //Redirigimos pagina.
    header("Location:".$Ruta);

    exit();
  }

}
$_SESSION['tiempo'] = time(); */

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gestion Del Plan Anual del Trabajo</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Fuentes de Iconos -->
  <link rel="icon" href="<?php echo $Ruta ?>vistas/img/plantilla/favicon.png">

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

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/sweetalert2/sweetalert2.min.css">
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/daterangepicker/daterangepicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- animate -->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/animate/animate.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!--=====================================
  =           CSS PERSONALIZADOS          =
  ======================================-->
  <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/css/estilos.css?version=<?php echo Rand() ?>">

  <!-- <link rel="stylesheet" href="<?php echo $Ruta ?>vistas/css/login.css"> -->

  <!--=====================================
  =          JAVASCRIPT          =
  ======================================-->
  <!-- jQuery -->
  <script src="<?php echo $Ruta ?>vistas/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo $Ruta ?>vistas/plugins/jquery-ui/jquery-ui.min.js"></script>

  <script defer>
    $.widget.bridge('uibutton', $.ui.button)
  </script>

  <!-- Bootstrap 4 -->
  <script src="<?php echo $Ruta ?>vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- AdminLTE App -->
  <script src="<?php echo $Ruta ?>vistas/js/adminlte.js"></script>
  <!-- <script src="<?php echo $Ruta ?>vistas/js/pages/dashboard.js"></script> -->

  <!-- bs-custom-file-input -->
  <script src="<?php echo $Ruta ?>vistas/plugins/bs-custom-file-input/bs-custom-file-input.js"></script>

  <!-- overlayScrollbars -->
  <script src="<?php echo $Ruta ?>vistas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

  <!-- pace-progress -->
  <script src="<?php echo $Ruta ?>vistas/plugins/pace-progress/pace.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="<?php echo $Ruta ?>vistas/plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- DataTables -->
  <script defer src="<?php echo $Ruta ?>vistas/plugins/datatables/jquery.dataTables.js"></script>
  <script defer src="<?php echo $Ruta ?>vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script defer src="<?php echo $Ruta ?>vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script defer src="<?php echo $Ruta ?>vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!-- BS-Stepper -->
  <script src="<?php echo $Ruta ?>vistas/plugins/bs-stepper/js/bs-stepper.min.js"></script>
  <!-- moment -->
  <script src="<?php echo $Ruta ?>vistas/plugins/moment/moment.min.js"></script>
  <script src="<?php echo $Ruta ?>vistas/plugins/moment/moment-with-locales.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo $Ruta ?>vistas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- jquery-validation -->
  <script src="<?php echo $Ruta ?>vistas/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="<?php echo $Ruta ?>vistas/plugins/jquery-validation/additional-methods.min.js"></script>
  <!-- Select2 -->
  <script src="<?php echo $Ruta ?>vistas/plugins/select2/js/select2.full.min.js"></script>
  <script src="<?php echo $Ruta ?>vistas/plugins/select2/js/i18n/es.js"></script>


  <!--=====================================
  =           JS          =
  ======================================-->


  <!-- font -->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<?php

if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
  echo "<body class='hold-transition sidebar-mini layout-fixed layout-footer-fixed'>
  <div class='wrapper'>
  <div class='cargando' style='display:none;'>
  <img class='img-fluid' src='" . $Ruta . "vistas/img/plantilla/cargando.gif' >
  </div>";

  include "modulos/header.php";
  include 'modulos/menu.php';

  if (isset($_GET["ruta"])) {

    $ruta = explode("/", $_GET["ruta"]);
    if (
      $ruta[0] == "gestion-pat"
      || $ruta[0] == "gerencias"
      || $ruta[0] == "seguimiento-pat"
      || $ruta[0] == "configuration-seguimiento"
      || $ruta[0] == "indicador-pto"
      || $ruta[0] == "indicador-act"
      || $ruta[0] == "indicador-eficiencia"
      || $ruta[0] == "poa"
      || $ruta[0] == "user"
      || $ruta[0] == "salir"

    ) {
      if (isset($ruta[1])) {

        if ($ruta[1] == 'view-gerencia'
          || $ruta[1] == "ind-pto-programa"
          || $ruta[1] == "ind-pto-actividad"
          || $ruta[1] == "ind-pto-meta"
          || $ruta[1] == "ind-act-programa"
          || $ruta[1] == "ind-act-actividad"
          || $ruta[1] == "ind-act-meta"
          || $ruta[1] == 'ind-seguimiento-pto'
          || $ruta[1] == 'ind-seguimiento-act') {

          include "modulos/" . $ruta[1] . ".php";

      } else {

        include "modulos/error404.php";
      }
    } else {
      include "modulos/" . $ruta[0] . ".php";
    }
  } else {

    include "modulos/error404.php";
  }
} else {

  include "modulos/gestion-pat.php";
}

include "modulos/footer.php";

echo "</div>";
} else {
  echo "<body class='hold-transition login-page'>";
  if (isset($_GET["ruta"])) {

    $ruta = explode("/", $_GET["ruta"]);

    if ($ruta[0] == "forgot") {

      if (isset($ruta[1])) {

        if ($ruta[1] == "forgot") {

          include "modulos/" . $ruta[1] . ".php";
        } else {

          include "modulos/login.php";
        }
      } else {

        include "modulos/" . $ruta[0] . ".php";
      }
    } else {
      include "modulos/login.php";
    }
  } else {

    include "modulos/login.php";
  }
}
?>
<?php
if (!empty($_SESSION["iniciarSesion"])) {

  $tabla="parametro_seguimientos";
  $index="id_parametro";
  $valor='1';
  $parametro=ModeloPat::mdlTraerDataOne($tabla,$index,$valor);

  ?>
  <input type="hidden" id="rutaPlataforma" value="<?php echo $Ruta ?>">
  <input type="hidden" id="rolUsuario" value="<?php echo $_SESSION['tipo_usuario'] ?>">
  <input type="hidden" id="idGerenciaUsuario" value="<?php echo $_SESSION['gerencia_usuario'] ?>">
  <input type="hidden" id="idUsuario" value="<?php echo $_SESSION['id_usuario'] ?>">
  <input type="hidden" id="mesActivo" value="<?php echo $parametro["mes_activo"] ?>">

<?php  }?>
<!--=====================================
  =     JAVASCRIPT PERSONALIZADOS
  ======================================-->
  <script defer src="<?php echo $Ruta ?>vistas/js/plantilla.js?version=<?php echo Rand() ?>"></script>
  <script defer src="<?php echo $Ruta ?>vistas/js/pat.js?version=<?php echo Rand() ?>"></script>
  <script defer src="<?php echo $Ruta ?>vistas/js/usuarios.js?version=<?php echo Rand() ?>"></script>

</body>

</html>