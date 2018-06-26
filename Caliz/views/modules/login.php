<!DOCTYPE html>
<html>
<head>
	<title>Examen</title>
</head>
<body>
	<h1>LOGIN</h1>
	<form method="POST">
	<input name="usuario" type="text" placeholder="usuario" required><br>
	<input type="password" name="password" placeholder="contrasena" required>
	<input type="submit" name="ingresar">
	</form>
</body>
</html>

<?php
	$mvc = new MvcController();
	$mvc->ingresarUsuarioController();
?>