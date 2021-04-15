/*=============================================
=    Traemos informacion Datatables
=============================================*/
// $.ajax({
// 	url: 'ajax/usuarios.ajax.php',
// 	success:function(respuesta){
// 		console.log("respuesta", respuesta);

// 	}
// })

/*=============================================
=    Activamos Datatables
=============================================*/
$('.tableUsuarios').DataTable({
    "ajax": "ajax/usuarios.ajax.php"
});

/*=============================================
Mostrar ó Ocultar contraseña
=============================================*/
function mostrarContrasena() {
    var password = $('input[name=nuevoPassword]').prop('type');
    var password2 = $('input[name=editarPassword]').prop('type');

    if (password == 'password' || password2 == 'password') {
        $('a.inputPassword > i').removeClass('fas fa-eye-slash').addClass('fa fa-eye');
        $('input[name=nuevoPassword]').prop('type', 'text');
        $('input[name=editarPassword]').prop('type', 'text');
        $('a.inputPassword').prop('title', 'Ocultar contraseña');
    } else {
        $('a.inputPassword > i').removeClass('fas fa-eye').addClass('fas fa-eye-slash');
        $('input[name=nuevoPassword]').prop('type', 'password');
        $('input[name=editarPassword]').prop('type', 'password');
        $('a.inputPassword').prop('title', 'Mostrar contraseña');
    }
}
/*=============================================
Traemos la Informa de la BD para modificar Usuario
=============================================*/

$(document).on('click', '.btnEditarUsuario', function() {
    var idUsuario = $(this).attr('idUsuario');
    var datos = new FormData();
    datos.append("idUsuarioEditar", idUsuario);
    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("input[name=editarNombre]").val(respuesta["nombre_user"]);
            $("input[name=editarCargo]").val(respuesta["cargo_user"]);
            $("input[name=editarCorreo]").val(respuesta["correo_user"]);
            $("input[name=editarUsuario]").val(respuesta["usuario_user"]);
            $("input[name=passwordActual]").val(respuesta["password_user"]);
            $("select[name=editarGerencia]").val(respuesta["id_gerencia_user"]);
            $("select[name=editarPerfil]").val(respuesta["tipo_usuario_user"]);

        }
    });
});

/*=============================================
Eliminar Usuario de la BD
=============================================*/
$(document).on('click', '.btnEliminarUsuario', function() {
    var idBorrar = $(this).attr('idborrar');

    Swal.fire({
        title: '¿Está seguro de eliminar el usuario?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminar usuario!',
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {

            $.post("ajax/usuarios.ajax.php", { idBorrar: idBorrar }, function(data, textStatus, xhr) {
                if (data != "ok") {
                    Swal.fire({
                        title: 'Error!!',
                        text: '¡Se presento un error al eliminar el usuario!',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 3000
                    });

                } else {
                    Swal.fire({
                        title: 'Eliminado!!',
                        text: '¡El usuario Se ha eliminado Correctamente!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function() { location.reload(); }, 1500);
                }

            });

        }
    })
});

/*=============================================
ACTIVAR USUARIO
=============================================*/
$(document).on("click", ".btnActivar", function() {
    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");
    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);
    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            // console.log("respuesta", respuesta);
            if (window.matchMedia("(max-width:767px)").matches) {
                Swal.fire({
                    title: '¡El usuario ha sido actualizado!',
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    allowOutsideClick: false,
                    confirmButtonText: 'Cerrar'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'user';
                    }
                });
            }
        }
    })
    if (estadoUsuario == 0) {
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario', 1);
    } else {
        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoUsuario', 0);
    }
})

