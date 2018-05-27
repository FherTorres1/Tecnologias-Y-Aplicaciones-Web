<?php
	//Se comprueba si se ha iniciado sesion
	if(!isset($_SESSION['tipo']))
	{
		header("Location: index.php");
	}
	else
	{
		//Se comprueba si es superadmin
		if($_SESSION['tipo'] == 2)
		{
			header("Location: index.php?action=tutorias");
		}
	}
?>
<h1>EDITAR MAESTRO</h1>

<form method="post" style="font-family: Arial; width: 50%; margin-left: 350px">
	
	<?php
		//Se hace una instancia del controlador
		$editarMaestro = new MvcController();
		//Se manda llamar el metodo para traer el formulario y datos del maestro
		$editarMaestro -> editarMaestroController();
		//Se manda llamar el metodo para actualizar el maestro
		$editarMaestro -> actualizarMaestroController();

	?>

</form>

<script type="text/javascript">
	//Funcion de JS para comprobar si queremos actualizae
	function confirmar()
	{
		var x = confirm("Deseas guardar los datos?");
		if(!x)
		{
			event.preventDefault();
		}
	}
</script>