<?php  

$ventas = SalesController::showSalesTotal();
$visitas = VisitsController::showVisitsTotal();
// me trae todos los usuarios ordenados por id de forma descendente
$usuarios = UsersController::showUsersTotal("id");
$totalUsers = count($usuarios);

$products = ProductsController::showProductsTotal("id");
$totalProducts = count($products);

?>
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <!-- number_format — Formatear un número con los millares agrupados -->
        <h3>$<?php echo number_format($ventas["total"]); ?></h3>

        <p>Ventas</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="ventas" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo number_format($visitas["total"]); ?></h3>

        <p>Visitas</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="visitas" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php echo number_format($totalUsers); ?></h3>

        <p>Usuarios</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="usuarios" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3><?php echo number_format($totalProducts); ?></h3>

        <p>Productos</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="productos" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
