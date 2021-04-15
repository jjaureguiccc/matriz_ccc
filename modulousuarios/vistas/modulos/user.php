<?php
if (isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"] != "Admin") {
  echo "<script>
  window.location='gestion-pat';
  </script>";
  return;
}
?>
<div class="content-wrapper" style="min-height: 1589.56px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="font-weight-bold">USUARIOS</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card card-outline card-info">


      <div class="card-header ">

        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#crearUsuario">
          Crear Usuario
        </button>

      </div>

      <div class="card-body table-responsive-md p-lg-4">
        <table class="table table-bordered table-striped dt-responsive tableUsuarios" width="100%">
          <thead>
            <tr class="table-info">
              <th style="width:10px">#</th>
              <th>Nombres</th>
              <th>cargo</th>
              <th>Usuario</th>
              <th>Perfil Usuario</th>
              <th>Gerencia</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</div>


<!-- Modal Crear Usuario -->
<div class="modal fade" id="crearUsuario">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title font-weight-bold ">Crear Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- ENTRADA PARA El NOMBRE-->
          <div class="form-group">
            <div class="input-group ">
              <div class="input-group-prepend ">
                <span class="input-group-text">
                  <i class=" fas fa-user"></i>
                </span>
              </div>
              <input type="text" class="form-control" name="nuevoNombre" placeholder="Ingrese el Nombre" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+" required>
            </div>
          </div>

          <!-- ENTRADA PARA El CARGO-->
          <div class="form-group">
            <div class="input-group ">
              <div class="input-group-prepend ">
                <span class="input-group-text">
                  <i class=" fas fa-address-card"></i>
                </span>
              </div>
              <input type="text" class="form-control" name="nuevoCargo" placeholder="Ingrese el Cargo" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+" required>
            </div>
          </div>

          <!-- ENTRADA PARA El GERENCIA-->
          <div class="form-group">
            <label>Seleccione la Gerencia y/o Dirección:</label>
            <select class="form-control" name="nuevoGerencia" required>
              <option value="">Seleccione</option>
              <?php
              $valorGerencias = ControladorPat::ctrlTraerGerencia('id_gerencia', null);
              foreach ($valorGerencias as $key => $value) {
                echo '<option value="' . $value["id_gerencia"] . '">' . $value["nombre_gerencia"] . '</option>';
              }
              ?>
            </select>
          </div>

          <!-- ENTRADA PARA El USUARIO  -->
          <div class="form-group">
            <div class="input-group ">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class=" fas fa-user-plus"></i>
                </span>
              </div>
              <input type="text" class="form-control" name="nuevoUsuario" placeholder="Ingrese el Usuario" pattern="[-_a-zA-Z0-9]+" autocomplete="off" title="El usuario no debe contener caracteres especiales" required>
            </div>
          </div>

          <!-- ENTRADA PARA El PASSWORD  -->
          <div class="form-group">
            <div class="input-group ">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class=" fas fa-lock"></i>
                </span>
              </div>
              <input type="password" class="form-control" name="nuevoPassword" placeholder="Ingrese la Contraseña" pattern="[\-%*._a-zA-Z0-9ñÑ]{5,30}" title="La contreña debe contener minimo (5)cinco carecteres" required>
              <div class="input-group-prepend">
                <a class="btn btn-primary input-group-text inputPassword" onclick="mostrarContrasena()" title="Mostrar Contraseña" style="cursor: pointer">
                  <i class=" fas fa-eye-slash"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- ENTRADA PARA El perfil-->
          <div class="form-group">
            <label>Seleccione el perfil:</label>
            <select class="form-control" name="nuevoPerfil" required>
              <option value="">Seleccione</option>
              <option value="Admin">Administrador</option>
              <option value="leader">Principal</option>
              <option value="user">Usuario</option>
              <option value="consult">Consultor</option>
            </select>
          </div>
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Usuario</button>
        </div>

      </form>
      <?php
      $respuesta = new ControladorUsuarios();
      $respuesta->ctrlRegistrarUsuario();
      ?>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- /*=============================================>>>>>
Modal Modificar Usuario
===============================================>>>>>*/ -->
<div class="modal fade" id="modalModificarUsuario">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title font-weight-bold ">Modificar Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- ENTRADA PARA El NOMBRE-->
          <div class="form-group">
            <div class="input-group ">
              <div class="input-group-prepend ">
                <span class="input-group-text">
                  <i class=" fas fa-user"></i>
                </span>
              </div>
              <input type="text" class="form-control" name="editarNombre" placeholder="Ingrese el Nombre" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+" required>
            </div>
          </div>

          <!-- ENTRADA PARA El CARGO-->
          <div class="form-group">
            <div class="input-group ">
              <div class="input-group-prepend ">
                <span class="input-group-text">
                  <i class=" fas fa-address-card"></i>
                </span>
              </div>
              <input type="text" class="form-control" name="editarCargo" placeholder="Ingrese el Cargo" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+" required>
            </div>
          </div>

           <!-- ENTRADA PARA El CORREO-->
           <div class="form-group">
            <div class="input-group ">
              <div class="input-group-prepend ">
                <span class="input-group-text">
                  <i class=" fas fa-at"></i>
                </span>
              </div>
              <input type="email" class="form-control" name="editarCorreo" placeholder="Ingrese el Correo" pattern="^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$" required>
            </div>
          </div>

          <!-- ENTRADA PARA El GERENCIA-->
          <div class="form-group">
            <label>Seleccione la Gerencia y/o Dirección:</label>
            <select class="form-control" name="editarGerencia" required>
              <option value="">Seleccione</option>
              <?php
              $valorGerencias = ControladorPat::ctrlTraerGerencia('id_gerencia', null);
              foreach ($valorGerencias as $key => $value) {
                echo '<option value="' . $value["id_gerencia"] . '">' . $value["nombre_gerencia"] . '</option>';
              }
              ?>
            </select>
          </div>

          <!-- ENTRADA PARA El USUARIO  -->
          <div class="form-group">
            <div class="input-group ">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class=" fas fa-user-plus"></i>
                </span>
              </div>
              <input type="text" class="form-control" name="editarUsuario" placeholder="Ingrese el Usuario" pattern="[-_a-zA-Z0-9]+" autocomplete="off" title="El usuario no debe contener caracteres especiales" readonly>
            </div>
          </div>

          <!-- ENTRADA PARA El PASSWORD  -->
          <div class="form-group">
            <div class="input-group ">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class=" fas fa-lock"></i>
                </span>
              </div>
              <input type="password" class="form-control" name="editarPassword" placeholder="Ingrese la Contraseña" pattern="[\-%*._a-zA-Z0-9ñÑ]{5,30}" title="La contreña debe contener minimo (5)cinco carecteres">
              <div class="input-group-prepend">
                <a class="btn btn-primary input-group-text inputPassword" onclick="mostrarContrasena()" title="Mostrar Contraseña" style="cursor:pointer;">
                  <i class="fas fa-eye-slash"></i>
                </a>
              </div>
            </div>
            <input type="hidden" id="passwordActual" name="passwordActual">
          </div>

         <!-- ENTRADA PARA El perfil-->
         <div class="form-group">
            <label>Seleccione el perfil:</label>
            <select class="form-control" name="editarPerfil" required>
              <option value="">Seleccione</option>
              <option value="Admin">Administrador</option>
               <option value="leader">Principal</option>
              <option value="user">Usuario</option>
              <option value="consult">Consultor</option>
            </select>
          </div>

        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar Usuario</button>
        </div>

        <?php
        $respuesta = new ControladorUsuarios();
        $respuesta->ctrlModificarUsuario();
        ?>
      </form>


    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->