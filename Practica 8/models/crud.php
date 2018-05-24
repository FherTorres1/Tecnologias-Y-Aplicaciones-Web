<?php
	require_once("conexion.php");
	class Datos extends Conexion
	{
	
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

		public function vistaCarrerasModel($tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT id, nombre FROM $tabla");	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

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

		public function editarCarreraModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}

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

		public function vistaAlumnosModel($tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT *,$tabla.nombre as aluNom,carrera.nombre as carNom, maestro.nombre as masNom FROM $tabla inner join maestro on $tabla.tutor = maestro.numero inner join carrera on $tabla.carrera = carrera.id");	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		public function vistaMaestrosModel($tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT *,carrera.nombre as car,$tabla.nombre as nom from $tabla inner join carrera on $tabla.carrera = carrera.id");
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

		public function obtenerCarrerasModel($tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

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
		public function editarMaestroModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where numero = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}
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
		public function obtenerMaestrosModel($tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");
			$stmt->execute();

			return $stmt->fetchAll();
			$stmt->close();
		}

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
		public function ingresoUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT usuario, password FROM $tabla WHERE usuario = :usuario");	
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetch();

		$stmt->close();

		}

		public function editarAlumnoModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where matricula = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}

	}
?>