<?php

	//Se comprueba si el usuario ha iniciado sesion
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
<h1>EDITAR ALUMNO</h1>

<form method="post" style="font-family: Arial; width: 50%; margin-left: 350px">
	
	<?php
		//.......METODOS DE CONTROLLER

		//Se hace una instancia de la clase MvcController
		$editarAlumno = new MvcController();
		//Se manda llamar el metodo editar alumno
		$editarAlumno -> editarAlumnoController();
		//Se manda llamar el metodo actualizar alumno
		$editarAlumno -> actualizarAlumnoController();

	?>

</form>

<script type="text/javascript">

	//Funcion JS para confirmar si queremos editar el registro
	function confirmar()
	{
		var x = confirm("Deseas guardar los datos?");
		if(!x)
		{
			event.preventDefault();
		}
	}
</script>