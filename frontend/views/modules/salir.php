<?php  
session_destroy();
$urlFron = Route::urlFront();

echo '<script>
		window.location = "'.$urlFron.'";
	</script>';
?>