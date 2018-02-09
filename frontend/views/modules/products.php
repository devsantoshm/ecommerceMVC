<?php  
$item = "ruta";
$valor = $rutas[0];

$category = ProductController::showCategories($item, $valor);
//var_dump($category['id']); // trae un fetch
if(!$category){
	$subCategory = ProductController::showSubCategories($item, $valor); //trae un fetchAll $subcategory[0]['id']
	$item2 = 'id_subcategoria';
	$valor2 = $subCategory[0]['id'];
}else{
	$item2 = 'id_categoria';
	$valor2 = $category['id']; 
}

$ordernar = 'id';
$base = 0;
$tope = 12;
$products = ProductController::showProducts($ordenar, $item, $valor, $base, $tope);
if(!$products)
	echo 'no hay productos';
?>