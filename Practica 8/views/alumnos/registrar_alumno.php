
<?php

	$registrarAlumno = new MvcController();
	$registrarAlumno->registrarAlumnoController();
?>
<h1>Registrar alumno</h1>

<form method="POST">
<label>Nombre</label><br>
<input type="text" name="nombre"><br>
<label>Carrera</label><br>
<?php $registrarAlumno->obtenerCarrerasController();?><br>
<label>Tutor</label><br>
<?php $registrarAlumno->obtenerMaestrosController();?><br>
<input type="submit" name='registrar' value="Registrar">

</form>

