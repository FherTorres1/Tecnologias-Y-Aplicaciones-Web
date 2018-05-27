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
<?php

	//Se hace una instancia del controlador
	$mvc = new MvcController();
	//Se manda llamar el metodo registrarMaestro para hacer el registro
	$mvc->registrarMaestroController();
?>
<h1>Registrar maestro</h1>

<form method="POST" style="font-family: Arial; width: 50%; margin-left: 350px">

<label>Carrera</label><br>
<?php //Se obtienen las carreras en un select 
$mvc->obtenerCarrerasController();?><br>
<label>Nombre</label><br>
<input type="text" name="nombre"><br>
<label>E-mail</label><br>
<input type="email" name="email"><br>
<label>Password</label><br>
<input type="text" name="password"><br>
<input type="submit" name='registrar' value="Registrar" class="tiny button success">

</form>

