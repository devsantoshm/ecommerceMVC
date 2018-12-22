<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar perfiles
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar perfiles</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPerfil">
          
          Agregar perfil

        </button>

      </div>

      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablaPerfiles" width="100%">
         
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>
             <th>Nombre</th>
             <th>Email</th>
             <th>Foto</th>
             <th>Perfil</th>
             <th>Estado</th>
             <th>Acciones</th>

           </tr> 

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $perfiles = ManagersController::showManagers($item, $valor);

            foreach ($perfiles as $key => $value){

               echo ' <tr>
                        <td>'.($key+1).'</td>
                        <td>'.$value["nombre"].'</td>
                        <td>'.$value["email"].'</td>';

                       if($value["foto"] != ""){

                        echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

                       }else{

                          echo '<td><img src="views/img/perfiles/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                      }

                      echo '<td>'.$value["perfil"].'</td>';

                       if($value["estado"] != 0){

                        echo '<td><button class="btn btn-success btn-xs btnActivar" idPerfil="'.$value["id"].'" estadoPerfil="0">Activado</button></td>';

                      }else{

                        echo '<td><button class="btn btn-danger btn-xs btnActivar" idPerfil="'.$value["id"].'" estadoPerfil="1">Desactivado</button></td>';

                      } 

                       echo '<td>

                        <div class="btn-group">
                            
                          <button class="btn btn-warning btnEditarPerfil" idPerfil="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarPerfil"><i class="fa fa-pencil"></i></button>

                          <button class="btn btn-danger btnEliminarPerfil" idPerfil="'.$value["id"].'" fotoPerfil="'.$value["foto"].'"><i class="fa fa-times"></i></button>

                        </div>  

                      </td>

                    </tr>';            
            }

            ?>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>
