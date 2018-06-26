<!DOCTYPE html>
<html>
<head>
	<title>Examen</title>
</head>
<body>

	<?php
		session_start();
		require_once("controller/controller.php");
		$mvc = new MvcController();
		$mvc->enlazarPagina();
	?>
</body>
</html>