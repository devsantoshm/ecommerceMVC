var item = 0;
var itemPaginacion = $("#paginacion li");

$("#paginacion li").click(function(){
	item = $(this).attr("item")-1;
	movimientoSlide(item);
});

function avanzar(){
	if(item == 3)
		item = 0;
	else
		item++

	movimientoSlide(item);
}

$("#slide #avanzar").click(function(){
	avanzar();
})

$("#slide #retroceder").click(function(){
	if(item == 0)
		item = 3;
	else
		item--

	movimientoSlide(item);
})

function movimientoSlide(item){
	$("#slide ul").animate({"left": item * -100 + "%"}, 400);
	$("#paginacion li").css({"opacity":.5});
	//console.log("itemPaginacion", itemPaginacion); //0:li 1:li 2:li 3:li
	$(itemPaginacion[item]).css({"opacity":1});
}

setInterval(function(){
	avanzar();
}, 3000)