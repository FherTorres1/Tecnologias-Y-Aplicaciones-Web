<?php
	//Se comprueba si el usuario ha iniciado sesion
	if(!isset($_SESSION['tipo']))
	{
		header("Location: index.php");
	}
	else
	{
		//Se comprueba si el usuario es super admin
		if($_SESSION['tipo'] == 2)
		{
			header("Location: index.php?action=tutorias");
		}
	}
?>
<?php

	//Se hace una instancia del controlador
	$registrarAlumno = new MvcController();
	//Se manda llamar el metodo registrar alumno del controlador
	$registrarAlumno->registrarAlumnoController();
?>
<h1>Registrar alumno</h1>

<form method="POST" style="font-family: Arial; width: 50%; margin-left: 350px">
<label>Nombre</label><br>
<input type="text" name="nombre"><br>
<label>Carrera</label><br>
<?php // Se traen las carreras que hay en la BD en un select 
$registrarAlumno->obtenerCarrerasController();?><br>
<label>Tutor</label><br>
<?php // Se obtienen los maestros que hay en la BD en un select
$registrarAlumno->obtenerMaestrosController();?><br>
<input type="submit" name='registrar' value="Registrar" class="tiny button success">

</form>

