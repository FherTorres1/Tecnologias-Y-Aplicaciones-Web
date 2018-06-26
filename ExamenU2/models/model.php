<?php
//Clase informacion
Class Informacion
{
	//Metodo que nos permite saber que accion estamos realizando y con esto poder obtener el archivo php que nos dara la vista
	public static function enlazador($accion)
	{
		if($accion=="grupos" || $accion=="registrar_grupo" || $accion=="editar_grupo")
		{
			$respuesta = "./views/grupos/$accion.php";
		}
		else if($accion=="alumnas" || $accion=="registrar_alumna" || $accion=="editar_alumna")
		{
			$respuesta = "./views/alumnas/$accion.php";
		}
		else if($accion=="lugares" || $accion=="editar_lugar" || $accion=="lugares_admin")
		{
			$respuesta = "./views/lugares/$accion.php";
		}
		else if($accion=="ingresar" || $accion=="salir" || $accion=="dashboard" || $accion=="login" || $accion=="dashboard")
		{
			$respuesta =  "views/modules/".$accion.".php";
		}	
		else if($accion=="index")
		{
			$respuesta = "./views/modules/inicio.php";
		}
		else if($accion=="fallo")
		{
			$respuesta = "views/modules/login.php";
		}	
		else
		{
			$respuesta = "./views/modules/inicio.php";
		}

		return $respuesta;
	}
}



?>
