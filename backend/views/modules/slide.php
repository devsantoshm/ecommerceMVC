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
        
          <?php 
          foreach ($slides as $slide) {
            //Cuando es TRUE, los object devueltos serán convertidos a array asociativos
            $estiloImgProducto = json_decode($slide["estiloImgProducto"], true);
            $estiloTextoSlide = json_decode($slide["estiloTextoSlide"], true);
            $titulo1 = json_decode($slide["titulo1"], true);
            $titulo2 = json_decode($slide["titulo2"], true);
            $titulo3 = json_decode($slide["titulo3"], true);
          ?>
          <div class="slide">
            <img src="<?php echo $slide["imgFondo"] ?>" alt="">
            <div class="slideOpciones <?php echo $slide["tipoSlide"] ?>">
              
              <?php if ($slide["imgProducto"] != "") {
                
              echo '<img class="imgProducto" src="'.$slide["imgProducto"].'" style="top:'.$estiloImgProducto["top"].'; right:'.$estiloImgProducto["right"].'; width:'.$estiloImgProducto["width"].'; left:'.$estiloImgProducto["left"].';">';
              } 
              ?>

              <div class="textosSlide" style="top:<?php echo $estiloTextoSlide["top"] ?>; left: <?php echo $estiloTextoSlide["left"] ?>; width: <?php echo $estiloTextoSlide["width"] ?>; right: <?php echo $estiloTextoSlide["right"] ?>;">
                <h1 style="color: <?php echo $titulo1["color"] ?>"><?php echo $titulo1["texto"] ?></h1>
                <h2 style="color: <?php echo $titulo2["color"] ?>"><?php echo $titulo2["texto"] ?></h2>
                <h3 style="color: <?php echo $titulo3["color"] ?>"><?php echo $titulo3["texto"] ?></h3>
                <?php  
                if ($slide["boton"] != "") {
                
                echo '<a href="'.$slide["url"].'">
                    <button class="btn btn-default backColor text-uppercase">
                    '.$slide["boton"].'<span class="fa fa-chevron-right"></span>
                    </button> 
                  </a>';
                }
                ?>
              </div>
            </div>
          </div>
          <?php } ?>
     
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