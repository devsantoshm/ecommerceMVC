<?php 

$productos = ProductsController::showProductsTotal("fecha");

?>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Productos agregados recientemente</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <ul class="products-list product-list-in-box">
      <?php  
      for($i = 0; $i < 5; $i++){
        echo '<li class="item">
                <div class="product-img">
                  <img src="'.$productos[$i]["portada"].'" alt="Product Image">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">'.$productos[$i]["titulo"];
                  if ($productos[$i]["precio"] == 0) {
                    echo '<span class="label label-warning pull-right">GRATIS</span></a>';
                  } else {
                    echo '<span class="label label-warning pull-right">'.$productos[$i]["precio"].'</span></a>';
                  }
              echo '</div>
              </li>';
      }

      ?>
    </ul>
  </div>
  <!-- /.box-body -->
  <div class="box-footer text-center">
    <a href="productos" class="uppercase">Ver todos los productos</a>
  </div>
  <!-- /.box-footer -->
</div>