<?php
	//Se requiere la conexion a la base de datos
	require_once("conexion.php");
	//Clase datos que extiende a la conexion
	class Datos extends Conexion
	{
	
		//Funcion del modelo para registrar un producto
		public function registrarProductoModel($datosModel,$tabla)
		{

			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo_producto,nombre_producto,date_added,precio_producto,stock,id_categoria) VALUES(:codigo,:nombre,:fecha,:precio,:stock,:categoria)");
			$stm->bindParam(":codigo",$datosModel['codigo']);
			$stm->bindParam(":nombre",$datosModel['nombre']);
			$stm->bindParam(":fecha",$datosModel['date']);
			$stm->bindParam(":precio",$datosModel['precio']);
			$stm->bindParam(":stock",$datosModel['unidades']);
			$stm->bindParam(":categoria",$datosModel['categoria']);
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

		//Funcion del modelo que registrar una categoria nueva
		public function registrarCategoriaModel($datosModel,$tabla)
		{
			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_categoria,descripcion_categoria,date_added) VALUES(:nombre,:descripcion,:fecha)");
			$stm->bindParam(":nombre",$datosModel['nombre']);
			$stm->bindParam(":descripcion",$datosModel['descripcion']);
			$stm->bindParam(":fecha",$datosModel['date']);
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

		public function registrarUsuarioModel($datosModel,$tabla)
		{
			print_r($datosModel);
			echo $tabla;

			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (	firstname,lastname,user_name,user_password_hash,user_email,date_added) VALUES(:nombre,:apellido,:user,:password,:email,:fecha)");

			$stm->bindParam(":nombre",$datosModel['nombre']);
			$stm->bindParam(":apellido",$datosModel['apellido']);
			$stm->bindParam(":user",$datosModel['user']);
			$stm->bindParam(":password",$datosModel['password']);
			$stm->bindParam(":email",$datosModel['email']);
			$stm->bindParam(":fecha",$datosModel['date']);
			if($stm->execute())
			{
				return "success";
			}
			else
			{
				print_r(Conexion::conectar()->errorInfo());
			}

			//$stm->close();
		}

		//Funcion del modelo para traer la vista de todos los productos
		public function vistaProductosModel($tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla inner join categoria on $tabla.id_categoria = categoria.id_categoria");	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		public function countUsersModel($tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
		}
		public function countProductsModel($tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
		}
		public function countCategoriesModel($tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
		}

		public function vistaHistorialModel($datosModel,$tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where fecha >= :today AND fecha <= :later");
			$stmt->bindParam(":today",$datosModel['hoy'],PDO::PARAM_STR);
			$stmt->bindParam(":later",$datosModel['later'],PDO::PARAM_STR);	

			$stmt->execute();
			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		public function insertarStockModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET stock = :stock where $tabla.id_producto = :id");
			$stmt->bindParam(":id",$datosModel['id']);
			$stmt->bindParam(":stock",$datosModel['cantidad']);	
			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}
			
		}
		public function insertarHistorialModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_producto,id_user,fecha,nota,referencia,cantidad) VALUES(:id_producto,:id_user,:fecha,:nota,:referencia,:cantidad)");
			$stmt->bindParam(":id_producto",$datosModel['idProducto']);
			$stmt->bindParam(":id_user",$datosModel['idUser']);
			$stmt->bindParam(":fecha",$datosModel['fecha']);
			$stmt->bindParam(":nota",$datosModel['nota']);
			$stmt->bindParam(":referencia",$datosModel['referencia']);
			$stmt->bindParam(":cantidad",$datosModel['cantidad']);
			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}
			
		}
		public function obtenerProductoModel($datosModel,$tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla inner join categoria on $tabla.id_categoria = 
												   categoria.id_categoria where $tabla.id_producto = :id");

			$stmt->bindParam(":id",$datosModel);	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}
		public function vistaCategoriasModel($tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();
		}

		public function vistaUsuariosModel($tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		public function checkPasswordModel($tabla,$datosModel)
		{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where id_user = :id");
			$stm->bindParam(":id",$datosModel);	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		//Funcion del modelo que trae todos los productos donde el stock sea 0
		public function vistaProductosSinStock($tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where stock = 0");	
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

		public function borrarCategoriaModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where id_categoria = :id");
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

		public function borrarUsuarioModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where id_user = :id");
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
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_producto = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}

		public function editarCategoriaModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_categoria = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}
		public function editarUsuarioModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_user = :id");
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
		public function actualizarCategoriaModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_categoria = :nombre, descripcion_categoria = :descripcion where id_categoria = :id");
			$stmt->bindParam(":id",$datosModel["id"]);
			$stmt->bindParam(":nombre",$datosModel["nombre"]);
			$stmt->bindParam(":descripcion",$datosModel["descripcion"]);

			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}
		}

		public function actualizarUsuarioModel($datosModel,$tabla)
		{
			print_r($datosModel);
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET firstname = :nombre, lastname = :apellido, user_name = :user, user_email = :email where id_user = :id");
			$stmt->bindParam(":nombre",$datosModel["nombre"],PDO::PARAM_STR);
			$stmt->bindParam(":id",$datosModel["id"],PDO::PARAM_INT);
			$stmt->bindParam(":apellido",$datosModel["apellido"],PDO::PARAM_STR);
			$stmt->bindParam(":user",$datosModel["user"],PDO::PARAM_STR);
			$stmt->bindParam(":email",$datosModel["emailEditar"],PDO::PARAM_STR);

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

			print_r($datosModel);
			$stmt = Conexion::conectar()->prepare("SELECT firstname,lastname,id_user,user_email, user_password_hash FROM $tabla WHERE user_email = :email AND user_password_hash = :password ");	
			$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
			$stmt->execute();

			#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetch();

			$stmt->close();

		}

		

	}
?>