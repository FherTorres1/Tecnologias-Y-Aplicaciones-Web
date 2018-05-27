<?php
	//Se comprueba si se ha iniciado sesion
	if(!isset($_SESSION['tipo']))
	{
		header("Location: index.php");
	}
	else
	{
		//Se comprueba si el usuario es superadmin
		if($_SESSION['tipo'] == 2)
		{
			header("Location: index.php?action=tutorias");
		}
	}
?>
<h1>EDITAR CARRERA</h1>

<form method="post" style="font-family: Arial; width: 50%; margin-left: 350px">
	
	<?php

		//Se hace una instancia del controlador
		$editarCarrera = new MvcController();
		//Se llama el metodo editarCarrera para traer el formulario y los datos de la carrera
		$editarCarrera -> editarCarreraController();
		//Se llama el metodo actualizarCarrera para actualizar la carrera en la BD
		$editarCarrera -> actualizarCarreraController();

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