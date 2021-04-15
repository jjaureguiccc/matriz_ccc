<?php
/*=====================================
=            CONTROLADORES            =
=====================================*/
require_once "controladores/plantilla.controlador.php";
require_once "controladores/rutas.controlador.php";
require_once "controladores/usuarios.controlador.php";
//require_once "controladores/gestionpat.controlador.php";

/*===============================
=            MODELOS            =
===============================*/
require_once "modelos/usuarios.modelo.php";
//require_once "modelos/gestionpat.modelo.php";
//require_once "modelos/gerencias.modelo.php";
//require_once "modelos/poa.modelo.php";


/*=====================================
=            PHPMAILER            =
=====================================*/

require_once "vistas/plugins/PHPMailer/PHPMailerAutoload.php";

$plantilla = new controladorPlantilla();
$plantilla->ctrlPlantilla();
