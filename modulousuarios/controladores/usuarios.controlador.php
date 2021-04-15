<?php

/**
 *
 */
class ControladorUsuarios
{

  public function ctrlInicioSesion()
  {

    if (isset($_POST["usuario"])) {

      if (preg_match('/[-_a-zA-Z0-9]+/', $_POST["usuario"]) && preg_match('/^[\-%*._a-zA-Z0-9ñÑ]{5,30}/', $_POST["password"])) {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        $tabla = "users";
        $respuesta = ModeloUsuarios::mdlTraerUsuarioLogueado($tabla, $usuario);

        $encriptar = crypt($_POST["password"], '$2a$07$g3st10nd3lp14n4nu4ld3ltr4b4j0c4m4r4d3c0m3rc10$');

        if ($respuesta["usuario_user"] === $_POST["usuario"] && hash_equals($respuesta["password_user"],$encriptar)) {

          if ($respuesta["estado_user"] == 1) {
            // var_dump($respuesta);
            $_SESSION["iniciarSesion"] = "ok";
            $_SESSION["id_usuario"] = $respuesta["id_user"];
            $_SESSION["nombre_usuario"] = $respuesta["nombre_user"];
            $_SESSION["tipo_usuario"] = $respuesta["tipo_usuario_user"];
            $_SESSION["cargo_usuario"] = $respuesta["cargo_user"];
            $_SESSION["gerencia_usuario"] = $respuesta["id_gerencia_user"];
            $_SESSION["user_usuario"] = $respuesta["usuario_user"];
            $_SESSION["logout_usuario"] = $respuesta["logout_user"];
            $_SESSION["tiempo"] = time();

            /*=============================================
            REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
            =============================================*/
            date_default_timezone_set('America/Bogota');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $fechaActual = $fecha . ' ' . $hora;
            $item1 = "logout_user";
            $valor1 = $fechaActual;
            $item2 = "id_user";
            $valor2 = $respuesta["id_user"];
            $ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
            if ($ultimoLogin == "ok") {
              echo '<script>
              window.location = "gestion-pat";
              </script>';
            }
          } else {
            echo '<br>
            <div class="alert alert-danger alert-dismissible" role="alert" ><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>El usuario se encuentra inactivo</div>';
          }
        } else {
          echo '<br><div class="alert alert-danger">Error al ingresar, vuelva a intentarlo</div>';
        }
      }
    }
  }

  static public function ctrlTraerUsuarios($id)
  {
    $tabla = "users";
    $enviar = ModeloUsuarios::mdlTraerUsuarios($tabla, $id);
    return $enviar;
  }

