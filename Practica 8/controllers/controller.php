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
		//Funcion para registrar una carrera
		public function registrarCarreraController()
		{
			$respuesta = "";
			if(isset($_POST['registrar']))
			{
				if(isset($_POST['nombre']))
				{
					$datosController = $_POST['nombre'];
					$respuesta = Datos::registrarCarreraModel($datosController,'carrera');
				}
			}
			if($respuesta == "success")
			{
				header("Location:index.php?action=carreras");
			}
		}

		//Funcion para obtener la vista de las carreras
		public function vistaCarrerasController()
		{

			$respuesta = Datos::vistaCarrerasModel("carrera");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id"].'</td>
					<td>'.$item["nombre"].'</td>
					<td><a href="index.php?action=editar_carrera&id='.$item["id"].'"><button class="tiny button" style="font-size:20px;">Editar</button></a></td>
					<td><a href="index.php?action=carreras&idBorrar='.$item["id"].'" onclick=confirmar();><button class="tiny button alert" style="font-size:20px;">Borrar</button></a></td>
				</tr>';
			}

		}

		//Funcion para borrar alguna carrera
		public function borrarCarreraController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				$respuesta = Datos::borrarCarreraModel($datosController,'carrera');

				if($respuesta == "success")
				{
					header("Loaction: index.php?action=carreras");
				}
			}
		}
		//Funcion para crear un formulario y poner los datos de la carrera respecto a su id en caso de que se quiera actualizae
		public function editarCarreraController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarCarreraModel($datosController, "carrera");

				echo'<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

				 	<input type="text" value="'.$respuesta["nombre"].'" name="carreraEditar" required>

				 	<input type="submit" value="Actualizar" onclick="confirmar();" class="tiny button">';
			}

		}

		//Funcion para actualizar la BD con la nueva carrera en base a su ID
		public function actualizarCarreraController()
		{
			if(isset($_POST['carreraEditar']))
			{
				$datosController = array( "id"=>$_POST["idEditar"],
										  "nombre"=>$_POST["carreraEditar"]);

				$respuesta = Datos::actualizarCarreraModel($datosController,"carrera");

				if($respuesta == "success")
				{

					header("location:index.php?action=carreras");

				}

				else
				{

					echo "error";

				}

			}
		}

		//Funcion para obtener la vista de alumnos
		public function vistaAlumnosController()
		{
			$respuesta = Datos::vistaAlumnosModel("alumno");

			foreach($respuesta as $row => $item){
			echo'<tr>
				<td>'.$item["matricula"].'</td>
				<td>'.$item["aluNom"].'</td>
				<td>'.$item["carNom"].'</td>
				<td>'.$item["masNom"].'</td>
				<td><a href="index.php?action=editar_alumno&id='.$item["matricula"].'"><button class="tiny button" style="font-size:20px;">Editar</button></a></td>
				<td><a href="index.php?action=alumnos&idBorrar='.$item["matricula"].'" onclick=confirmar();><button class="tiny button alert" style="font-size:20px;">Borrar</button></a></td>
			</tr>';
			}
		}

		//Funcion para obtener la vista de maestros
		public function vistaMaestrosController()
		{
			$respuesta = Datos::vistaMaestrosModel("maestro");

			foreach($respuesta as $row => $item)
			{
				echo'<tr>
				<td>'.$item["numero"].'</td>
				<td>'.$item["car"].'</td>
				<td>'.$item["nom"].'</td>
				<td>'.$item["email"].'</td>
				<td>'.$item["password"].'</td>
				<td><a href="index.php?action=editar_maestro&id='.$item["numero"].'"><button class="tiny button" style="font-size:20px;">Editar</button></a></td>
				<td><a href="index.php?action=maestros&idBorrar='.$item["numero"].'" onclick=confirmar();><button class="tiny button alert" style="font-size:20px;">Borrar</button></a></td>
				</tr>';
			}
		}

		//Funcion para obtener las carreras, esto nos sirve para a la hora de registrar algun alumno o maestro, se nos despliegue en un select
		//las carreras registradas en la base de datos
		public function obtenerCarrerasController()
		{
			$respuesta = Datos::obtenerCarrerasModel("carrera");

			echo "<select name='carrera' size='1' class='js-example-basic-single'>";
			foreach($respuesta as $row => $item)
			{
				echo "<option value =".$item['id'].">" . $item['nombre'] . "</option>";
			}
			echo "</select>";
		}

		//Funcion para registrar un maestro
		public function registrarMaestroController()
		{
			if(isset($_POST['registrar']))
			{
				if(isset($_POST['carrera']) && isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['password']))
				{
					$datosController = array( "carrera"=>$_POST["carrera"], 
								      		  "nombre"=>$_POST["nombre"],
								      		  "email"=>$_POST["email"],
								      		  "password"=>$_POST["password"]);

					$respuesta = Datos::registrarMaestroModel($datosController,'maestro');

					if($respuesta == "success")
					{
						header("Location: index.php?action=maestros");
					}

				}
			}
		}
		
		//Funcion para borrar un maestro
		public function borrarMaestroController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				$respuesta = Datos::borrarMaestroModel($datosController,'maestro');

				if($respuesta == "success")
				{
					header("Loaction: index.php?action=maestros");
				}
			}
		}

		//Funcion para borrar alguna tutoria
		public function borrarTutoriaController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				$respuesta = Datos::borrarTutoriaModel($datosController,'tutoria');

				if($respuesta == "success")
				{
					header("Location: index.php?action=tutorias");
				}
			}
		}

		//Funcion para hacer el formulario y traer los datos del maestro elegido por medio de su id
		public function editarMaestroController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarMaestroModel($datosController, "maestro");

				echo'<input type="hidden" value="'.$respuesta["numero"].'" name="numeroEditar">';

				//Se hace otro metodo para obtener las carreras
				$respuesta2 = Datos::obtenerCarrerasModel("carrera");
				//Se hace el select que contendra todas las carreras
				echo "<select name='carreraEditar' size='1' class='js-example-basic-single'>";
				foreach($respuesta2 as $row => $item)
				{
					
					if($respuesta['carrera'] == $item['id'])
					{
						//Si el id de la carrera en el option del select es el mismo al que el maestro esta registrado
						//entonces se pone selected para que se selecicone en esa carrera
						echo "<option selected value =".$item['id'].">" . $item['nombre'] . "</option>"; 
					}
					else
					{
						//Sino se hace un option comun y corriente con sus respectivos datos
						echo "<option value =".$item['id'].">" . $item['nombre'] . "</option>"; 
					}
					
				}

				echo "</select><br>";


				echo '<input type="text" value="'.$respuesta["nombre"].'" name="nombreEditar" required style="width:200px;">
					  <input type="text" value="'.$respuesta["email"].'" name="emailEditar" required style="width:200px;">
					  <input type="text" value="'.$respuesta["password"].'" name="passwordEditar" required style="width:200px;">
				 	<br>
				<input type="submit" value="Actualizar" onclick="confirmar();" class="tiny button">';
			}

		}
		//Funcion para actualizar el maestro en la base de datos
		public function actualizarMaestroController()
		{
			if(isset($_POST['nombreEditar']))
			{
				$datosController = array( "numero"=>$_POST["numeroEditar"],
										  "carrera"=>$_POST["carreraEditar"],
										  "nombre"=>$_POST["nombreEditar"],
										  "email"=>$_POST["emailEditar"],
										  "password"=>$_POST["passwordEditar"]);

				$respuesta = Datos::actualizarMaestroModel($datosController,"maestro");

				if($respuesta == "success")
				{

					header("location:index.php?action=maestros");

				}

				else
				{

					echo "error";

				}

			}
		}

		//Funcion para obtener maestros, esto nos sirve para cuando se vaya a registrar a algun alumno, en un select se desplieguen todos los maestros
		//que hay en la base de datos
		public function obtenerMaestrosController()
		{
			$respuesta = Datos::obtenerMaestrosModel("maestro");

			echo "<select name='tutor' size='1'> class='js-example-basic-single'";
			foreach($respuesta as $row => $item)
			{
				echo "<option value =".$item['numero'].">" . $item['nombre'] . "</option>";
			}
			echo "</select>";
		}
		//Funcion para registrar un alumno
		public function registrarAlumnoController()
		{
			if(isset($_POST['registrar']))
			{
				if(isset($_POST['carrera']) && isset($_POST['nombre']) && isset($_POST['tutor']))
				{
					$datosController = array( "carrera"=>$_POST["carrera"], 
								      		  "nombre"=>$_POST["nombre"],
								      		  "tutor"=>$_POST["tutor"]);


					$respuesta = Datos::registrarAlumnoModel($datosController,'alumno');

					if($respuesta == "success")
					{
						header("Location: index.php?action=alumnos");
					}

				}
			}
		}
		//Funcion para borrar a un alumno
		public function borrarAlumnoController()
		{
			if(isset($_GET['idBorrar']))
			{
				$datosController = $_GET['idBorrar'];
				$respuesta = Datos::borrarAlumnoModel($datosController,'alumno');

				if($respuesta == "success")
				{
					header("Loaction: index.php?action=maestros");
				}
			}
		}

		//Funcion de login
		public function ingresoUsuarioController(){

			if(isset($_POST["usuarioIngreso"]) && !empty($_POST['usuarioIngreso'])){

				$datosController = array( "usuario"=>$_POST["usuarioIngreso"], 
									      "password"=>$_POST["passwordIngreso"]);

				$respuesta = Datos::ingresoUsuarioModel($datosController, "maestro");
				//Valiación de la respuesta del modelo para ver si es un usuario correcto.

				//Si los datos traidos de la base de datos son iguales a los que el usuario ingreso en las cajas de texto
				if($respuesta["email"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){

					//Entonces la variables de sesion se encienden
					$_SESSION["validar"] = true;
					//Se obtiene el numero de maestro para traer sus alumnos en el caso de las tutorias
					$_SESSION['numero'] = $respuesta['numero'];
					//El tipo sera 2 para que no ingrese a los CRUD de superadmin
					$_SESSION['tipo'] = 2;

					header("location:index.php?action=inicio");

				}

				//Y si lo que ingreso el usuario es superadmin
				else if("superadmin" == $_POST["usuarioIngreso"] && "superadmin" == $_POST["passwordIngreso"])
				{
						$_SESSION["validar"] = true;
						//Entonces su tipo es 1 para que pueda acceder a los CRUD de superadmin
						$_SESSION['tipo'] = 1;
						header("location:index.php?action=inicio");

				}
				else
				{
					header("location:index.php?action=fallo");
				}

				

			}

		}

		//Funcion para controlar la NAVEGACION
		public function controlNav()
		{
			session_start();

				//Si ya iniicion sesion
				if(isset($_SESSION['tipo']))
				{
					//Si el tipo es 1 entonces se muestra la navegacion de superadmin
					if($_SESSION['tipo'] == 1){
							echo "
						  <li><a href='index.php?action=alumnos'>Alumnos</a></li>
						  <li><a href='index.php?action=maestros'>Maestros</a></li>
						  <li><a href='index.php?action=carreras'>Carreras</a></li>
						  <li><a href='index.php?action=reportes'>Reportes</a></li>
						  <li><a href='index.php?action=salir'>Salir</a></li>";
					//Sino se muestra la navegacion de maestro
					}else if($_SESSION['tipo'] == 2){
						echo "
						  <li><a href='index.php?action=tutorias'>Tutorias</a></li>
						  <li><a href='index.php?action=salir'>Salir</a></li>";
					}
					

				}
			else
			{
				//Y por utlimo si no ha iniciado sesion solo muestra la opcion de iniciar sesion
				echo "<li><a href='index.php?action=ingresar'>Iniciar Sesion</a></li>";
			}

		}

		//Funcion para hacer un formulario y traer los datos de alumno en base a suID
		public function editarAlumnoController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarAlumnoModel($datosController, "alumno");
				echo'<input type="hidden" value="'.$respuesta["matricula"].'" name="numeroEditar"><br><br>
					 <input type="text" value="'.$respuesta["nombre"].'" name="nombreEditar" required style="width:200px;">';

				//Se obtienen las carreras que estan registradas en la base de datos
				$respuesta2 = Datos::obtenerCarrerasModel("carrera");
				echo "<select class='js-example-basic-single' name='carreraEditar' size='1'>";
				foreach($respuesta2 as $row => $item)
				{
					
					if($respuesta['carrera'] == $item['id'])
					{
						//Si el valor de la cerrera es la misma que tiene el alumno entonces se selecciona
						echo "<option selected value =".$item['id'].">" . $item['nombre'] . "</option>"; 
					}
					else
					{
						//Sino se hace un opcion normal
						echo "<option value =".$item['id'].">" . $item['nombre'] . "</option>"; 
					}
					
				}

				echo "</select><br>";

				//Se obtienen los maestros que hay en la base de datos
				$respuesta2 = Datos::obtenerMaestrosModel("maestro");
				echo "<select name='tutorEditar' size='1' class='js-example-basic-single'>";
				foreach($respuesta2 as $row => $item)
				{
					
					if($respuesta['tutor'] == $item['numero'])
					{
						//Si el numero del maestro es el mismo que tiene el alumno registrado entonces se selecciona
						echo "<option selected value =".$item['numero'].">" . $item['nombre'] . "</option>"; 
					}
					else
					{
						//Sino se hace un option normal
						echo "<option value =".$item['numero'].">" . $item['nombre'] . "</option>"; 
					}
					
				}

				echo "</select><br>";


				echo '<input type="submit" value="Actualizar" onclick="confirmar();" class="tiny button" style="font-size:20px;">';

			}

		}
		//Funcion para actualizar el alumno en la base de datos
		public function actualizarAlumnoController()
		{
			if(isset($_POST['nombreEditar']))
			{
				$datosController = array( "matricula"=>$_POST["numeroEditar"],
										  "carrera"=>$_POST["carreraEditar"],
										  "nombre"=>$_POST["nombreEditar"],
										  "tutor"=>$_POST["tutorEditar"]);

				$respuesta = Datos::actualizarAlumnoModel($datosController,"alumno");

				if($respuesta == "success")
				{

					header("location:index.php?action=alumnos");

				}

				else
				{

					echo "error";

				}

			}
		}
		//Funcion para la vista de tutorias (DEPENDIENDO DEL NUMERO DEL MAESTRO)
		public function vistaTutoriasController()
		{
			$datosController = $_SESSION['numero'];
			$respuesta = Datos::vistaTutoriasModel($datosController,"tutoria");

			foreach($respuesta as $row => $item)
			{
				echo'<tr>
				<td>'.$item["id"].'</td>
				<td>'.$item["alumNom"].'</td>
				<td>'.$item["fecha"].'</td>
				<td>'.$item["hora"].'</td>
				<td>'.$item["tipo"].'</td>
				<td>'.$item["descripcion"].'</td>
				<td><a href="index.php?action=tutorias&idBorrar='.$item["id"].'" onclick=confirmar();><button class="tiny button alert" style="font-size:20px;">Borrar</button></a></td>
				</tr>';
			}
		}
		//Funcion para la vista de tutoorias en reporte (SIN IMPORTAR EL NUMERO DEL MAESTRO)
		public function vistaReporteTutoriasController()
		{
			$respuesta = Datos::vistaReportesTutoriasModel("tutoria");

			foreach($respuesta as $row => $item)
			{
				echo'<tr>
				<td>'.$item["id"].'</td>
				<td>'.$item["alumNom"].'</td>
				<td>'.$item["maeNom"].'</td>
				<td>'.$item["fecha"].'</td>
				<td>'.$item["hora"].'</td>
				<td>'.$item["tipo"].'</td>
				<td>'.$item["descripcion"].'</td>
				</tr>';
			}
		}


		//Funcion para traer los alumnos de cada tutor, esto con el fin de registrar tutorias con los alumnos que estan registrado con ese maestro enespecifico
		public function obtenerAlumnosDeTutorController()
		{
			$datosController = $_SESSION['numero'];
			$respuesta = Datos::obtenerAlumnosDeTutorModel($datosController,"alumno");

			echo "<select name='alumno' size='1' class='js-example-basic-single'>";
			foreach($respuesta as $row => $item)
			{
				echo "<option value =".$item['matricula'].">" . $item['nombre'] . "</option>";
			}
			echo "</select>";
		}

		public function registrarTutoriaController()
		{
			if(isset($_POST['registrar']))
			{
				if(!empty($_POST['fecha']) && !empty($_POST['descripcion']))
				{
					$dateParts = explode("T",$_POST['fecha']);
					$datosController = array('alumno'=>$_POST['alumno'],
											 'tutor'=>$_SESSION['numero'],
											 'fecha'=>$dateParts[0],
											 'hora'=>$dateParts[1],
											 'tipo'=>$_POST['tipo'],
											 'descripcion'=>$_POST['descripcion']);

					$respuesta = Datos::registrarTutoriaModel($datosController,'tutoria');

					if($respuesta == "success")
					{
						header("Location:index.php?action=tutorias");
					}
				}
			}
		}


	}

	


?>
