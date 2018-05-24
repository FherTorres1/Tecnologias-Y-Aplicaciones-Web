<?php

class MvcProductoController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){	
		
		include "views/template.php";
	
	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){

		if(isset( $_GET['action'])){
			
			$enlaces = $_GET['action'];
		
		}

		else{

			$enlaces = "index";
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;

	}



	public function registroProductosController()
	{
		if(isset($_POST['nombre']))
		{
			$datosController = array("nombre"=>$_POST['nombre'],
								"descripcion"=>$_POST['descripcion'],
								"precio1" => $_POST['precio1'],
								"precio2" => $_POST['precio2'],
								"precio3"=> $_POST['precio3']);

			$respuesta = Producto::registroProductosModel($datosController,'productos');
			if($respuesta == "success"){

				header("location:index.php?action=ok");

			}

			else{

				header("location:index.php");
			}
		}
	}


	

}






////
?>