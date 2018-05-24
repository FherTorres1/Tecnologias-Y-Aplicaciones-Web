<?php

session_start();

if(!$_SESSION["validar"]){

	header("location:index.php?action=ingresar");

	exit();

}

?>

<h1>REGISTRO DE USUARIO</h1>

<form method="post">
	
	<input type="text" placeholder="Nombre" name="nombre" required>

	<input type="text" placeholder="Descripcion" name="descripcion" required>

	<input type="text" placeholder="Precio de compra" name="precio1" required>

	<input type="text" placeholder="Precio de Venta" name="precio2" required>

	<input type="text" placeholder="Precio para compis" name="precio3" required>

	<input type="submit" value="Enviar">

</form>

<?php
//Enviar los datos al controlador MvcController (es la clase principal de controller.php)
$registro = new MvcProductoController();
//se invoca la función registroUsuarioController de la clase MvcController:
$registro -> registroProductosController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
