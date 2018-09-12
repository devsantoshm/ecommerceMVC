<?php  
$slides = SlideController::showSlide();
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestor Slide
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Gestor Slide</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary agregarSlide">Agregar slide</button>
        </div>
        <div class="box-body">
          <ul class="todo-list">
        
        <?php 
        foreach ($slides as $key => $slide) {
          //Cuando es TRUE, los object devueltos serán convertidos a array asociativos
          $estiloImgProducto = json_decode($slide["estiloImgProducto"], true);
          $estiloTextoSlide = json_decode($slide["estiloTextoSlide"], true);
          $titulo1 = json_decode($slide["titulo1"], true);
          $titulo2 = json_decode($slide["titulo2"], true);
          $titulo3 = json_decode($slide["titulo3"], true);
        
        echo '
        <li class="itemSlide" id="'.$slide["id"].'">
          <div class="box-group" id="accordion">
            <div class="panel box box-info">
              <div class="box-header with-border">
                <span class="handle">
                  <i class="fa fa-ellipsis-v"></i>
                  <i class="fa fa-ellipsis-v"></i>
                </span>
                <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$slide["id"].'">';
                if ($slide["nombre"] != "") {
                  echo '<p class="text-uppercase">'.$slide["nombre"].'</p>';
                } else {
                  echo 'Slide '.$slide["id"];
                }
                echo '</a>
                </h4>
                <div class="btn-group pull-right">

                  <button class="btn btn-primary guardarSlide" 
                  id="'.$slide["id"].'"
                  indice="'.$key.'"
                  nombreSlide="'.$slide["nombre"].'"
                  tipoSlide="'.$slide["tipoSlide"].'"
                  estiloImgProductoTop="'.$estiloImgProducto["top"].'"
                  estiloImgProductoRight="'.$estiloImgProducto["right"].'"
                  estiloImgProductoLeft="'.$estiloImgProducto["left"].'"
                  estiloImgProductoWidth="'.$estiloImgProducto["width"].'"
                  estiloTextoSlideTop="'.$estiloTextoSlide["top"].'"
                  estiloTextoSlideRight="'.$estiloTextoSlide["right"].'"
                  estiloTextoSlideLeft="'.$estiloTextoSlide["left"].'"
                  estiloTextoSlideWidth="'.$estiloTextoSlide["width"].'"
                  imgFondo="'.$slide["imgFondo"].'"
                  rutaImgFondo="'.$slide["imgFondo"].'">

                  <i class="fa fa-floppy-o"></i></button>
                  <button class="btn btn-danger eliminarSlide"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div id="collapse'.$slide["id"].'" class="panel-collapse collapse collapseSlide">
                <div class="row">
                  <div class="col-md-4 col-xs-12">
                    <div class="box-body">
                      <div class="form-group">
                        <label>Nombre del Slide:</label>
                        <input type="text" class="form-control nombreSlide" indice="'.$key.'" value="'.$slide["nombre"].'">
                      </div>
                      <div class="form-group">

                        <input type="hidden" class="tipoSlide" value="'.$slide["tipoSlide"].'">

                        <label>Tipo de Slide:</label>
                        <label class="checkbox-inline selTipoSlide">
                          <input class="tipoSlideIzq" type="radio" value="slideOpcion1" name="tipoSlide'.$key.'" indice="'.$key.'">
                          Izquierda
                        </label>
                        <label class="checkbox-inline selTipoSlide">
                          <input class="tipoSlideDer" type="radio" value="slideOpcion2" name="tipoSlide'.$key.'" indice="'.$key.'">
                          Derecha
                        </label>
                      </div>
                      <div class="form-group">
                        <label>Cambiar Imagen Fondo:</label>
                        <br>
                        <p class="help-block">
                         <img src="'.$slide["imgFondo"].'" class="img-thumbnail previsualizarFondo" width="200px">
                        </p>
                        <input type="file" class="subirFondo" indice="'.$key.'">
                        <p class="help-block">Tamaño recomendado 1600px * 520px</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="slide">

                  <img class="cambiarFondo" src="'.$slide["imgFondo"].'" alt="">

                  <div class="slideOpciones '.$slide["tipoSlide"].'">
                       
                    <img class="imgProducto" src="'.$slide["imgProducto"].'" style="top:'.$estiloImgProducto["top"].'%; right:'.$estiloImgProducto["right"].'%; width:'.$estiloImgProducto["width"].'%; left:'.$estiloImgProducto["left"].'%;">   

                    <div class="textosSlide" style="top:'.$estiloTextoSlide["top"].'%; left:'.$estiloTextoSlide["left"].'%; width:'.$estiloTextoSlide["width"].'%; right:'.$estiloTextoSlide["right"].'%">
                      <h1 style="color:'.$titulo1["color"].'">'.$titulo1["texto"].'</h1>
                      <h2 style="color:'.$titulo2["color"].'">'.$titulo2["texto"].'</h2>
                      <h3 style="color:'.$titulo3["color"].'">'.$titulo3["texto"].'</h3>';
                     
                      if ($slide["boton"] != "") {
                      
                      echo '<a href="'.$slide["url"].'">
                          <button class="btn btn-default backColor text-uppercase">
                          '.$slide["boton"].'<span class="fa fa-chevron-right"></span>
                          </button> 
                        </a>';
                      }
                    
                    echo '</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </li>';
        } ?>
          </ul>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>