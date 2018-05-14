<!DOCTYPE html>
<html>
<head>
	<title>Practica 3</title>
</head>
<body>
	<?php
		/*
		CLASE ARREGLO que tiene como propiedad un arreglo donde en un constructor se llenara con 25 datos estaticos
		*/
		class Arreglo
		{
			public $arr;


			//Constructor donde se llenara el arreglo
		    function __construct()
		    {
		    	$this->arr = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24);
		    }

		    //Metodo para mostrar el arreglo
			public function mostrar()
			{
				print_r($this->arr);
			}

			//Metodo donde se realizara la serie fibonacci en base al arreglo anterior
			public function fibonacci()
			{
				$arr1[0] = $this->arr[0];
				$arr1[1] = $this->arr[1];
				for($i = 2; $i<25; $i++)
				{
					$arr1[$i] = $arr1[$i-1] + $arr1[$i-2];
				}
				print_r($arr1);
			}
		}

		//Creacion del objeto y llamado de sus metodos
		$a = new Arreglo();
		echo "<h3>Arreglo normal</h3>";
		$a -> mostrar();
		echo "<br><br><h3>Arreglo Fibonacci</h3>";
		$a -> fibonacci();


	?>

</body>
</html>