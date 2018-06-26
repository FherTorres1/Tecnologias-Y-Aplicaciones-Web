<?php
	Class Informacion
	{
		public static function enlazar($enlace)
		{
			if($enlace == 'usuarios')
			{
				$respuesta = './views/usuarios/$enlace.php';
			}
			else if($enlace=='login')
			{
				$respuesta="./views/modules/$enlace.php";
			}
			else if($enlace == 'index')
			{
				$respuesta = './views/modules/inicio.php';
			}
			else
			{
				$respuesta = './views/modules/inicio.php';
			}

			return $respuesta;
		}
	}
?>