<?php

/**
 *
 */
require_once "conexion.php";

class ModeloUsuarios
{
  static public function mdlTraerUsuarioLogueado($tabla, $usuario)
  {
    try {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usuario_user = :usuario");
      $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
      if ($stmt->execute()) {
        return $stmt->fetch();
      } else {
        echo "error";
      }

      $stmt = null;
    } catch (Exception $e) {
      return $e->getmessage();
    }
  }

  static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
  {

    try {
      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :item1 WHERE $item2 = :item2");
      $stmt->bindParam(":item1", $valor1, PDO::PARAM_STR);
      $stmt->bindParam(":item2", $valor2, PDO::PARAM_STR);
      if ($stmt->execute()) {
        return "ok";
      } else {
        return "error";
      }

      $stmt = null;
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }

  }

  static public function mdlTraerUsuarios($tabla, $id)
  {
    if ($id != null) {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_user = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch();
    } else {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
      $stmt->execute();
      return $stmt->fetchAll();
    }

    $stmt = null;
  }

  static public function mdlRegistrarUsuario($tabla, $datos)
  {
    try {
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla ( nombre_user, cargo_user, id_gerencia_user, usuario_user, password_user, tipo_usuario_user, correo_user,fecha_create_user) VALUES (:nombre_user, :cargo_user, :id_gerencia_user, :usuario_user, :password_user, :tipo_usuario_user, :correo_user,:fecha_create_user)");
      $stmt->bindParam(":nombre_user", $datos["nombre"], PDO::PARAM_STR);
      $stmt->bindParam(":cargo_user", $datos["cargo"], PDO::PARAM_STR);
      $stmt->bindParam(":id_gerencia_user", $datos["idGerencia"], PDO::PARAM_INT);
      $stmt->bindParam(":usuario_user", $datos["usuario"], PDO::PARAM_STR);
      $stmt->bindParam(":password_user", $datos["password"], PDO::PARAM_STR);
      $stmt->bindParam(":tipo_usuario_user", $datos["perfil"], PDO::PARAM_STR);
      $stmt->bindParam(":correo_user", $datos["correo"], PDO::PARAM_STR);
      $stmt->bindParam(":fecha_create_user", $datos["fecha_create"], PDO::PARAM_STR);
      if ($stmt->execute()) {
        return "ok";
      } else {
        return "error";
      }
      $stmt = null;
    } catch (Exception $e) {
      return $e->getmessage();
    }
  }

  static public function mdlModificarUsuario($tabla, $datos)
  {
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_user = :nombre, cargo_user = :cargo, id_gerencia_user = :id_gerencia,password_user = :password_user,tipo_usuario_user =:tipo_usuario_user, correo_user=:correo_user WHERE usuario_user = :user");
    $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":cargo", $datos["cargo"], PDO::PARAM_STR);
    $stmt->bindParam(":id_gerencia", $datos["idGerencia"], PDO::PARAM_INT);
    $stmt->bindParam(":user", $datos["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":password_user", $datos["password"], PDO::PARAM_STR);
    $stmt->bindParam(":tipo_usuario_user", $datos["perfil"], PDO::PARAM_STR);
    $stmt->bindParam(":correo_user", $datos["correo"], PDO::PARAM_STR);


    if ($stmt->execute()) {
      return "ok";
    } else {
      return "error";
    }

    $stmt = null;
  }

  static public function mdlModificarUsuarios($tabla, $id, $estado)
  {
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_user = :estado WHERE id_user = :id");
    $stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
      return "ok";
    } else {
      return "error";
    }

    $stmt = null;
  }

  static public function mdlBorrarUsuario($tabla, $id)
  {

    try {
      $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_user = :id");
      $stmt->bindParam(":id", $id, PDO::PARAM_INT);
      if ($stmt->execute()) {
        return "ok";
      } else {
        return "error";
      }
    } catch (Exception $e) {
      echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }


    $stmt = null;
  }
}
