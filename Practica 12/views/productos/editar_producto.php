<?php
	//Se comprueba si se ha iniciado sesion
	if(!isset($_SESSION['validar']))
	{
		header("Location: index.php");
	}
?>
<h1>EDITAR PRODUCTO</h1>

<form method="post" style="font-family: Arial; width: 50%; margin-left: 350px">
	
	<?php

		//Se hace una instancia del controlador
		$editarProducto = new MvcController();
		//Se llama el metodo editarCarrera para traer el formulario y los datos del producto
		$editarProducto -> editarProductoController();
		//Se llama el metodo actualizarCarrera para actualizar el producto en la BD
		$editarProducto -> actualizarProductoController();

	?>

</form>

<script type="text/javascript">
	//Funcion para comprobar si se quiere actualizar la carrera
	function confirmar()
	{
		var x = confirm("Deseas guardar los datos?");
		if(!x)
		{
			event.preventDefault();
		}
	}
</script>