  static public function ctrlRegistrarUsuario()
  {
    if (isset($_POST["nuevoUsuario"])) {
      if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
        preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCargo"]) &&
        preg_match('/^[\-%*._a-zA-Z0-9ñÑ]+$/', $_POST["nuevoPassword"]) &&
        preg_match('/^[-_a-zA-Z0-9]+$/', $_POST["nuevoUsuario"])) {

        $tabla = "users";

      $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$g3st10nd3lp14n4nu4ld3ltr4b4j0c4m4r4d3c0m3rc10$');

      date_default_timezone_set('America/Bogota');
      $fecha = date('Y-m-d');

      $correo=$_POST["nuevoUsuario"]."@cccucuta.org.co";

      $datos = array(
        "nombre" => $_POST["nuevoNombre"],
        "cargo" => $_POST["nuevoCargo"],
        "idGerencia" => $_POST["nuevoGerencia"],
        "perfil" => $_POST["nuevoPerfil"],
        "correo" => $correo,
        "usuario" => $_POST["nuevoUsuario"],
        "password" => $encriptar,
        "fecha_create" => $fecha
      );

      $respuesta = ModeloUsuarios::mdlRegistrarUsuario($tabla, $datos);

      if ($respuesta == "ok") {
        echo "<script>
        Swal.fire({
          title: '¡El usuario se ha creado Correctamente!',
          icon: 'success',
          confirmButtonColor: '#3085d6',
          allowOutsideClick: false,
          confirmButtonText: 'Cerrar'
          }).then((result) => {
            if (result.value) {
              window.history.replaceState(null, null, window.location.href);
            }
            })
            </script>";
          } else {
            echo "<script>
            Swal.fire({
              title: '¡Uups hubo un error!',
              text: '¡Vuelva a intentarlo!!!!',
              icon: 'error',
              allowOutsideClick: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Cerrar'
              }).then((result) => {
                if (result.value) {
                  window.location = 'user';
                }
                })
                </script>";
              }
            } else {
              echo "<script>
              Swal.fire({
                title: '¡Uups hubo un error!',
                text: '¡El usuario no puede ir vacío o llevar caracteres especiales!',
                icon: 'error',
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Cerrar'
                }).then((result) => {
                  if (result.value) {
                    window.location = 'user';
                  }
                  })
                  </script>";
                }
              }
            }

            public static function ctrlModificarUsuario()
            {
              if (isset($_POST["editarUsuario"])) {

                if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
                  preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCargo"])) {

                  $tabla = "users";
                if ($_POST["editarPassword"] != "") {
                  if (preg_match('/^[\-%*._a-zA-Z0-9ñÑ]+$/', $_POST["editarPassword"])) {
                    $password = crypt($_POST["editarPassword"], '$2a$07$g3st10nd3lp14n4nu4ld3ltr4b4j0c4m4r4d3c0m3rc10$');
                  } else {
                    echo "<script>
                    Swal.fire({
                      title: '¡La contraseña no puede llevar caracteres especiales!',
                      icon: 'success',
                      confirmButtonColor: '#3085d6',
                      allowOutsideClick: false,
                      confirmButtonText: 'Cerrar'
                      }).then((result) => {
                        if (result.value) {
                          window.history.replaceState(null, null, window.location.href);
                        }
                        })
                        </script>";
                      }
                    } else {
                      $password = $_POST["passwordActual"];
                    }

                    $datos = array(
                     "nombre" => $_POST["editarNombre"],
                     "cargo" => $_POST["editarCargo"],
                     "idGerencia" => $_POST["editarGerencia"],
                     "perfil" => $_POST["editarPerfil"],
                     "correo" => $_POST["editarCorreo"],
                     "usuario" => $_POST["editarUsuario"],
                     "password" => $password,
                   );

                    $respuesta = ModeloUsuarios::mdlModificarUsuario($tabla, $datos);

                    if ($respuesta == "ok") {
                      echo "<script>
                      Swal.fire({
                        title: '¡El usuario se ha modificado Correctamente!',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        allowOutsideClick: false,
                        confirmButtonText: 'Cerrar'
                        }).then((result) => {
                          if (result.value) {
                            window.history.replaceState(null, null, window.location.href);
                          }
                          })
                          </script>";
                        } else {
                          echo "<script>
                          Swal.fire({
                            title: '¡Uups hubo un error!',
                            text: '¡No se ha modificado el Usuario!',
                            icon: 'error',
                            allowOutsideClick: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Cerrar'
                            }).then((result) => {
                              if (result.value) {
                                window.history.replaceState(null, null, window.location.href);
                              }
                              })
                              </script>";
                            }
                          } else {
                            echo "<script>
                            Swal.fire({
                              title: '¡Uups hubo un error!',
                              text: '¡No se ha modificado el Usuario!',
                              icon: 'error',
                              allowOutsideClick: false,
                              confirmButtonColor: '#3085d6',
                              confirmButtonText: 'Cerrar'
                              }).then((result) => {
                                if (result.value) {
                                  window.history.replaceState(null, null, window.location.href);
                                }
                                })
                                </script>";
                              }
                            }
                          }

                          public function ctrlRestablecerPassword()
                          {

                            if (isset($_POST["restablecerPassword"])) {

                             if (preg_match('/[-_a-zA-Z0-9]+/', $_POST["restablecerPassword"])) {

                              $ruta=Rutas::ctrlRuta();

                              $correo="".$_POST["restablecerPassword"]."@cccucuta.org.co";

                              $respuesta=ModeloUsuarios::mdlTraerUsuarioLogueado("users",$_POST["restablecerPassword"]);

                              function generarPassword($longitud){
                                $key="";
                                $charater="12345abcdefgh6789ijklmnopqrstvxyzw.";
                                $max=strlen($charater)-1;

                                for ($i=0; $i < $longitud ; $i++) {
                                  $key.= $charater{mt_rand(0,$max)};
                                }
                                return $key;
                              }

                              $nuevaPassword=generarPassword(11);

                              $tabla="users";
                              $item1="password_user";
                              $valor1=crypt($nuevaPassword, '$2a$07$g3st10nd3lp14n4nu4ld3ltr4b4j0c4m4r4d3c0m3rc10$');
                              $item2="usuario_user";
                              $valor2=$_POST["restablecerPassword"];

                              $actualizarPassword=ModeloUsuarios::mdlActualizarUsuario($tabla,$item1,$valor1,$item2,$valor2);

                              if ($actualizarPassword=="ok") {
      /*=====================================
      =            ENVIAR CORREO            =
      =====================================*/

      $mail = new PHPMailer;

      $mail->CharSet = 'UTF-8';

      $mail->isSMTP();

      $mail->SMTPDebug = 2;

      $mail->Debugoutput = 'error_log';

      $mail->Host = "smtp.office365.com";

      $mail->Port = 587;

      $mail->SMTPAuth = true;

      $mail->Username = "no-reply@cccucuta.org.co";

      $mail->Password = "Vitrina2020**";

      $mail->setFrom('no-reply@cccucuta.org.co', 'Gestión PAT');

      $mail->addReplyTo('no-reply@cccucuta.org.co', 'Gestión PAT');


      $mail->Subject = "Solicitud de restablecimiento de contraseña";

      $mail->addAddress($correo);

      $mail->msgHTML('<table>
        <tr>
        <td><h3 style="text-align: left;font-size: 1.7em;color: #5794c1;">Hola, '.$respuesta["nombre_user"].'</h3>
        <p style="font-size: 1.4em; margin-top: -1em;">Esta recibiendo este correo electrónico porque ha solicitado un restablecimiento de contraseña en la plataforma Gestión del PAT.</p></td>
        </tr>
        <tr>
        <td style="text-align: center;"><a style="color: #5794c1; font-size: 1.6em;" href="'.$ruta.'vistas/modulos/forgot-password.php?forgot=true&user='.$_POST["restablecerPassword"].'&password='.$valor1.'">Restablecer Contraseña</a></td>
        </tr>
        <tr>
        <td><p style="font-size: 1.2em; margin: 1.5em 1em;">Si no ha solicitado restablecer su contraseña,por favor ignore este mensaje, y ponte en contacto con la Mesa de Ayuda.</p></td>
        </tr>
        </table>');

      $envio = $mail->Send();

      if (!$envio) {

        echo "<script>

        Swal.fire({
          title: '¡Uups hubo un error al enviar el correo!',
          text: '¡Por favor vuelva a intentarlo!',
          icon: 'error',
          allowOutsideClick: false,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Cerrar'
          }).then((result) => {
            if (result.value) {
              history.back();
            }
            })

            </script>";


          }else{

            echo "<script>

            Swal.fire({
              title: '¡Restablecida!',
              text: '¡Por favor ingrese a su correo, y registre su nueva contraseña!',
              icon: 'success',
              allowOutsideClick: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Cerrar'
              }).then((result) => {
                if (result.value) {
                  window.location = 'login';
                }
                })

                </script>";
              }

            //finaliza envio del correo

            }else{

             echo "<script>
             Swal.fire({
              title: '¡Uups hubo un error!!',
              text: '¡Por favor vuelva a intentarlo!',
              icon: 'error',
              allowOutsideClick: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Cerrar'
              }).then((result) => {
                if (result.value) {
                  history.back();
                }
                })

                </script>";
              }

            }
          }

        }

        static public function ctrlConsultarUsuario($usuario){

          $tabla="users";

          $consultar=ModeloUsuarios::mdlTraerUsuarioLogueado($tabla,$usuario);

          return $consultar;


        }

        public function ctrlModificarPassword(){

          if (isset($_POST["password2"])) {

            if (preg_match('/[\-%*._a-zA-Z0-9ñÑ]{5,30}/', $_POST["password2"]) && preg_match('/[\-%*._a-zA-Z0-9ñÑ]{5,30}/', $_POST["password1"])) {

              $password1=$_POST["password1"];
              $password2=$_POST["password2"];
              $id=$_POST["id"];

              if ($password1 === $password2) {

                $password=crypt($password1, '$2a$07$g3st10nd3lp14n4nu4ld3ltr4b4j0c4m4r4d3c0m3rc10$');

                $tabla="users";

                $modificar=ModeloUsuarios::mdlActualizarUsuario($tabla, 'password_user', $password, "id_user", $id);



                if ($modificar === "ok") {

                  echo "<script>

                  Swal.fire({
                    title: '¡Ok!!',
                    text: 'La contraseña se ha modificado correctamente.¡Ya puedes ingresar al sistema!',
                    icon: 'success',
                    allowOutsideClick: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Cerrar'
                    }).then((result) => {
                      if (result.value) {
                        window.location='login';
                      }
                      })

                      </script>";
                    }else{

                      echo "<script>

                      Swal.fire({
                        title: '¡Uups hubo un error!!',
                        text: '¡Por favor vuelva a intentarlo!',
                        icon: 'error',
                        allowOutsideClick: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Cerrar'
                        }).then((result) => {
                          if (result.value) {
                            history.back();
                          }
                          })

                          </script>";
                        }

                      }else{

                        echo "<script>

                        Swal.fire({
                          title: '¡Uups hubo un error!!',
                          text: '¡Las contraseñas no son identicas, porfavor vuelva a intentarlo!',
                          icon: 'error',
                          allowOutsideClick: false,
                          confirmButtonColor: '#3085d6',
                          confirmButtonText: 'Cerrar'
                          }).then((result) => {
                            if (result.value) {
                              history.back();
                            }
                            })

                            </script>";
                          }

                        }

                      }

                    }

                  }
