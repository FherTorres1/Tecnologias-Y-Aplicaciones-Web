
<?php
	//Se hace una instancia del controlador
	$mvc = new MvcController();
	//Se manda llamar el metodo para registrar una tutoria
	$mvc->registrarTutoriaController();
?>
<h1>Registrar tutoria</h1>

<form method="POST" style="font-family: Arial; width: 50%; margin-left: 350px">
<label>Alumno</label><br>
<?php //Se manda traer los datos a los que tiene asignado el tutor
$mvc->obtenerAlumnosDeTutorController(); ?><br>
<label>Fecha</label><br>
<input type="datetime-local" name="fecha" required=""><br>
<label>Tipo</label><br>
<select name="tipo">
	<option value="Individual">Individual</option>
	<option value="Grupal">Grupal</option>
</select><br><br>
<label>Descripcion</label><br>
<textarea name="descripcion"></textarea>
<input type="submit" name="registrar" class="tiny button">

</form>



