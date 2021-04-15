<aside class="main-sidebar sidebar-dark-danger elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="<?php echo $Ruta; ?>vistas/img/plantilla/camara.jpg" class="brand-image img-thumbnail elevation-3" >
    <span class="brand-text font-weight-light">Gestión PAT</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">

      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">


        <?php if ($_SESSION["tipo_usuario"]=="Admin"): ?>
         <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-cog"></i>
            <p>
              Configuración
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $Ruta ?>user" class="nav-link">
                <i class="far fa-user nav-icon"></i>
                <p>Usuarios</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $Ruta ?>configuration-seguimiento" class="nav-link">
                <i class="far fa-calendar-check nav-icon"></i>
                <p>Seguimiento</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>
              Indicadores
            </p>
            <i class="right fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo $Ruta ?>indicador-pto" class="nav-link">
                <i class="fas fa-file-invoice-dollar nav-icon"></i>
                <p>Indicador Presupuesto</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $Ruta ?>indicador-act" class="nav-link">
                <i class="fas fa-chart-pie nav-icon"></i>
                <p>Indicador Actividades</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $Ruta ?>indicador-eficiencia" class="nav-link">
                <i class="far fa-chart-bar nav-icon"></i>
                <p>Indicador Eficiencia</p>
              </a>
            </li>
          </ul>
        </li>
      <?php endif ?>
      <?php
      $tabla="gerencias";
      $index="id_gerencia";
      $responseGerencia=ModeloGerencias::mdlTraerGerencias($tabla,$index,$_SESSION["gerencia_usuario"]);
      ?>
      <?php if ($responseGerencia["estado_pat_gerencia"]==0 && $_SESSION["tipo_usuario"]!="consult"): ?>
        <li class="nav-item">
          <a href="<?php echo $Ruta ?>gestion-pat" class="nav-link">
            <i class="nav-icon fas fa-tasks"></i>
            <p>
              Gestión del PAT
            </p>
          </a>
        </li>
      <?php endif ?>

      <?php if ($_SESSION["tipo_usuario"]!="consult"): ?>
        <li class="nav-item">
          <a href="<?php echo $Ruta ?>seguimiento-pat" class="nav-link">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>
              Seguimiento del PAT
            </p>
          </a>
        </li>
      <?php endif ?>

      <?php if ($_SESSION["user_usuario"]=='l_gutierrez' || $_SESSION["user_usuario"]=='o_lizcano' && $_SESSION["tipo_usuario"]!="consult"): ?>
        <li class="nav-item">
          <a href="<?php echo $Ruta ?>poa" class="nav-link">
            <i class="nav-icon fas fa-file-signature"></i>
            <p>
              POA
            </p>
          </a>
        </li>
      <?php endif ?>

      <li class="nav-item">
        <a href="<?php echo $Ruta ?>gerencias" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Gerencias y Direcciones
          </p>
        </a>
      </li>


    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
