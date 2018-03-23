//si localstorage viene con informacion entonces almacenamos en listacarrito
if (localStorage.getItem("listaProductos") != null) {
	//convertir el string en un objeto json
	var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"));
}

$(".agregarCarrito").click(function(){
	var idProducto = $(this).attr("idProducto");
	var imagen = $(this).attr("imagen");
	var titulo = $(this).attr("titulo");
	var precio = $(this).attr("precio");
	var tipo = $(this).attr("tipo");
	var peso = $(this).attr("peso");

	var agregarAlCarrito = false;

	if (tipo == "virtual") {
		agregarAlCarrito = true;
	} else {
		var seleccionarDetalle = $(".seleccionarDetalle")
		for(var i = 0; i < seleccionarDetalle.length; i++){
			if ($(seleccionarDetalle[i]).val() == "") {
				swal({
					  title:"Debe seleccionar Talla y Color",
					  text: "",
					  type: "warning",
					  showCancelButton: false,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "¡Seleccionar!",
					  closeOnConfirm: false
					});
			} else {
				titulo = titulo + "-" + $(seleccionarDetalle[i]).val();
				agregarAlCarrito = true;
			}
		}
	}
	//almacenar en el localStorage los productos agregados al carrito
	if (agregarAlCarrito) {
		//recuperar almacenamiento del localStorage
		if (localStorage.getItem("listaProductos") == null) {
			listaCarrito = [];
		} else {
			listaCarrito.concat(localStorage.getItem("listaProductos"))
		}
		listaCarrito.push({"idProducto":idProducto,
							"imagen":imagen,
							"titulo":titulo,
							"precio":precio,
							"tipo":tipo,
							"peso":peso,
							"cantidad":"1"});

		localStorage.setItem("listaProductos", JSON.stringify(listaCarrito)); //convertir a string
	}
})