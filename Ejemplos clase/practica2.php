<!DOCTYPE html>
<html>
<head>
	<title>Practica 2</title>
</head>
<body>

	<?php

		//Ejercicio 1
		echo "<h2>Ejercicio 1</h2>";
		$array1 = array(2,3,4,1,5,7,8,6,9,0);
		echo "<h3>Array Original<br></h3>";
		print_r($array1);
		sort($array1);
		echo "<h3>Array Ordenado Ascendente<br></h3>";
		print_r($array1);
		echo "<br>";
		rsort($array1);
		echo "<h3>Array Ordenado Descendente<br></h3>";
		print_r($array1);


		//Ejercicio 2
		echo "<br><br><h2>Ejercicio 2</h2>";
		function funcion1($nombre,$ciudad)
		{
			$cadena = "Soy <strong>$nombre</strong> y naci en $ciudad<br><br>";
			return $cadena;
		}
		echo funcion1("Fher Francisco Torres Paz","Ciudad Victoria");


		//Ejercicio 3
		echo "<h2>Ejercicio 3</h2>";
		$array2;
		for($i = 0; $i<10; $i++)
		{
			$array2[$i] = $i+1;
		}
		print_r($array2)
	?>

</body>
</html>