<!DOCTYPE html>
<html>
<head>
	<title>Practica 3</title>
</head>
<body>
	<?php


		$automovil1 = (object)["marca"=>"Toyota","modelo"=>"Corolla"];
		$automovil2 = (object)["marca"=>"Nissan","modelo"=>"Sentra"];

		function mostrar($automovil)
		{
			echo"<p>Hola! soy un $automovil->marca, de modelo $automovil->modelo</p>";
		}

		mostrar($automovil1);
		mostrar($automovil2);


	?>

</body>
</html>