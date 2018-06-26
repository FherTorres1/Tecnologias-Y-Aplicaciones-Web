<?php
	class MvcController
	{
		public function plantilla()
		{
			require('views/template.php');
		}

		public function enlazarPagina()
		{
			if(isset($_GET['action']))
			{
				$enlace = $_GET['action'];
			}
			else
			{
				$enlace = 'inicio';
			}
			$respuesta = Informacion::enlazar($enlace);
			include($respuesta);
		}

		public function ingresarUsuarioController()
		{
			if(!empty($_POST['usuario']) && !empty($_POST['password']))
			{
				$datosController = array("usuario"=>$_POST['usuario'],
										"password"=>$_POST['password']);

				$respuesta = Datos::ingresoUsuarioModel($datosController,'usuario');

				print_r($respuesta);
				if($respuesta)
				{
				 	$_SESSION['validar'] = true;
				 	header("Location: index.php");
				}
			}
		}

		public function vistaUsuariosController()
		{
			$respuesta = Datos::vistaUsuariosModel('usuario');
			foreach ($respuesta as $row => $item) 
			{
				echo '<td>'.$item['usuario'].'</td>
					 <td>'.$item['password'].'</td>
					 <td><input type="button" href="index.php?action=borrar_usuario&"';
			}
		}
	}
?>