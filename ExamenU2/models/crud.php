<?php
	//Se requiere la conexion a la base de datos
	require_once("conexion.php");
	//Clase datos que extiende a la conexion
	class Datos extends Conexion
	{
	
		//Funcion del modelo para registrar una alumna en la base de datos
		public function registrarAlumnaModel($datosModel,$tabla)
		{

			//Se hace la sentencia SQL necesaria para hacer el registro en la base de datos
			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_alumna,apellido_alumna,fecha_nacimiento,id_grupo) VALUES(:nombre,:apellido,:fecha,:grupo)");
			//Parametros con todos los datos de la alumna
			$stm->bindParam(":nombre",$datosModel['nombre']);
			$stm->bindParam(":apellido",$datosModel['apellido']);
			$stm->bindParam(":fecha",$datosModel['fecha']);
			$stm->bindParam(":grupo",$datosModel['grupo']);
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

		//Funcion del modelo para registrar un grupo nuevo en la base de datos
		public function registrarGrupoModel($datosModel,$tabla)
		{	
			//Sentencia SQL para hacer el registro del grupo en la base de datos
			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_grupo) VALUES(:nombre)");
			$stm->bindParam(":nombre",$datosModel);
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

		//Funcion del modelo para registrar un pago de lugar en la base de datos
		public function registrarPagoModel($datosModel,$tabla)
		{
			//Sentencia SQL para hacer el registro en la base de datos
			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (id_alumna,id_grupo,nombre_mama,fecha_pago,fecha_envio,ruta,folio) VALUES(:id_alumna,:id_grupo,:nombre_mama,:fecha_pago,:fecha_envio,:ruta,:folio)");
			//Parametros con todos los datos que se ingresaran en la base de datos
			$stm->bindParam(":id_alumna",$datosModel['id_alumna']);
			$stm->bindParam(":id_grupo",$datosModel['id_grupo']);
			$stm->bindParam(":nombre_mama",$datosModel['nombreMama']);
			$stm->bindParam(":fecha_pago",$datosModel['fecha_pago']);
			$stm->bindParam(":fecha_envio",$datosModel['fecha_envio']);
			$stm->bindParam(":ruta",$datosModel['ruta']);
			$stm->bindParam(":folio",$datosModel['folio']);
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
		
		//Funcion para la vista de todos los pagos que se han registro hasta el momento
		public function vistaPagosPublicosModel($tabla)
		{
			//Sentnecia SQL con innerjoins ya que la tabla de pagos solo tiene registrados los id
			//asi podemos obtener el nombre de la alumna que ha sido registrada
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla inner join alumna on $tabla.id_alumna = alumna.id_alumna inner join grupo on $tabla.id_grupo = grupo.id_grupo order by fecha_envio asc");	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();
		}

		//Funcion para hacer la vista de todos los grupos que se han registrado en la base de datos
		public function vistaGruposModel($tabla)
		{
			//Sentencia SQL que ejecuta la consulta
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();
		}

		//Funcion para hacer la vista de todas las alumnas que han sido registradas
		public function vistaAlumnasModel($tabla)
		{
			//Sentencia SQL con innerjoins ya que la alumna solo tiene registrado el id del grupo
			//y con esto podemos obtener el nombre del grupo
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla inner join grupo on $tabla.id_grupo = grupo.id_grupo");
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		//Funcion del modelo para borrar un pago en base a su id
		public function borrarPagoModel($datosModel,$tabla)
		{
			//Sentencia SQL que efectuara el borrado del registro en base a su id
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where id_pago = :id");
			//Parametros para obtener el id y efectuar
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

		//Funcion para borrar un grupo en base a su id
		public function borrarGrupoModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where id_grupo = :id");
			$stmt->bindParam("id",$datosModel);
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


		//Funcion para borrar una alumna en base a su id
		public function borrarAlumnaModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where id_alumna = :id");
			$stmt->bindParam("id",$datosModel);
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


		//Funcion del modelo para hacer el formulario y traer los valores del pago dado su ID
		public function editarPagoModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_pago = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}

		//Funcion para obtener lo datos del grupo que se pretende actualizr
		public function editarGrupoModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_grupo = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}
		//Funcion para obtener los datos de la alumna que se pretende actualizar
		public function editarAlumnaModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_alumna = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}
		//Funcion del modelo para hacer UPDATE a la BD en la tabla pagi
		public function actualizarPagoModel($datosModel,$tabla)
		{	
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_mama = :mama, fecha_pago = :fecha_pago, fecha_envio = :fecha_envio, folio = :folio where id_pago = :id");

			$stmt->bindParam(":mama",$datosModel["mama"]);
			$stmt->bindParam(":id",$datosModel["id"]);
			$stmt->bindParam(":fecha_pago",$datosModel["fecha_pago"]);
			$stmt->bindParam(":fecha_envio",$datosModel["fecha_envio"]);
			$stmt->bindParam(":folio",$datosModel["folio"]);


			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}
		}
		//Funcion para hacer el update a la base de datos del grupo
		public function actualizarGrupoModel($datosModel,$tabla)
		{
			print_r($datosModel);
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_grupo = :nombre where id_grupo = :id");
			$stmt->bindParam(":id",$datosModel["id"]);
			$stmt->bindParam(":nombre",$datosModel["nombre"]);

			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}
		}


		//Funcion para hacer el update a la tabla de alumna
		public function actualizarAlumnaModel($datosModel,$tabla)
		{
			print_r($datosModel);
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_alumna = :nombre, apellido_alumna = :apellido, fecha_nacimiento = :fecha, id_grupo = :grupo where id_alumna = :id");
			$stmt->bindParam(":nombre",$datosModel["nombre"],PDO::PARAM_STR);
			$stmt->bindParam(":id",$datosModel["id"],PDO::PARAM_INT);
			$stmt->bindParam(":apellido",$datosModel["apellido"],PDO::PARAM_STR);
			$stmt->bindParam(":fecha",$datosModel["fecha"],PDO::PARAM_STR);
			$stmt->bindParam(":grupo",$datosModel["grupo"],PDO::PARAM_INT);

			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}
		}
		
		//Funcion del modelo que nos permite traer los datos del usuario y comprobar su emai y password para permitir el login
		public static function ingresoUsuarioModel($datosModel, $tabla){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE email = :email AND password = :password ");	
			$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
			$stmt->execute();

			#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetch();

			$stmt->close();

		}

		

	}
?>