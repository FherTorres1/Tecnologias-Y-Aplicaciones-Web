<?php
	//Se comprueba si se ha iniciado sesion
	if(!isset($_SESSION['tipo']))
	{
		header("Location: index.php");
	}
	else
	{
		//Se comprueba si el usuari oes superadmin
		if($_SESSION['tipo'] == 2)
		{
			header("Location: index.php?action=tutorias");
		}
	}
?>
<h1>Registrar carrera</h1>


<form method="POST" style="font-family: Arial; width: 50%; margin-left: 350px">
<label>Nombre</label><br>
<input type="text" name="nombre"><br>
<input type="submit" name='registrar' value="Registrar" class="tiny button success">
</form>


<?php

	//Se hace una instancia del controlador
	$mvc = new MvcController();
	//Se manda llamar el metodo registrarCarrera para registrar la carrera en la BD
	$mvc->registrarCarreraController();
?>
