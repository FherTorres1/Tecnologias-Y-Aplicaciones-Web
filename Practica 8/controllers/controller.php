<?php

	class MvcController
	{
		public function plantilla()
		{
			require("views/template.php");
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

			$respuesta = Informacion::enlazador($enlace);
			include($respuesta);
		}

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


		public function vistaCarrerasController()
		{

			$respuesta = Datos::vistaCarrerasModel("carrera");

			#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

			foreach($respuesta as $row => $item){
			echo'<tr>
					<td>'.$item["id"].'</td>
					<td>'.$item["nombre"].'</td>
					<td><a href="index.php?action=editar_carrera&id='.$item["id"].'"><button>Editar</button></a></td>
					<td><a href="index.php?action=carreras&idBorrar='.$item["id"].'" onclick=confirmar();><button>Borrar</button></a></td>
				</tr>';
			}

		}

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

		public function editarCarreraController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarCarreraModel($datosController, "carrera");

				echo'<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

				 	<input type="text" value="'.$respuesta["nombre"].'" name="carreraEditar" required style="width:200px;">
				 	<br><br>


				 	<input type="submit" value="Actualizar" onclick="confirmar();">';
			}

		}

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

		public function vistaAlumnosController()
		{
			$respuesta = Datos::vistaAlumnosModel("alumno");

			foreach($respuesta as $row => $item){
			echo'<tr>
				<td>'.$item["matricula"].'</td>
				<td>'.$item["aluNom"].'</td>
				<td>'.$item["carNom"].'</td>
				<td>'.$item["masNom"].'</td>
				<td><a href="index.php?action=editar_alumno&id='.$item["matricula"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=alumnos&idBorrar='.$item["matricula"].'" onclick=confirmar();><button>Borrar</button></a></td>
			</tr>';
			}
		}

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
				<td><a href="index.php?action=editar_maestro&id='.$item["numero"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=maestros&idBorrar='.$item["numero"].'" onclick=confirmar();><button>Borrar</button></a></td>
				</tr>';
			}
		}

		public function obtenerCarrerasController()
		{
			$respuesta = Datos::obtenerCarrerasModel("carrera");

			echo "<select name='carrera' size='1'>";
			foreach($respuesta as $row => $item)
			{
				echo "<option value =".$item['id'].">" . $item['nombre'] . "</option>";
			}
			echo "</select>";
		}

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

		public function editarMaestroController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarMaestroModel($datosController, "maestro");

				echo'<input type="hidden" value="'.$respuesta["numero"].'" name="numeroEditar">';

				$respuesta2 = Datos::obtenerCarrerasModel("carrera");
				echo "<select name='carreraEditar' size='1'>";
				foreach($respuesta2 as $row => $item)
				{
					
					if($respuesta['carrera'] == $item['id'])
					{
						echo "<option selected value =".$item['id'].">" . $item['nombre'] . "</option>"; 
					}
					else
					{
						echo "<option value =".$item['id'].">" . $item['nombre'] . "</option>"; 
					}
					
				}

				echo "</select><br>";


				echo '<input type="text" value="'.$respuesta["nombre"].'" name="nombreEditar" required style="width:200px;">
					  <input type="text" value="'.$respuesta["email"].'" name="emailEditar" required style="width:200px;">
					  <input type="text" value="'.$respuesta["password"].'" name="passwordEditar" required style="width:200px;">
				 	<br><br>
				<input type="submit" value="Actualizar" onclick="confirmar();">';
			}

		}
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

		public function obtenerMaestrosController()
		{
			$respuesta = Datos::obtenerMaestrosModel("maestro");

			echo "<select name='tutor' size='1'>";
			foreach($respuesta as $row => $item)
			{
				echo "<option value =".$item['numero'].">" . $item['nombre'] . "</option>";
			}
			echo "</select>";
		}
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

		public function ingresoUsuarioController(){

			if(isset($_POST["usuarioIngreso"])){

				$datosController = array( "usuario"=>$_POST["usuarioIngreso"], 
									      "password"=>$_POST["passwordIngreso"]);

				$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
				//Valiación de la respuesta del modelo para ver si es un usuario correcto.
				if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){

					session_start();

					$_SESSION["validar"] = true;

					header("location:index.php?action=maestros");

				}

				else{

					header("location:index.php?action=fallo");

				}

			}
		}

		public function editarAlumnoController()
		{
			if(isset($_GET['id']))
			{
				$datosController = $_GET["id"];
				$respuesta = Datos::editarAlumnoModel($datosController, "alumno");
				echo'<input type="hidden" value="'.$respuesta["matricula"].'" name="numeroEditar"><br><br>
					 <input type="text" value="'.$respuesta["nombre"].'" name="nombreEditar" required style="width:200px;">';

				$respuesta2 = Datos::obtenerCarrerasModel("carrera");
				echo "<select name='carreraEditar' size='1'>";
				foreach($respuesta2 as $row => $item)
				{
					
					if($respuesta['carrera'] == $item['id'])
					{
						echo "<option selected value =".$item['id'].">" . $item['nombre'] . "</option>"; 
					}
					else
					{
						echo "<option value =".$item['id'].">" . $item['nombre'] . "</option>"; 
					}
					
				}

				echo "</select><br>";


				$respuesta2 = Datos::obtenerMaestrosModel("maestro");
				echo "<select name='carreraEditar' size='1'>";
				foreach($respuesta2 as $row => $item)
				{
					
					if($respuesta['tutor'] == $item['numero'])
					{
						echo "<option selected value =".$item['numero'].">" . $item['nombre'] . "</option>"; 
					}
					else
					{
						echo "<option value =".$item['numero'].">" . $item['nombre'] . "</option>"; 
					}
					
				}

				echo "</select><br>";


				echo '<input type="submit" value="Actualizar" onclick="confirmar();">';

			}

		}

	}

	


?>
