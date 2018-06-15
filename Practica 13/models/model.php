<?php
//Clase informacion
Class Informacion
{
	//Metodo que nos permite saber que accion estamos realizando y con esto poder obtener el archivo php que nos dara la vista
	public static function enlazador($accion)
	{
		if($accion=="productos" || $accion=="registrar_producto" || $accion=="editar_producto" || $accion=="movimiento")
		{
			$respuesta = "./views/productos/$accion.php";
		}
		else if($accion=="usuarios" || $accion=="registrar_usuario" || $accion=="editar_usuario")
		{
			$respuesta = "./views/usuarios/$accion.php";
		}
		else if($accion=="categorias" || $accion=="registrar_categoria" || $accion=="editar_categoria")
		{
			$respuesta = "./views/categorias/$accion.php";
		}
		else if($accion=="tiendas" || $accion=="salir_tienda" || $accion=="registrar_tienda" || $accion=="editar_tienda")
		{
			$respuesta = "./views/tiendas/$accion.php";
		}
		else if($accion=="ingresar" || $accion=="salir" || $accion=="dashboard" || $accion=="login")
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
		else if($accion=="ventas" || $accion=="registrar_venta" || $accion=="detalle_venta")
		{
			$respuesta = "views/ventas/$accion.php";
		}	
		else
		{
			$respuesta = "./views/modules/inicio.php";
		}

		return $respuesta;
	}
}



?>
