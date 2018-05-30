<?php
//Clase informacion
Class Informacion
{
	//Metodo que nos permite saber que accion estamos realizando y con esto poder obtener el archivo php que nos dara la vista
	public static function enlazador($accion)
	{
		if($accion=="productos" || $accion=="registrar_producto" || $accion=="editar_producto")
		{
			$respuesta = "./views/productos/$accion.php";
		}
		else if($accion=="ingresar" || $accion=="salir" || $accion=="dashboard")
		{
			$respuesta =  "views/modules/".$accion.".php";
		}	
		else if($accion=="index")
		{
			$respuesta = "./views/modules/inicio.php";
		}
		else
		{
			$respuesta = "./views/modules/inicio.php";
		}

		return $respuesta;
	}
}



?>
