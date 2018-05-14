<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php

		echo "<h1>Ejercicio 1</h1>";
		//Ejercicio 1
		$array1 = array("persona1" => array("nombre" => "Fher","apellido" => "Torres"), "persona2" => array("nombre" => "","apellido" => ""));

		$array1["persona2"]["nombre"] = $array1["persona1"]["nombre"];
		$array1["persona2"]["apellido"] = $array1["persona1"]["apellido"];

		echo $array1["persona1"]["nombre"] . "<br>";
		echo $array1["persona1"]["nombre"] . $array1["persona1"]["apellido"] . "<br>";
		echo $array1["persona2"]["nombre"] . $array1["persona2"]["apellido"] . "<br>";

		echo "<h1>Ejercicio 2</h1>";
		//Ejercicio2
		$array2 = array(1,2,3,4,5,6);
		echo $array2[array_search(4, $array2)] . '<br>';


		echo "<h1>Ejercicio 3</h1>";
		//Ejercicio 3
		function funcion1 ($saludo1,$saludo2,$nombre)
		{
			$cadena = "$saludo1 $nombre <br> $saludo1 $nombre <br> $saludo2 $nombre!!! <br> $saludo2 $nombre";
			return $cadena;
		}

		echo funcion1("Hello","Greetings","Fher Torres");
	?>

</body>
</html>