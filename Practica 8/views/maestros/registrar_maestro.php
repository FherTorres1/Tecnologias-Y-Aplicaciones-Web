
<?php

	$mvc = new MvcController();
	$mvc->registrarMaestroController();
?>
<h1>Registrar maestro</h1>

<form method="POST">

<label>Carrera</label><br>
<?php $mvc->obtenerCarrerasController();?><br>
<label>Nombre</label><br>
<input type="text" name="nombre"><br>
<label>E-mail</label><br>
<input type="email" name="email"><br>
<label>Password</label><br>
<input type="text" name="password"><br>
<input type="submit" name='registrar' value="Registrar">

</form>

