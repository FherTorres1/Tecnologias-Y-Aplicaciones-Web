<?php
//Clase informacion
Class Informacion
{
	//Metodo que nos permite saber que accion estamos realizando y con esto poder obtener el archivo php que nos dara la vista
	public static function enlazador($accion)
	{
		if($accion=="carreras" || $accion=="registrar_carrera" || $accion=="editar_carrera")
		{
			$respuesta = "./views/carreras/$accion.php";
		}
		else if($accion=="alumnos" || $accion=="registrar_alumno" || $accion=="editar_alumno")
		{
			$respuesta = "./views/alumnos/$accion.php";
		}
		else if($accion=="maestros" || $accion=="registrar_maestro" || $accion=="editar_maestro")
		{
			$respuesta = "./views/maestros/$accion.php";
		}
		else if($accion=="tutorias" || $accion=="registrar_tutoria")
		{
			$respuesta = "./views/tutorias/$accion.php";
		}
		else if($accion=="ingresar" || $accion=="salir" || $accion=="reportes")
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
