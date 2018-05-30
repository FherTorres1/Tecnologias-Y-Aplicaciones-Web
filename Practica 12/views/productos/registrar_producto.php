<?php
	//Se comprueba si se ha iniciado sesion
	if(!isset($_SESSION['validar']))
	{
		header("Location: index.php");
	}
?>
<h1>Registrar carrera</h1>


<form method="POST" style="font-family: Arial; width: 50%; margin-left: 350px">
<label>Nombre</label><br>
<input type="text" name="nombre"><br>
<label>Precio</label><br>
<input type="text" name="precio"><br>
<label>Unidades Existentes</label><br>
<input type="number" name="unidades"><br>
<input type="submit" name='registrar' value="Registrar" class="tiny button success">
</form>


<?php

	//Se hace una instancia del controlador
	$mvc = new MvcController();
	//Se manda llamar el metodo registrarProducto para registrar el producto en la BD
	$mvc->registrarProductoController();
?>
