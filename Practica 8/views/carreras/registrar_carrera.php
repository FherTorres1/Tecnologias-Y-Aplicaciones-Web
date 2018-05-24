
<h1>Registrar carrera</h1>

<label>Nombre</label><br>

<form method="POST">

<input type="text" name="nombre"><br>
<input type="submit" name='registrar' value="Registrar">
</form>


<?php

	$mvc = new MvcController();
	$mvc->registrarCarreraController();
?>
