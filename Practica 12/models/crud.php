<?php
	//Se requiere la conexion a la base de datos
	require_once("conexion.php");
	//Clase datos que extiende a la conexion
	class Datos extends Conexion
	{
	
		//Funcion del modelo para registrar un producto
		public function registrarProductoModel($datosModel,$tabla)
		{
			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre,precio,unidades) VALUES(:nombre,:precio,:unidades)");
			$stm->bindParam(":nombre",$datosModel['nombre'],PDO::PARAM_STR);
			$stm->bindParam(":precio",$datosModel['precio']);
			$stm->bindParam(":unidades",$datosModel['unidades'],PDO::PARAM_STR);
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

		//Funcion del modelo para traer la vista de todos los productos
		public function vistaProductosModel($tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		//Funcion del modelo que trae todos los productos donde el stock sea 0
		public function vistaProductosSinStock($tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where unidades = 0");	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		//Funcion del modelo para borrar un producto
		public function borrarProductoModel($datosModel,$tabla)
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
		//Funcion del modelo para hacer el formulario y traer los valores del producto dado su ID
		public function editarProductoModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}
		//Funcion del modelo para hacer UPDATE a la BD en la tabla producto
		public function actualizarProductoModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, precio = :precio, unidades = :unidades where id = :id");
			$stmt->bindParam(":nombre",$datosModel["nombre"],PDO::PARAM_STR);
			$stmt->bindParam(":id",$datosModel["id"],PDO::PARAM_STR);
			$stmt->bindParam(":precio",$datosModel["precio"],PDO::PARAM_STR);
			$stmt->bindParam(":unidades",$datosModel["unidades"]);

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

		$stmt = Conexion::conectar()->prepare("SELECT email, password FROM $tabla WHERE email = :email");	
		$stmt->bindParam(":email", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->execute();

		#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetch();

		$stmt->close();

		}

		

	}
?>