/*=============================================
Validar Usuario
=============================================*/
function validarUsuario() {
  var usuario = $("input[name=restablecerPassword]").val();

  $.post('ajax/usuarios.ajax.php', {usuario: usuario}, function(data, textStatus, xhr) {
      if (data === "false") {
        $("button.btnRestablecer").attr('disabled',true);
        Swal.fire({
          title: "Usuario No Existe",
          text: "¡El usuario actualmente no existe en la base de datos!",
          icon: "warning",
          confirmButtonColor: "#3085d6",
          allowOutsideClick: false,
          confirmButtonText: "Cerrar",
        }).then((result) => {
          if (result.value) {
            $("input[name=restablecerPassword]").val("");
             $("button.btnRestablecer").attr('disabled',false);
          }
        });
      } else if (data === "inactived") {
        Swal.fire({
          title: "Usuario Inactivo",
          text: "¡El usuario actualmente se encuentra inactivo!",
          icon: "warning",
          confirmButtonColor: "#3085d6",
          allowOutsideClick: false,
          confirmButtonText: "Cerrar",
        }).then((result) => {
          if (result.value) {
            $("input[name=restablecerPassword]").val("");
          }
        });
      }
  },"json");

}

/*=============================================
Validar Contraseña
=============================================*/
function validarContrasena(value, name) {
  var password1 = $("input[name=password1]").val();
  var password2 = $("input[name=password2]").val();

  if (name == "password1") {
    if (value != password2) {
      $("input[name=password2]").addClass("is-invalid");
      $("input[name=password1]").addClass("is-invalid");
      $(".validarBtn").attr("disabled", true);
    } else {
      $("input[name=password2]").removeClass("is-invalid");
      $("input[name=password1]").removeClass("is-invalid");
      $("input[name=password2]").addClass("is-valid");
      $("input[name=password1]").addClass("is-valid");
      $(".validarBtn").attr("disabled", false);
    }
  } else if (name == "password2") {
    if (value != password1) {
      $("input[name=password2]").addClass("is-invalid");
      $("input[name=password1]").addClass("is-invalid");
      $(".validarBtn").attr("disabled", true);
    } else {
      $("input[name=password2]").removeClass("is-invalid");
      $("input[name=password1]").removeClass("is-invalid");
      $("input[name=password2]").addClass("is-valid");
      $("input[name=password1]").addClass("is-valid");
      $(".validarBtn").attr("disabled", false);
    }
  }
}

//forgotPassword

function valorBarra(value, name) {
  var charet = value.length;

  if (name === "password1") {
    if (charet != 0 && charet < 5) {
      $(".barra1").css({ width: charet * 8.325 + "%" });
      $(".barra1").attr("aria-valuenow", charet * 8.325);
      $(".barra2").css({ width: "0%" });
    } else if (charet > 4 && charet < 9) {
      $(".barra2").css({ width: (charet - 4) * 8.325 + "%" });
      $(".barra2").attr("aria-valuenow", (charet - 4) * 8.325);
      $(".barra3").css({ width: "0%" });
    } else if (charet > 8 && charet < 15) {
      $(".barra3").css({ width: (charet - 8) * 8.325 + "%" });
      $(".barra3").attr("aria-valuenow", (charet - 8) * 8.325);
    } else if (charet == 0) {
      $(".barra1").css({ width: "0%" });
      $(".barra1").attr("aria-valuenow", "0");
      $(".barra2").css({ width: "0%" });
      $(".barra2").attr("aria-valuenow", "0");
      $(".barra3").css({ width: "0%" });
      $(".barra3").attr("aria-valuenow", "0");
    }
  } else if (name === "password2") {
    if (charet != 0 && charet < 5) {
      $(".barra4").css({ width: charet * 8.325 + "%" });
      $(".barra4").attr("aria-valuenow", charet * 8.325);
      $(".barra5").css({ width: "0%" });
    } else if (charet > 4 && charet < 9) {
      $(".barra5").css({ width: (charet - 4) * 8.325 + "%" });
      $(".barra5").attr("aria-valuenow", (charet - 4) * 8.325);
      $(".barra6").css({ width: "0%" });
    } else if (charet > 8 && charet < 15) {
      $(".barra6").css({ width: (charet - 8) * 8.325 + "%" });
      $(".barra6").attr("aria-valuenow", (charet - 8) * 8.325);
    } else if (charet == 0) {
      $(".barra4").css({ width: "0%" });
      $(".barra4").attr("aria-valuenow", "0");
      $(".barra5").css({ width: "0%" });
      $(".barra5").attr("aria-valuenow", "0");
      $(".barra6").css({ width: "0%" });
      $(".barra6").attr("aria-valuenow", "0");
    }
  }
}