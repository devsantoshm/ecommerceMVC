$.ajax({
	url: "ajax/AjaxTemplate.php",
	success: function(response){
		//console.log(JSON.parse(response)); //convertir un string en formato json
		var colorFondo = JSON.parse(response).colorFondo;
		var colorTexto = JSON.parse(response).colorTexto;
		var barraSuperior = JSON.parse(response).barraSuperior;
		var textoSuperior = JSON.parse(response).textoSuperior;

		$(".backColor, .backColor a").css({"background": colorFondo,
											"color": colorTexto})
		$(".barraSuperior, .barraSuperior a").css({"background": barraSuperior,
											"color": textoSuperior})
	}
});

var btnList = $(".btnList");
//console.log("btnList", btnList.length) , numero de clases btnList
for (var i = 0; i < btnList.length; i++) {
	$("#btnGrid"+i).click(function(){
		//extracts parts of a string To extract characters from the end of the string, use a negative start number
		var numero = $(this).attr("id").substr(-1);
		$(".list"+numero).hide(); //display:none
		$(".grid"+numero).show(); //display:block

		$("#btnGrid"+numero).addClass("backColor");
		$("#btnList"+numero).removeClass("backColor");
	})

	$("#btnList"+i).click(function(){
		//extracts parts of a string To extract characters from the end of the string, use a negative start number
		var numero = $(this).attr("id").substr(-1);
		$(".list"+numero).show();
		$(".grid"+numero).hide(); 

		$("#btnGrid"+numero).removeClass("backColor");
		$("#btnList"+numero).addClass("backColor");
	})
}