<?php
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/gestionpat.modelo.php";
require_once "../controladores/gestionpat.controlador.php";
/**
*
*/
session_start();

class AjaxUsuarios{

  public $idUsuario;
  public $activarUsuario;
  public $activarId;
  public $idBorrar;
  public $buscarUser;


  public function ajaxTraerUsuarios(){

    if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"]=="ok") {

     $respuesta=ControladorUsuarios::ctrlTraerUsuarios($id=null);
     $datos='{
      "data": [';
      foreach ($respuesta as $key => $value) {

        $gerencia=ControladorPat::ctrlTraerGerencia('id_gerencia',$value["id_gerencia_user"]);
        $botones="<div class='btn-group'><button class='btn btn-warning btnEditarUsuario' idusuario='".$value["id_user"]."' data-toggle='modal' data-target='#modalModificarUsuario'><i class='fas fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarUsuario' idborrar='".$value["id_user"]."' ><i class='fas fa-times'></i></button></div>";
        if($value["estado_user"]!=0){
          $btn_estado="<button class='btn btn-success btn-xs btnActivar' idUsuario='".$value["id_user"]."' estadoUsuario='0' >Activado</button>";
        }else{
          $btn_estado="<button class='btn btn-danger btn-xs btnActivar' idUsuario='".$value["id_user"]."' estadoUsuario='1'>Desactivado</button>";
        }

        if($value["tipo_usuario_user"]=="Admin"){
          $tipo="Administrador";
        }else if($value["tipo_usuario_user"]=="leader"){
         $tipo="Principal";
       }else if($value["tipo_usuario_user"]=="consult"){
        $tipo="Consultor";
      }

      $datos.='[
      "'.($key+1).'",
      "'.$value["nombre_user"].'",
      "'.$value["cargo_user"].'",
      "'.$value["usuario_user"].'",
      "'.$tipo.'",
      "'.$gerencia["nombre_gerencia"].'",
      "'.$btn_estado.'",
      "'.$botones.'"
    ],';
  }

  $datos = substr($datos, 0, -1);

  $datos.='  ]
}';

echo $datos ;
}

}

public function ajaxMostrarUsuarios(){
  $id=$this->idUsuario;
  $respuesta=ControladorUsuarios::ctrlTraerUsuarios($id);
  echo Json_encode($respuesta);
}

public function ajaxModificarEstadoUsuarios(){
  $tabla = "users";
  $id=$this->activarId;
  $estado=$this->activarUsuario;
  $respuesta=ModeloUsuarios::mdlActualizarUsuario($tabla,"estado_user",$estado,"id_user",$id);
}

public function ajaxBorrarUsuario(){
  $tabla = "users";
  $id=$this->idBorrar;
  $respuesta=ModeloUsuarios::mdlBorrarUsuario($tabla,$id);
  echo $respuesta;
}

public function ajaxConsultarUsuario(){
  $usuario=$this->buscarUser;
  $respuesta=ControladorUsuarios::ctrlConsultarUsuario($usuario);
  if ($respuesta==false) {
    echo json_encode('false',true);
  }elseif ($respuesta["estado_user"] == 0){
    echo json_encode("inactived",true);
  }

}

}
/*=============================================
=            ACTIVAMOS EL AJAX           =
=============================================*/
if(isset($_POST["idUsuarioEditar"])){
  $stm = new AjaxUsuarios();
  $stm->idUsuario=$_POST["idUsuarioEditar"];
  $stm -> ajaxMostrarUsuarios();
}elseif (isset($_POST["activarId"])) {
  $stmt = new AjaxUsuarios();
  $stmt->activarId=$_POST["activarId"];
  $stmt->activarUsuario=$_POST["activarUsuario"];
  $stmt -> ajaxModificarEstadoUsuarios();
}elseif(isset($_POST["idBorrar"])){
  $stmt = new AjaxUsuarios();
  $stmt->idBorrar=$_POST["idBorrar"];
  $stmt -> ajaxBorrarUsuario();
}elseif(isset($_POST["usuario"])){
  $stmt = new AjaxUsuarios();
  $stmt->buscarUser=$_POST["usuario"];
  $stmt -> ajaxConsultarUsuario();
}else{
  $stm = new AjaxUsuarios();
  $stm -> ajaxTraerUsuarios();
}
