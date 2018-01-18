$.ajax({
	url: "ajax/AjaxTemplate.php",
	success: function(response){
		console.log(JSON.parse(response)); //convertir un string en formato json
	}
});