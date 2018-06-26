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
			//Se obtiene la accion por medio de paso de variable y entonces se incluye la vista segun sea la accion
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
		//Funcion para registrar una alumna en la base de datos
		public function registrarAlumnaController()
		{
			$respuesta = "";
			if(isset($_POST['registrar']))
			{
				if(!empty($_POST['nombre']))
				{
					//Se obtienen las variables
					$oringialDate = $_POST['fecha'];
					$actualDate = date("Y-m-d",strtotime($oringialDate));
					$datosController = array('nombre'=>$_POST['nombre'],
											 'apellido'=>$_POST['apellido'],
											 'fecha'=>$actualDate,
											 'grupo'=>$_POST['grupo']);

					$respuesta = Datos::registrarAlumnaModel($datosController,'alumna');
				}
			}
			if($respuesta == "success")
			{
				echo"<script>
						window.location = 'index.php?action=alumnas';
					 </script>";
			}
		}

		//Funcion para registrar un pago hecho en la base de datos
		public function registrarPagoController()
		{
			if(isset($_POST["registrar"])) 
			{
				if(!empty($_POST['mama']))
				{
					//Funcion para cargar una imagen y ponerla en la carpeta uploads que se encuentra en la carpeta raiz
				    $target_dir = "models/uploads/";
				    //Se obtiene el nombre de la foto

				    $micro_date = microtime();
            		$date_array = explode(" ",$micro_date);
            		$date = date("Y-m-dH-i-s",$date_array[1]);

            		$oldName = basename($_FILES["fileToUpload"]["name"]);
            		$photoName = explode(".", $oldName);
            		$newName = $photoName[0] . "_" . $date . "." .$photoName[1];

          

            				$_FILES["fileToUpload"]["name"] = $newName;

				    $target_file = $target_dir . $newName;

				    //Se crea una bandera para saber si la foto se cargo correctamete
				    $uploadOk = 1;
				    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				      //Si se cargo la imagen podemos obtener el formato de la imagen
				      if($check !== false) 
				      {
				          echo "File is an image - " . $check["mime"] . ".";
				          $uploadOk = 1;
	      			  } 
	      			  //Tambien podemos saber si no es una imagen
	      			  else 
	      			  {
				          echo "File is not an image.";
				          $uploadOk = 0;
	      			  }

					   // Check if file already exists
					  if (file_exists($target_file)) 
					  {
					      echo "Sorry, file already exists.";
					      $uploadOk = 0;
	  				  }
					  // Check file size
					  if ($_FILES["fileToUpload"]["size"] > 500000) 
					  {
					      echo "Sorry, your file is too large.";
					      $uploadOk = 0;
	  				  }
					  // Allow certain file formats
					  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					  && $imageFileType != "gif" )
					  {
					      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					      $uploadOk = 0;
					  }
					  // Check if $uploadOk is set to 0 by an error
					  if ($uploadOk == 0)
					  {
					      echo "Sorry, your file was not uploaded.";
					  // if everything is ok, try to upload file
					  } 
					  else 
					  {
				  	
				  		//Si la imagen se cargo correctamente
				  		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
				  		{
						    
						    

            				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";


						    //Se crean las variables para el registro del pago en la base de datos
						     $fileName = basename( $_FILES["fileToUpload"]["name"]);
						     $oringialDate = $_POST['fecha_pago'];
							 $actualDate = date("Y-m-d",strtotime($oringialDate));
							 $fecha = date("Y-m-d H:i:s");
						     $datosController = array("id_alumna"=>$_POST['alumnas'],
						          					  "id_grupo"=>$_POST['grupo'],
						          					  "nombreMama"=>$_POST['mama'],
						          					  "fecha_pago"=>$actualDate,
						          					  "fecha_envio"=>$fecha,
						          					  "ruta"=> $fileName,
						          					  "folio"=>$_POST['folio']);

						     $respuesta = Datos::registrarPagoModel($datosController,'pagos');
						     if($respuesta == "success")
						  	 {
										
							 }
						}
					
  				  	 }
  				}

  			}
		}
		//Funcion para registrar un grupo nuevo en la base de datos
		public function registrarGrupoController()
		{
			$respuesta = "";
			if(isset($_POST['registrar']))
			{

				if(!empty($_POST['nombre']))
				{
					//Se registra en la base de datos desde el modelo
					$datosController = $_POST['nombre'];
					$respuesta = Datos::registrarGrupoModel($datosController,'grupo');
				}
			}
			if($respuesta == "success")
			{
				echo"<script>
						window.location = 'index.php?action=grupos';
					</script>";
			}
		}


		//Funcion para crear la vista de los pagos para los usuarios publicos donde se observara toda la vista excepto el folio y la imagen
		//con el folio
		public function vistaPagosPublicosController()
		{
			$respuesta=Datos::vistaPagosPublicosModel("pagos");

			$counter = 1;
			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$counter.'</td>
					<td>'.$item["nombre_alumna"].'</td>
					<td>'.$item["nombre_grupo"].'</td>
					<td>'.$item["nombre_mama"].'</td>
					<td>'.$item["fecha_pago"].'</td>
					<td>'.$item["fecha_envio"].'</td>
				</tr>';
			$counter++;
			}
		}

		//Funcion para crear la vista de los pagos para administrador donde se mostrara la tabla completa incluyendo el folio y la imagen
		//del folio
		public function vistaPagosAdminController()
		{
			$respuesta=Datos::vistaPagosPublicosModel("pagos");

			$counter = 1;
			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$counter.'</td>
					<td>'.$item["nombre_alumna"].'</td>
					<td>'.$item["nombre_grupo"].'</td>
					<td>'.$item["nombre_mama"].'</td>
					<td>'.$item["fecha_pago"].'</td>
					<td>'.$item["fecha_envio"].'</td>
					<td> <center><a href="uploads/'.$item["ruta"].'">Ver</a></center></td>
					<td>'.$item["folio"].'</td>
					<td><div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-cog"></span>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?action=editar_lugar&id='.$item["id_pago"].'">Actualizar</a>
                            <a class="dropdown-item" onclick="confirmarDelete('.$item["id_pago"].');" href="index.php?action=lugares_admin&idBorrar='.$item["id_pago"].'" id="btn'.$item["id_pago"].'">Eliminar</a>
                          </div></td>
					
				</tr>';
			$counter++;
			}
		}

		//Vista de los grupos para mostrarlos en una tabla, asi como crear los distintos botones para actualizar y borrar los grupos
		public function vistaGruposController()
		{
			$respuesta = Datos::vistaGruposModel("grupo");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id_grupo"].'</td>
					<td>'.$item["nombre_grupo"].'</td>
					<td><div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-cog"></span>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?action=editar_grupo&id='.$item["id_grupo"].'">Actualizar</a>
                            <a class="dropdown-item" onclick="confirmarDelete('.$item["id_grupo"].');" href="index.php?action=grupos&idBorrar='.$item["id_grupo"].'" id="btn'.$item["id_grupo"].'">Eliminar</a>
                          </div></td>
				</tr>';
			}

		}

		//Se obtienen los grupos  para ponerlos en un select2 a la hora de registrar una alumna nueva
		public function obtenerGruposController()
		{
			$respuesta = Datos::vistaGruposModel("grupo");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item)
			{
				echo'<option value='.$item["id_grupo"].'>'.$item["nombre_grupo"].'</option>';
			}

		}

		//Se obtienen las alumnas para ponerlos en un select2 a la hora de registrar un lugar nuevo
		public function obtenerAlumnasController()
		{
			$respuesta = Datos::vistaAlumnasModel("alumna");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item)
			{
				echo'<option value='.$item["id_alumna"].'>'.$item["nombre_alumna"].'</option>';
			}

		}

		//Funcion dle controlador para crear una vista de las alunas registradas hasta el momento y ponerlos en una tabla
		public function vistaAlumnasController()
		{

			$respuesta = Datos::vistaAlumnasModel("alumna");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id_alumna"].'</td>
					<td>'.$item["nombre_alumna"].'</td>
					<td>'.$item["apellido_alumna"].'</td>
					<td>'.$item["fecha_nacimiento"].'</td>
					<td>'.$item["nombre_grupo"].'</td>
					<td><div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-cog"></span>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="index.php?action=editar_alumna&id='.$item["id_alumna"].'">Actualizar</a>
                            <a class="dropdown-item" onclick="confirmarDelete('.$item["id_alumna"].');" href="index.php?action=alumnas&idBorrar='.$item["id_alumna"].'" id="btn'.$item["id_alumna"].'">Eliminar</a>
                          </div></td>
				</tr>';


			}

		}

		//Funcion para borrar algun pago en base a su id
		public function borrarPagoController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				$respuesta = Datos::borrarPagoModel($datosController,'pagos');
				if($respuesta == "success")
				{
					echo"<script>
							window.location = 'index.php?action=lugares_admin';
						</script>";
				}
			}
		}

		//Funcion para borrar un grupo en base a su id
		public function borrarGrupoController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				//Primero se borran las alumnas de ese grupo
				//$respuesta2 = Datos::borrarProductoPorCategoriaModel($datosController,'producto');
				//Se borra el grupo de la base de datos
				$respuesta = Datos::borrarGrupoModel($datosController,'grupo');

				if($respuesta == "success")
				{
					echo"<script>
							window.location = 'index.php?action=grupos';
						</script>";
				}
			}
		}



		//Funcion para crear un formulario y poner los datos del pago respecto a su id en caso de que se quiera actualizae
		public function editarPagoController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarPagoModel($datosController, "pagos");
				$actualDate = $respuesta['fecha_envio'];
				$newDate = date('Y-m-d\TH:i:s', strtotime($actualDate));

				//Se crea el formulario donde iran los respectivos datos del pago que se pretende modificar
				echo'<div class="card card-success">
              			<div class="card-header">
                			<h3 class="card-title">Editar Producto</h3>
              			</div>
              			<div class="card-body">
              				<input name="idEditar" class="form-control form-control-lg" type="hidden" placeholder=".input-lg" value = "'.$respuesta["id_pago"].'">
              				<br>

                			<input name="mamaEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["nombre_mama"].'">
                			<br>
                			<input name="fecha_pago" class="form-control form-control-lg" type="date" placeholder=".input-lg" value = "'.$respuesta['fecha_pago'].'">
                			<br>

                			<input name="fecha_envio" class="form-control form-control-lg" type="datetime-local" placeholder=".input-lg" value = "'.$newDate.'">
                			<br>
                			<input name="folioEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["folio"].'">
                			<br>
                        	<br>
                			<button type="submit" name="btn_actualizar" id="btn"  class="btn btn-block btn-outline-primary" onclick="confirmarUpdate();" style="float:right;">Guardar cambios</button>
              			</div>
            		</div>';
			}

		}

		//Funcion para traer el formulario de para tener lo sdatos del grupo en el y poder hacer actualizaciones
		public function editarGrupoController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarGrupoModel($datosController, "grupo");
				//Se crea un formulario que contendra los datos de los grupos en base a su id
				echo'<div class="card card-success">
              			<div class="card-header">
                			<h3 class="card-title">Editar Producto</h3>
              			</div>
              			<div class="card-body">
              				<input name="idEditar" class="form-control form-control-lg" type="hidden" placeholder=".input-lg" value = "'.$respuesta["id_grupo"].'">
              				<br>
                			<input name="nombreEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["nombre_grupo"].'">
                			<br>
                			 <button type="submit" name="btn_actualizar" id="btn"  class="btn btn-block btn-outline-primary" onclick="confirmarUpdate();" style="float:right;">Guardar cambios</button>
              			</div>
            		</div>';
			}

		}

		//Funcion para crear el formulario y traer los datos para poder editar dichos datos de la alumna
		public function editarAlumnaController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarAlumnaModel($datosController, "alumna");

				//Formulario que contiene los datos que se pretende editar de alguna alumna
				echo'<div class="card card-success">
              			<div class="card-header">
                			<h3 class="card-title">Editar Usuario</h3>
              			</div>
              			<div class="card-body">
              				<input name="idEditar" class="form-control form-control-lg" type="hidden" placeholder=".input-lg" value = "'.$respuesta["id_alumna"].'">
              				<br>
                			<input name="nombreEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["nombre_alumna"].'">
                			<br>
                			<input name="apellidoEditar" class="form-control form-control-lg" type="text" placeholder=".input-lg" value = "'.$respuesta["apellido_alumna"].'">
                			<br>
                			<input name="fechaEditar" class="form-control form-control-lg" type="date" placeholder=".input-lg" value = "'.$respuesta["fecha_nacimiento"].'">
                			<br>
                			<label>Grupo</label>
                        	<select class="form-control select2" style="width: 100%;" name="grupo">';

                        	//Se hace una consulta a los grupos para traerlas en un select a la hora de editar una alumna
         					$respuesta2 = Datos::vistaGruposModel("grupo",$datosController2);
							#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

         					//Se hacen las opciones del select 
							foreach($respuesta2 as $row => $item)
							{
								//Si alguno de los distintos id del grupo es igual al id del grupo de la alumna entonces sera la opcion
								//seleccionada
								if($item['id_grupo'] == $respuesta['id_grupo'])
								{
									echo'<option selected value='.$item["id_grupo"].'>'.$item["nombre_grupo"].'</option>';
								}
								else
								{
									echo'<option value='.$item["id_grupo"].'>'.$item["nombre_grupo"].'</option>';
								}
							}
                        	echo '</select>
                        	<br>
                        	<br>
                			<button type="submit" name="btn_actualizar" id="btn"  class="btn btn-block btn-outline-primary" onclick="confirmarUpdate();" style="float:right;">Guardar cambios</button>
              			</div>
            		</div>';
			}

		}

		//Funcion para hacer el update en la base de datos en base al formulario al editar alguna alumna
		public function actualizarAlumnaController()
		{
			if(isset($_POST['nombreEditar']))
			{
				$fecha =  date("Y-m-d",strtotime($_POST['fechaEditar']));
				$datosController = array( "id"=>$_POST["idEditar"],
										  "nombre"=>$_POST["nombreEditar"],
										  "apellido"=>$_POST["apellidoEditar"],
										  "fecha"=>$_POST["fechaEditar"],
										  "grupo"=>$_POST['grupo']);

				$respuesta = Datos::actualizarAlumnaModel($datosController,"alumna");

				if($respuesta == "success")
				{
					echo"<script>
							window.location = 'index.php?action=alumnas';
						</script>";

				}

				else
				{

					echo "error";

				}

			}
		}


		//Funcion para borrar la alumna en base a su id
		public function borrarAlumnaController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				$respuesta = Datos::borrarAlumnaModel($datosController,'alumna');

				if($respuesta == "success")
				{
					echo"<script>
							window.location = 'index.php?action=alumnas';
						</script>";
				}
			}
		}

		//Funcion para actualizar la BD con el nuevo pago en base a su ID
		public function actualizarPagoController()
		{
			if(isset($_POST['mamaEditar']))
			{
				$fecha_envio = date ("Y-m-d H:i:s",strtotime($_POST['fecha_envio']));
				$fecha_pago = date("Y-m-d",strtotime($_POST['fecha_pago']));

				$datosController = array( "id"=>$_POST["idEditar"],
										  "mama"=>$_POST["mamaEditar"],
										  "fecha_pago"=>$fecha_pago,
										  "fecha_envio"=>$fecha_envio,
										  "folio"=>$_POST['folioEditar']);

				$respuesta = Datos::actualizarPagoModel($datosController,"pagos");

				if($respuesta == "success")
				{

					echo"<script>
							window.location = 'index.php?action=lugares_admin';
						</script>";

				}

				else
				{

					echo "error";

				}

			}
		}

		//Funcion para actualizar la BD con el nuevo grupo en base a su id
		public function actualizarGrupoController()
		{
			if(isset($_POST['nombreEditar']))
			{
				$datosController = array( "id"=>$_POST["idEditar"],
										  "nombre"=>$_POST["nombreEditar"]);

				$respuesta = Datos::actualizarGrupoModel($datosController,"grupo");

				if($respuesta == "success")
				{

					echo"<script>
							window.location = 'index.php?action=grupos';
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

				$respuesta = Datos::ingresoUsuarioModel($datosController, "usuario");
				//Valiación de la respuesta del modelo para ver si es un usuario correcto.

				//Si los datos traidos de la base de datos son iguales a los que el usuario ingreso en las cajas de texto
				if($respuesta)
				{

					//Entonces la variables de sesion se encienden
					$_SESSION["validar"] = true;
					$_SESSION['correo'] = $respuesta['email'];
					$_SESSION['password']=$respuesta['password'];
					echo"<script>
								window.location = 'index.php?action=dashboard';
							</script>";  
					
				}
				else
				{
					echo '<script>
							swal({title: "Error", 
								  text: "Usuario o contraseña erróneos!", 
								   type: "error"});
							</script>';
				}
			}
		}


		//Funcion que sirve para controlar la barra izquierda que es la navegacion, esta se muestra siempre y cuadno se inicio sesion
		//siendo u nadministrador del sistema
		public function controlNav()
		{
			if(isset($_SESSION['validar']))
			{
				

				echo '<li class="nav-item">
	            		<a href="index.php?action=dashboard" class="nav-link">
	              			<i class="nav-icon fa fa-dashboard"></i>
	              			<p>Dashboard</p>
	            		</a>
	          		 </li>
	          		 <li class="nav-item">
	            		<a href="index.php?action=alumnas" class="nav-link">
	              			<i class="nav-icon fa fa-user-plus"></i>
	              			<p>Alumnas</p>
	            		</a>
	          		 </li>
	          		 <li class="nav-item">
	            		<a href="index.php?action=grupos" class="nav-link">
	              			<i class="nav-icon fa fa-users"></i>
	              			<p>Grupos</p>
	            		</a>
	          		 </li>
	          		 <li class="nav-item">
	            		<a href="index.php?action=lugares_admin" class="nav-link">
	              			<i class="nav-icon fa fa-ticket"></i>
	              			<p>Lugares</p>
	            		</a>
	          		 </li>

	          		 <li class="nav-item">
				        <a onclick="confirmarSesion();" href="index.php" class="nav-link">
				            <i class="nav-icon fa fa-sign-out"></i>
				        	<p>Logout</p>
				        </a>
				     </li>';
			  
			}
			
		}

		//Funcion que permite saber cuando colocar la barra de administrador o no, ya que cuando se entra al inicio de la pagina
		//esta seccion es publica y por lo que es posible ver la barra de administrador, estas variables permite saber
		//cuando alguien publico entra a la pagina, o cuando entra algun adiministrador
		public function checkGuess()
		{
			if(isset($_GET['action']))
			{
				if($_GET['action']=='login' || $_GET['action']=='lugares')
				{
					$_SESSION['control']=0;
				}
			}
			else
			{
				$_SESSION['control']=0;
			}
		}	


	}



?>
