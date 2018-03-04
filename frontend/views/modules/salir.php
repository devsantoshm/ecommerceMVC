<?php  
session_destroy();
$urlFron = Route::urlFront();

if (!empty($_SESSION['id_token_google'])) {
	unset($_SESSION['id_token_google']);//destruir la variable de session
}

echo '<script>
		window.location = "'.$urlFron.'";
	</script>';
?>