 <?php session_start(); ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tienda Online | Panel de Control</title>
 	
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="views/dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="views/plugins/iCheck/square/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="views/bower_components/morris.js/morris.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="views/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap Slider -->
  <link rel="stylesheet" href="views/plugins/bootstrap-slider/slider.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
    <!-- Bootstrap Tags input -->
  <link rel="stylesheet" href="views/plugins/tags/bootstrap-tagsinput.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="views/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Dropzone -->
  <link rel="stylesheet" href="views/plugins/dropzone/dropzone.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="views/css/plantilla.css">
  <link rel="stylesheet" href="views/css/slide.css">
  
  <!-- REQUIRED JS SCRIPTS -->
  <!-- jQuery 3 -->
  <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="views/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>

  <script src="views/plugins/iCheck/icheck.min.js"></script>

  <!-- Morris.js charts -->
  <script src="views/bower_components/raphael/raphael.min.js"></script>
  <script src="views/bower_components/morris.js/morris.min.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="views/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
  <!-- jvectormap -->
  <script src="views/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="views/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- ChartJS -->
  <script src="views/bower_components/Chart.js/Chart.js"></script>
  <!-- SweetAlert 2 https://sweetalert2.github.io/-->
  <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>
  <!-- bootstrap color picker https://farbelous.github.io/bootstrap-colorpicker/v2/-->
  <script src="views/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="views/plugins/bootstrap-slider/bootstrap-slider.js"></script>
   <!-- DataTables https://datatables.net/-->
  <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <script src="views/plugins/tags/bootstrap-tagsinput.min.js"></script>
  <script src="views/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

  <script src="views/plugins/dropzone/dropzone.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
<?php  
//session_start();
if (isset($_SESSION["validarSesionBackend"]) && $_SESSION["validarSesionBackend"] === "ok") {
  echo '<div class="wrapper">';
  include 'modules/header.php';
  include 'modules/sidebar.php';
  if (isset($_GET["ruta"])) {
    if ($_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "comercio" ||
        $_GET["ruta"] == "slide" ||
        $_GET["ruta"] == "categorias" ||
        $_GET["ruta"] == "subcategorias" ||
        $_GET["ruta"] == "productos" ||
        $_GET["ruta"] == "banner" ||
        $_GET["ruta"] == "ventas" ||
        $_GET["ruta"] == "visitas" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "mensajes" ||
        $_GET["ruta"] == "perfiles" ||
        $_GET["ruta"] == "perfil" ||
        $_GET["ruta"] == "salir") {
      
      include 'modules/'.$_GET["ruta"].'.php';
    
    }
  }

  include 'modules/footer.php';
  echo '</div>';

} else {
  // Al no tener la sesion iniciada siempre va a tener login.php
  include 'modules/login.php';
}
?>
<script src="views/js/plantilla.js"></script>
<script src="views/js/gestorComercio.js"></script>
<script src="views/js/gestorSlide.js"></script>
<script src="views/js/gestorCategorias.js"></script>
<script src="views/js/gestorSubCategorias.js"></script>
<script src="views/js/gestorProductos.js"></script>
<script src="views/js/gestorBanner.js"></script>
<script src="views/js/gestorVentas.js"></script>
<script src="views/js/gestorVisitas.js"></script>
<script src="views/js/gestorUsuarios.js"></script>
</body>
</html>