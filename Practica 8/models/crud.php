<?php
	//Se requiere la conexion a la base de datos
	require_once("conexion.php");
	//Clase datos que extiende a la conexion
	class Datos extends Conexion
	{
	
		//Funcion del modelo para registrar una carrera
		public function registrarCarreraModel($nombre,$tabla)
		{
			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre) VALUES(:nombre)");
			$stm->bindParam("nombre",$nombre,PDO::PARAM_STR);
			if($stm->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}

			$stm->close();
		}

		//Funcion del modelo para traer la vista de las carreras
		public function vistaCarrerasModel($tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT id, nombre FROM $tabla");	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		//Funcion del modelo para borrar una carrera
		public function borrarCarreraModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where id = :id");
			$stmt->bindParam("id",$datosModel,PDO::PARAM_STR);
			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}

			$stmt->close();
		}
		//Funcion del modelo para hacer el formulario y traer los valores de la carrera dado su ID
		public function editarCarreraModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}
		//Funcion del modelo para hacer UPDATE a la BD en la tabla carrera
		public function actualizarCarreraModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre where id = :id");
			$stmt->bindParam(":nombre",$datosModel["nombre"],PDO::PARAM_STR);
			$stmt->bindParam(":id",$datosModel["id"],PDO::PARAM_STR);
			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}
		}
		//Funcion para traer la vista de alumnos
		public function vistaAlumnosModel($tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT *,$tabla.nombre as aluNom,carrera.nombre as carNom, maestro.nombre as masNom FROM $tabla inner join maestro on $tabla.tutor = maestro.numero inner join carrera on $tabla.carrera = carrera.id");	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}
		//Funcion del modelo para obtener la vista de Maestros
		public function vistaMaestrosModel($tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT *,carrera.nombre as car,$tabla.nombre as nom from $tabla inner join carrera on $tabla.carrera = carrera.id");
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}
		//Funcion del modelo para obtener las carreras, esto nos funciona a la hora de registrar alumnos y maestros, las carreras que se nos despliegan
		//en el select son las que estan registradas en la BD y se obtienen por medio de esta funcion
		public function obtenerCarrerasModel($tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}
		//Funcion para registrar un maestro
		public function registrarMaestroModel($datosModel,$tabla)
		{
			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (carrera,nombre,email,password)
												 VALUES(:carrera,:nombre,:email,:password)");
			$stm->bindParam(":carrera",$datosModel["carrera"],PDO::PARAM_INT);
			$stm->bindParam(":nombre",$datosModel["nombre"],PDO::PARAM_STR);
			$stm->bindParam(":email",$datosModel["email"],PDO::PARAM_STR);
			$stm->bindParam(":password",$datosModel["password"],PDO::PARAM_STR);
			if($stm->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}

			$stm->close();
		}
		//Funcion del modelo para reigstrar un maestro
		public function borrarMaestroModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where numero = :id");
			$stmt->bindParam("id",$datosModel,PDO::PARAM_STR);
			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}

			$stmt->close();
		}
		//Funcion del modelo para borrar una tutoria
		public function borrarTutoriaModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where id = :id");
			$stmt->bindParam("id",$datosModel,PDO::PARAM_STR);
			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}

			$stmt->close();
		}
		//Funcion del modelo para traer los datos de un maestro por medio de su ID
		public function editarMaestroModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where numero = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}
		//Funcion del modelo para actualizar los datos de algun maestro por medio de su ID
		public function actualizarMaestroModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET carrera = :carrera, nombre = :nombre, email = :email, password = :password where numero = :id");
			$stmt->bindParam(":id",$datosModel["numero"],PDO::PARAM_INT);
			$stmt->bindParam(":carrera",$datosModel["carrera"],PDO::PARAM_INT);
			$stmt->bindParam(":nombre",$datosModel["nombre"],PDO::PARAM_STR);
			$stmt->bindParam(":email",$datosModel["email"],PDO::PARAM_STR);
			$stmt->bindParam(":password",$datosModel["password"],PDO::PARAM_STR);
			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}
		}
		//Funcion del modelo para actualizar los datos de algun alumno por medio de su ID
		public function actualizarAlumnoModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, carrera = :carrera, tutor = :tutor where matricula = :id");
			$stmt->bindParam(":id",$datosModel["matricula"],PDO::PARAM_INT);
			$stmt->bindParam(":carrera",$datosModel["carrera"],PDO::PARAM_INT);
			$stmt->bindParam(":nombre",$datosModel["nombre"],PDO::PARAM_STR);
			$stmt->bindParam(":tutor",$datosModel["tutor"],PDO::PARAM_INT);
			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}
		}
		//Funcion que nos permite obtener los maestros que estan registrados, esto nos srive a la hora de registrar a un alumno y que se 
		//nos desplieguen en un select todos los maestros que tenemos registrados en nuestra base de datos
		public function obtenerMaestrosModel($tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		//Funcion del modelo para reigstrar un alumno
		public function registrarAlumnoModel($datosModel,$tabla)
		{
			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre,carrera,tutor)
												 VALUES(:nombre,:carrera,:tutor)");

			$stm->bindParam(":nombre",$datosModel["nombre"],PDO::PARAM_STR);
			$stm->bindParam(":carrera",$datosModel["carrera"],PDO::PARAM_INT);
			$stm->bindParam(":tutor",$datosModel["tutor"],PDO::PARAM_INT);
			if($stm->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}

			$stm->close();
		}
		//Funcion del modelo para borrar a algun alumno por medio de su matricula
		public function borrarAlumnoModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where matricula = :id");
			$stmt->bindParam("id",$datosModel,PDO::PARAM_STR);
			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}

			$stmt->close();
		}
		//Funcion del modelo que nos permite traer los datos del usuario y comprobar su emai y password para permitir el login
		public static function ingresoUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT email, password,numero FROM $tabla WHERE email = :email");	
		$stmt->bindParam(":email", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetch();

		$stmt->close();

		}

		//Funcion del modelo para obtener los datos de un alumno por medio de su matricula
		public function editarAlumnoModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where matricula = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}
		//Funcion que nos permite traer todos los alumnos que tiene un tutor, esto sirve en el apartado de tutorias para solamente obtener los alumnos
		//de los que el maestro es tutor y asi poder registrar la tutoria
		public function obtenerAlumnosDeTutorModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where tutor = :tutor");
			$stmt->bindParam(":tutor",$datosModel,PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}
		//Funcion que trae la vistas de la tutoria con respecto al maestro que esta logeado
		public function vistaTutoriasModel($datosModel,$tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT *, alumno.nombre as alumNom FROM $tabla inner join alumno on $tabla.alumno = alumno.matricula where $tabla.tutor = :tutor");
			$stmt->bindParam(":tutor",$datosModel,PDO::PARAM_INT);	
			$stmt->execute();

			return $stmt->fetchAll();

			$stmt->close();

		}
		//Funcion que nos permite traer todas las tutorias sin importar el maestro
		public function vistaReportesTutoriasModel($tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT *, alumno.nombre as alumNom, maestro.nombre as maeNom FROM $tabla inner join alumno on $tabla.alumno = alumno.matricula inner join maestro on $tabla.tutor = maestro.numero");	
			$stmt->execute();

			return $stmt->fetchAll();

			$stmt->close();

		}
		//Funcion del modelo para registrar una tutoria
		public function registrarTutoriaModel($datosModel,$tabla)
		{
			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (alumno,tutor,fecha,hora,tipo,descripcion)
												 VALUES(:alumno,:tutor,:fecha,:hora,:tipo,:descripcion)");

			$stm->bindParam(":alumno",$datosModel["alumno"],PDO::PARAM_INT);
			$stm->bindParam(":tutor",$datosModel["tutor"],PDO::PARAM_INT);
			$stm->bindParam(":fecha",$datosModel["fecha"],PDO::PARAM_STR);
			$stm->bindParam(":hora",$datosModel["hora"],PDO::PARAM_STR);
			$stm->bindParam(":tipo",$datosModel["tipo"],PDO::PARAM_STR);
			$stm->bindParam(":descripcion",$datosModel["descripcion"],PDO::PARAM_STR);
			
			if($stm->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}

			$stm->close();
		}


	}
?>