<?php  
$usuarios = UsersController::showUsersTotal("fecha");
$urlFron = Route::urlFron();

?>
<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">Últimos usuarios registrados</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <ul class="users-list clearfix">
    <?php
      if (count($usuarios) > 8) {
        $totalUsuarios = 8;
      } else {
        $totalUsuarios = count($usuarios);
      }

      for($i = 0; $i < $totalUsuarios; $i++){
        if ($usuarios[$i]["foto"] != "") {
          if ($usuarios[$i]["modo"] != "directo") {
            echo '<li>
              <img src="'.$usuarios[$i]["foto"].'" alt="User Image" style="width:100px;">
              <a class="users-list-name" href="#">'.$usuarios[$i]["nombre"].'</a>
              <span class="users-list-date">'.date('d-m-Y',strtotime($usuarios[$i]["fecha"])).'</span>
            </li>';
          } else {
            echo '<li>
              <img src="'.$urlFron.$usuarios[$i]["foto"].'" alt="User Image" style="width:100px;">
              <a class="users-list-name" href="#">'.$usuarios[$i]["nombre"].'</a>
              <span class="users-list-date">'.date('d-m-Y',strtotime($usuarios[$i]["fecha"])).'</span>
            </li>';            
          }
          
        } else {
          echo '<li>
              <img src="views/img/usuarios/default/anonymous.png" alt="User Image" style="width:100px;">
              <a class="users-list-name" href="#">'.$usuarios[$i]["nombre"].'</a>
              <span class="users-list-date">'.date('d-m-Y',strtotime($usuarios[$i]["fecha"])).'</span>
            </li>';
        }
      }
    ?>
    </ul>
    <!-- /.users-list -->
  </div>
  <!-- /.box-body -->
  <div class="box-footer text-center">
    <a href="usuarios" class="uppercase">Ver todos los usuarios</a>
  </div>
  <!-- /.box-footer -->
</div>