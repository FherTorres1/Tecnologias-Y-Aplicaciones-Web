
<?php

	$mvc = new MvcController();
	$mvc->registrarTutoriaController();
?>
<h1>Registrar maestro</h1>

<form method="POST">
<label>Alumno</label><br>
<?php $mvc->obtenerAlumnosDeTutorController(); ?><br>
<label>Fecha</label><br>
<input type="datetime-local" name="fecha"><br>
<label>Tipo</label><br>
<select name="tipo">
	<option value="Individual">Individual</option>
	<option value="Grupal">Grupal</option>
</select><br><br>
<label>Descripcion</label><br>
<textarea name="descripcion"></textarea>
<input type="submit" name="registrar">

</form>



