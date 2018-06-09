<?php
	//Clase MvcController (CONTROLADOR)
	class MvcController
	{
		//Funcion plantilla que trae toda la plantilla y su navegacion
		public function plantilla()
		{
			require("views/template.php");
		}

		//Funcion para enlazar pagina donde tendremos una accion y esta nos permitira obtener la vista deseada
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

			$respuesta = Informacion::enlazador($enlace);
			include($respuesta);
		}
		//Funcion para registrar un producto
		public function registrarProductoController()
		{
			$respuesta = "";
			if(isset($_POST['registrar']))
			{
				if(!empty($_POST['nombre']))
				{
					$datosController = array('nombre'=>$_POST['nombre'],
											 'precio'=>$_POST['precio'],
											 'unidades'=>$_POST['unidades']);

					$respuesta = Datos::registrarProductoModel($datosController,'producto');
				}
			}
			if($respuesta == "success")
			{
				echo"<script>
							window.location = 'index.php?action=productos';
						</script>";
			}
		}

		public function registrarUsuarioController()
		{
			$respuesta = "";
			if(isset($_POST['registrar']))
			{
				if(!empty($_POST['email']))
				{
					$datosController = array('email'=>$_POST['email'],
											 'password'=>$_POST['password']);

					$respuesta = Datos::registrarUsuarioModel($datosController,'usuario');
				}
			}
			if($respuesta == "success")
			{
				echo"<script>
							window.location = 'index.php?action=usuarios';
						</script>";
			}
		}

		//Funcion del controlador que sirve para hacer la vista de todos los productos
		public function vistaProductosController()
		{

			$respuesta = Datos::vistaProductosModel("producto");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id"].'</td>
					<td>'.$item["nombre"].'</td>
					<td>'.$item["precio"].'</td>
					<td>'.$item["unidades"].'</td>
					<td><a href="index.php?action=editar_producto&id='.$item["id"].'"><button class="btn btn-block btn-outline-warning">Editar</button></a></td>
					<td><a href="index.php?action=productos&idBorrar='.$item["id"].'" onclick=confirmar();><button class="btn btn-block btn-outline-danger">Borrar</button></a></td>
				</tr>';
			}

		}

		public function vistaUsuariosController()
		{

			$respuesta = Datos::vistaUsuariosModel("usuario");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id"].'</td>
					<td>'.$item["email"].'</td>
					<td>'.$item["password"].'</td>
					<td><a href="index.php?action=editar_usuario&id='.$item["id"].'"><button class="btn btn-block btn-outline-warning">Editar</button></a></td>
					<td><a href="index.php?action=productos&idBorrar='.$item["id"].'" onclick=confirmar();><button class="btn btn-block btn-outline-danger">Borrar</button></a></td>
				</tr>';
			}

		}

		//Funcion para hacer la vista de todos los productos que no tienen stock y apreciarlos en el dashboard
		public function vistaProductosSinStock()
		{

			$respuesta = Datos::vistaProductosSinStock("producto");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["nombre"].'</td>
					<td>'.$item["unidades"].'</td>
				</tr>';
			}

		}

		//Funcion para borrar algun producto en base a su id
		public function borrarProductoController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				$respuesta = Datos::borrarProductoModel($datosController,'producto');

				if($respuesta == "success")
				{
					echo"<script>
							window.location = 'index.php?action=productos';
						</script>";
				}
			}
		}
		//Funcion para crear un formulario y poner los datos del producto respecto a su id en caso de que se quiera actualizae
		public function editarProductoController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarProductoModel($datosController, "producto");

				echo'<div class="card card-success">
              			<div class="card-header">
                			<h3 class="card-title">Editar Producto</h3>
              			</div>
              			<div class="card-body">
              				<input name="idEditar" class="form-control form-control-lg" type="hidden" placeholder=".input-lg" value = "'.$respuesta["id"].'">
              				<br>
                			<input name="nombreEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["nombre"].'">
                			<br>
                			<input name="precioEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["precio"].'">
                			<br>
                			<input name="unidadesEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["unidades"].'">
                			<br>
                			<input type="submit" value="Actualizar" onclick="confirmar();" class="btn btn-block btn-outline-primary">
              			</div>
            		</div>';
			}

		}

		public function editarUsuarioController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarUsuarioModel($datosController, "usuario");

				echo'<div class="card card-success">
              			<div class="card-header">
                			<h3 class="card-title">Editar Usuario</h3>
              			</div>
              			<div class="card-body">
              				<input name="idEditar" class="form-control form-control-lg" type="hidden" placeholder=".input-lg" value = "'.$respuesta["id"].'">
              				<br>
                			<input name="emailEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["email"].'">
                			<br>
                			<input name="passwordEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["password"].'">
                			<br>
                			<input type="submit" value="Actualizar" onclick="confirmar();" class="btn btn-block btn-outline-primary">
              			</div>
            		</div>';
			}

		}

		public function actualizarUsuarioController()
		{
			if(isset($_POST['emailEditar']))
			{
				$datosController = array( "id"=>$_POST["idEditar"],
										  "email"=>$_POST["emailEditar"],
										  "password"=>$_POST["passwordEditar"]);

				$respuesta = Datos::actualizarUsuarioModel($datosController,"usuario");

				if($respuesta == "success")
				{
					echo"<script>
							window.location = 'index.php?action=usuarios';
						</script>";

				}

				else
				{

					echo "error";

				}

			}
		}


		public function borrarUsuarioController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				$respuesta = Datos::borrarUsuarioModel($datosController,'usuario');

				if($respuesta == "success")
				{
					echo"<script>
							window.location = 'index.php?action=usuarios';
						</script>";
				}
			}
		}

		//Funcion para actualizar la BD con el nuevo producto en base a su ID
		public function actualizarProductoController()
		{
			if(isset($_POST['nombreEditar']))
			{
				$datosController = array( "id"=>$_POST["idEditar"],
										  "nombre"=>$_POST["nombreEditar"],
										  "precio"=>$_POST["precioEditar"],
										  "unidades"=>$_POST['unidadesEditar']);

				$respuesta = Datos::actualizarProductoModel($datosController,"producto");

				if($respuesta == "success")
				{

					echo"<script>
							window.location = 'index.php?action=productos';
						</script>";

				}

				else
				{

					echo "error";

				}

			}
		}

		

		//Funcion de login
		public function ingresoUsuarioController(){

			if(isset($_POST["usuarioIngreso"]) && !empty($_POST['usuarioIngreso'])){

				$datosController = array( "usuario"=>$_POST["usuarioIngreso"], 
									      "password"=>$_POST["passwordIngreso"]);

				$respuesta = Datos::ingresoUsuarioModel($datosController, "usuario");
				//Valiación de la respuesta del modelo para ver si es un usuario correcto.

				//Si los datos traidos de la base de datos son iguales a los que el usuario ingreso en las cajas de texto
				if($respuesta["email"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){

					//Entonces la variables de sesion se encienden
					$_SESSION["validar"] = true;

					header("location:index.php?action=inicio");

				}

				//Y si lo que ingreso el usuario es superadmin
				else if("superadmin" == $_POST["usuarioIngreso"] && "superadmin" == $_POST["passwordIngreso"])
				{
						$_SESSION["validar"] = true;
						header("location:index.php?action=inicio");

				}
				else
				{
					//Si no hace un action que fallo el inicio  de sesion para que mande de nuevo al inicio
					header("location:index.php?action=fallo");
				}

				

			}

		}

		//Funcion para controlar la NAVEGACION
		public function controlNav()
		{
			session_start();

				//Si ya iniicion sesion
				if(isset($_SESSION['validar']))
				{
					
					//Entonces muestra el navegador para poder entrar a los diferentes modulos
					echo "
						<li><a href='index.php?action=dashboard'>Dashboard</a></li>
						<li><a href='index.php?action=productos'>Productos</a></li>
						<li><a href='index.php?action=salir'>Salir</a></li>";

				}
				else
				{
					//Y por utlimo si no ha iniciado sesion solo muestra la opcion de iniciar sesion
					echo "<li><a href='index.php?action=ingresar'>Iniciar Sesion</a></li>";
				}

		}

		


	}

	


?>
