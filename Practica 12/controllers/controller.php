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
					$today = date("Y-m-d H:i:s"); 
					$datosController = array('codigo'=>$_POST['codigo'],
											 'nombre'=>$_POST['nombre'],
											 'date'=>$today,
											 'precio'=>$_POST['precio'],
											 'unidades'=>$_POST['unidades'],
											 'categoria'=>$_POST['categoria']);

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

		//Funcion para registrar una categoria nueva
		public function registrarCategoriaController()
		{
			$respuesta = "";
			if(isset($_POST['registrar']))
			{

				if(!empty($_POST['nombre']))
				{
					$today = date("Y-m-d H:i:s"); 
					$datosController = array('nombre'=>$_POST['nombre'],
											 'descripcion'=>$_POST['descripcion'],
											 'date'=>$today);

					$respuesta = Datos::registrarCategoriaModel($datosController,'categoria');
				}
			}
			if($respuesta == "success")
			{
				echo"<script>
							window.location = 'index.php?action=categorias';
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
					$today = date("Y-m-d H:i:s"); 
					$datosController = array('nombre'=>$_POST['nombre'],
											 'apellido'=>$_POST['apellido'],
											 'user'=>$_POST['user'],
											 'password'=>($_POST['password']),
											 'email'=>$_POST['email'],
											 'date'=>$today);

					$respuesta = Datos::registrarUsuarioModel($datosController,'user');
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
					<td class="clickable-row" data-href="index.php?action=movimiento&id='.$item["id_producto"].'">'.$item["id_producto"].'</td>
					<td class="clickable-row" data-href="index.php?action=movimiento&id='.$item["id_producto"].'">'.$item["nombre_producto"].'</td>
					<td class="clickable-row" data-href="index.php?action=movimiento&id='.$item["id_producto"].'">'.$item["precio_producto"].'</td>
					<td class="clickable-row" data-href="index.php?action=movimiento&id='.$item["id_producto"].'">'.$item["stock"].'</td>
					<td class="clickable-row" data-href="index.php?action=movimiento&id='.$item["id_producto"].'">'.$item["nombre_categoria"].'</td>
					<td><div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-cog"></span>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?action=editar_producto&id='.$item["id_producto"].'">Actualizar</a>
                            <a class="dropdown-item" href="index.php?action=productos&idBorrar='.$item["id_producto"].'" onclick=confirmar();>Eliminar</a>
                            <a class="dropdown-item" href="index.php?action=movimiento&id='.$item["id_producto"].'">
                            	Realizar movimiento</a>
                          </div></td>
				</tr>';
			}

		}

		public function obtenerDatosProductoController()
		{

			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::obtenerProductoModel($datosController, "producto");

				echo '<section class="content">
      					<div class="container-fluid">
        					<div class="col-12">
        						<div class="card card-default">
          							<div class="card-header">
            							<h3 class="card-title">'.$respuesta[0][2] .'</h3>
														<div class="card-tools">
              								<button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            								</div>
          							</div>
          							<!-- /.card-header -->
          							<div class="card-body">
            							<div class="row">
              							<div class="col-md-6">
                							<div class="form-group">
                  							<center><img src="views/dist/img/stock.png" width="275" height="200" alt="Imagen de producto"></center>
                							</div>
                							<!-- /.form-group -->
                							<div class="form-group">
	                							<div class="input-group-prepend">
	                							<input type="hidden" name="stockBd" value="'.$respuesta[0]['stock'].'"> 
	                							<input type="hidden" name="idProducto" value="'.$datosController.'"> 
		                  							<input required type="text" name="referencia" class="form-control" placeholder="Referencia" style="width:200px;">           
		                  							<span style="width:90px;" class="input-group-text">Unidades</span>
		                  							<input required name="cantidad" type="number" style="width:70px;"type="text" class="form-control">
		                  						</div>
                							</div>
                							<div class="form-group">
                							</div>
                							<!-- /.form-group -->
              							</div>
              							<!-- /.col -->
              							<div class="col-md-6">
                							<div class="form-group">
                							<h4>Categoria: '.$respuesta[0]['nombre_categoria'].'</h4>
                  							<h4>Descripcion: '.$respuesta[0]['descripcion_categoria'].'</h4>
                  							<h4>Stock disponible: '.$respuesta[0]['stock'].'</h4>
                  							<h4 style="color:green;">Precio de venta: $'.$respuesta[0]['precio_producto'].'</h4>
                							</div>
							                <!-- /.form-group -->
							                
                							<!-- /.form-group -->
              							</div>
              							<!-- /.col -->
            							</div>

            							<!-- /.row -->
          							</div>
          							<center>
		                  				<input type="image" src="views/dist/img/stock-in.png"name="entrada" value="Entrada">           
		                  				<input type="image" src="views/dist/img/stock-out.png" name="salida" value="Salida">
		                  			</center><br><br>
          							<table id="example1" class="table table-bordered table-striped">
                						<thead class="bg-info">
                							<tr>
                  								<th>Fecha</th>
								                <th>Descripcion</th>
								                <th>Referencia</th>
								                <th>Total</th>
                							</tr>
                						</thead >
										<tbody>';
										$this->vistaHistorialController();
								   echo'</tbody>
										</table>
    								</div>
										</section>';
			}
			
		}

		public function vistaDashboardController()
		{

			$respuesta = Datos::countUsersModel("producto");
			echo '<div class="col-lg-3 col-6">
                  	<div class="small-box bg-info">
                    	<div class="inner">
                      		<h3>'.$respuesta[0][0].'</h3>
							<p>Productos</p>
                    	</div>
                    	<div class="icon">
                      		<i class="fa fa-shopping-cart"></i>
                    	</div>
                    	<a href="index.php?action=productos" class="small-box-footer">
                      		More info <i class="fa fa-arrow-circle-right"></i>
                    	</a>
                  	</div>
                </div>';
            $respuesta = Datos::countProductsModel("user");
            echo '<div class="col-lg-3 col-6">
            		<!-- small card -->
            		<div class="small-box bg-warning">
              			<div class="inner">
                			<h3>'.$respuesta[0][0].'</h3>
							<p>Usuarios</p>
              			</div>
              			<div class="icon">
                			<i class="ion ion-person-add"></i>
              			</div>
	              			<a href="index.php?action=usuarios" class="small-box-footer">
	                			More info <i class="fa fa-arrow-circle-right"></i>
	              			</a>
            			</div>
          		</div>';

          	$respuesta = Datos::countCategoriesModel("categoria");

          	echo '<div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>'.$respuesta[0][0].'</h3>

                <p>Categorias</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="index.php?action=categorias" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>';
		}

		public function controlarStockController()
		{
			if(isset($_POST['entrada']))
			{
				if(!empty($_POST['cantidad']) && !empty($_POST['referencia']))
				{	
					$stockBD = $_POST['stockBd'];
					$cantity = $_POST['cantidad'];
					$newStock = $stockBD + $cantity;

					$datosController = array('cantidad'=>$newStock,
										     'id'=>$_POST['idProducto']);

					$respuesta = Datos::insertarStockModel($datosController,"producto");

					if($respuesta=="success")
					{
						$fecha = date("Y-m-d H:i:s");
						$nota = 'El empleado ' . $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] . ' agrego ' . $cantity . ' producto(s) al inventario';
						$datosController = array('idProducto'=>$_POST['idProducto'],
												 'idUser'=>$_SESSION['id'],
												 'fecha'=>$fecha,
												 'nota'=>$nota,
												 'referencia'=>$_POST['referencia'],
												 'cantidad'=>$cantity);
						$respuesta = Datos::insertarHistorialModel($datosController,"historial");
						if($respuesta=="success")
						{
							echo"<script>
									location.reload();
								</script>";
						}
					}
				}
			}
			else if(isset($_POST['salida']))
			{
				if(!empty($_POST['cantidad']) && !empty($_POST['referencia']))
				{
					$stockBD = $_POST['stockBd'];
					$cantity = $_POST['cantidad'];
					$newStock = $stockBD - $cantity;
					if($newStock < 0)
					{
						echo '<script type="text/javascript">
								window.alert("No hay suficiente stock!");
								event.preventDefault();
							  </script>';
					}
					else
					{	
						$datosController = array('cantidad'=>$newStock,
												 'id'=>$_POST['idProducto']);
						$respuesta = Datos::insertarStockModel($datosController,"producto");

						if($respuesta=="success")
						{
							$fecha = date("Y-m-d H:i:s");
							$nota = 'El empleado ' . $_SESSION['nombre'] . ' ' . $_SESSION['apellido'] . ' elimino ' . $cantity . ' producto(s) del inventario';
							$datosController = array('idProducto'=>$_POST['idProducto'],
												 	'idUser'=>$_SESSION['id'],
												 	'fecha'=>$fecha,
												 	'nota'=>$nota,
												 	'referencia'=>$_POST['referencia'],
												 	'cantidad'=>$cantity);
							$respuesta = Datos::insertarHistorialModel($datosController,"historial");
							if($respuesta=="success")
							{
								echo"<script>
										location.reload();
									</script>";
							}
						}
					}
				}
			}

		}

		public function vistaCategoriasController()
		{

			$respuesta = Datos::vistaCategoriasModel("categoria");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id_categoria"].'</td>
					<td>'.$item["nombre_categoria"].'</td>
					<td>'.$item["descripcion_categoria"].'</td>
					<td>'.$item["date_added"].'</td>
					<td><div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-cog"></span>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?action=editar_categoria&id='.$item["id_categoria"].'">Actualizar</a>
                            <a class="dropdown-item" href="index.php?action=categorias&idBorrar='.$item["id_categoria"].'" onclick=confirmar();>Eliminar</a>
                          </div></td>
				</tr>';
			}

		}

		public function obtenerCategoriasController()
		{

			$respuesta = Datos::vistaCategoriasModel("categoria");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item)
			{
				echo'<option value='.$item["id_categoria"].'>'.$item["nombre_categoria"].'</option>';
			}

		}

		public function vistaUsuariosController()
		{

			$respuesta = Datos::vistaUsuariosModel("user");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id_user"].'</td>
					<td>'.$item["firstname"].'</td>
					<td>'.$item["lastname"].'</td>
					<td>'.$item["user_name"].'</td>
					<td>'.md5($item["user_password_hash"]).'</td>
					<td>'.$item["user_email"].'</td>
					<td><div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-cog"></span>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?action=editar_usuario&id='.$item["id_user"].'">Actualizar</a>
                            <a class="dropdown-item" href="index.php?action=usuarios&idBorrar='.$item["id_user"].'" onclick=confirmar();>Eliminar</a>
                          </div></td>
				</tr>';
			}

		}

		public function vistaHistorialController()
		{

			$hoy = date("Y-m-d");
			$today = $hoy . " 00:00:00";
			$later = $hoy . " 23:59:59";
			$datosController = array('hoy' =>$today,
								'later' =>$later);


			$respuesta = Datos::vistaHistorialModel($datosController,"historial");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["fecha"].'</td>
					<td>'.$item["nota"].'</td>
					<td>'.$item["referencia"].'</td>
					<td>'.$item["cantidad"].'</td>
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
					<td>'.$item["nombre_producto"].'</td>
					<td>'.$item["stock"].'</td>
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

		public function borrarCategoriaController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				$respuesta = Datos::borrarCategoriaModel($datosController,'categoria');

				if($respuesta == "success")
				{
					echo"<script>
							window.location = 'index.php?action=categorias';
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
              				<input name="idEditar" class="form-control form-control-lg" type="hidden" placeholder=".input-lg" value = "'.$respuesta["id_producto"].'">
              				<br>

                			<input name="codigoEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["codigo_producto"].'">
                			<br>
                			<input name="nombreEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["nombre_producto"].'">
                			<br>
                			<input name="precioEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["precio_producto"].'">
                			<br>
                			<input name="unidadesEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["stock"].'">
                			<br>
							<label>Categoria</label>
                        	<select class="form-control select2" style="width: 100%;" name="categoria">';

         					$respuesta2 = Datos::vistaCategoriasModel("categoria");
							#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

							foreach($respuesta2 as $row => $item)
							{
								if($item['id_categoria'] == $respuesta['id_categoria'])
								{
									echo'<option selected value='.$item["id_categoria"].'>'.$item["nombre_categoria"].'</option>';
								}
								else
								{
									echo'<option value='.$item["id_categoria"].'>'.$item["nombre_categoria"].'</option>';
								}
							}
                        	echo '</select>
                        	<br>
                        	<br>
                			<input type="submit" value="Actualizar" onclick="confirmar();" class="btn btn-block btn-outline-primary">
              			</div>
            		</div>';
			}

		}

		public function editarCategoriaController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarCategoriaModel($datosController, "categoria");

				echo'<div class="card card-success">
              			<div class="card-header">
                			<h3 class="card-title">Editar Producto</h3>
              			</div>
              			<div class="card-body">
              				<input name="idEditar" class="form-control form-control-lg" type="hidden" placeholder=".input-lg" value = "'.$respuesta["id_categoria"].'">
              				<br>
                			<input name="nombreEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["nombre_categoria"].'">
                			<br>
                			<textarea name="descripcionEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg">'.$respuesta["descripcion_categoria"].'</textarea>
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
				$respuesta = Datos::editarUsuarioModel($datosController, "user");

				echo'<div class="card card-success">
              			<div class="card-header">
                			<h3 class="card-title">Editar Usuario</h3>
              			</div>
              			<div class="card-body">
              				<input name="idEditar" class="form-control form-control-lg" type="hidden" placeholder=".input-lg" value = "'.$respuesta["id_user"].'">
              				<br>
                			<input name="nombreEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["firstname"].'">
                			<br>
                			<input name="apellidoEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["lastname"].'">
                			<br>
                			<input name="userEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["user_name"].'">
                			<br>
                			<input name="emailEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["user_email"].'">
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
										  "nombre"=>$_POST["nombreEditar"],
										  "apellido"=>$_POST["apellidoEditar"],
										  "user"=>$_POST["userEditar"],
										  "emailEditar"=>$_POST['emailEditar']);

				$respuesta = Datos::actualizarUsuarioModel($datosController,"user");

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
				$respuesta = Datos::borrarUsuarioModel($datosController,'user');

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

		//Funcion para actualizar la BD con la nueva categoria en base a su id
		public function actualizarCategoriaController()
		{
			if(isset($_POST['nombreEditar']))
			{
				$datosController = array( "id"=>$_POST["idEditar"],
										  "nombre"=>$_POST["nombreEditar"],
										  "descripcion"=>$_POST["descripcionEditar"]);

				$respuesta = Datos::actualizarCategoriaModel($datosController,"categoria");

				if($respuesta == "success")
				{

					echo"<script>
							window.location = 'index.php?action=categorias';
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

			if(isset($_POST["email"]) && !empty($_POST['email'])){

				$datosController = array( "email"=>$_POST["email"], 
									      "password"=>$_POST['password']);

				$respuesta = Datos::ingresoUsuarioModel($datosController, "user");
				//Valiación de la respuesta del modelo para ver si es un usuario correcto.

				//Si los datos traidos de la base de datos son iguales a los que el usuario ingreso en las cajas de texto
				if($respuesta["user_email"] == $_POST["email"] && $respuesta["user_password_hash"] == $_POST['password']){

					//Entonces la variables de sesion se encienden
					$_SESSION["validar"] = true;
					$_SESSION['id'] = $respuesta['id_user'];
					$_SESSION["password"] = $respuesta["user_password_hash"];
					$_SESSION['nombre'] = $respuesta['firstname'];
					$_SESSION['apellido'] = $respuesta['lastname'];

					echo"<script>
							window.location = 'index.php';
						</script>";

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

		public function checkPasswordController()
		{
			$respuesta = Datos::checkPasswordModel("user",$_SESSION['id']);

			$password = $respuesta['user_password_hash'];
			return $password;
		}

		


	}

	


?>
