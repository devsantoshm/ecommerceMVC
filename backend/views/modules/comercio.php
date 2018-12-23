<?php

if($_SESSION["perfil"] != "administrador"){

echo '<script>

  window.location = "inicio";

</script>';

return;

}

?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestor Comercio
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Gestor Comercio</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- NO ES NECESARIO PONER COL-XS-12 por que boottrap lo pone de forma automatica -->
      <div class="row">
        <div class="col-md-6">
        <?php  
        include "comercio/logotipo.php";
        include "comercio/colores.php";
        include "comercio/redSocial.php";
        ?>
        </div>
        <div class="col-md-6">
          <?php  
          include "comercio/codigos.php";
          include "comercio/configuracion.php";
          ?>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->