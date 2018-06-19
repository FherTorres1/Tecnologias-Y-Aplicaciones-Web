<?php
	//Se requiere la conexion a la base de datos
	require_once("conexion.php");
	//Clase datos que extiende a la conexion
	class Datos extends Conexion
	{
	
		//Funcion del modelo para registrar un producto
		public function registrarProductoModel($datosModel,$tabla)
		{

			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo_producto,nombre_producto,date_added,precio_producto,stock,id_categoria,id_tienda) VALUES(:codigo,:nombre,:fecha,:precio,:stock,:categoria,:id_tienda)");
			$stm->bindParam(":codigo",$datosModel['codigo']);
			$stm->bindParam(":nombre",$datosModel['nombre']);
			$stm->bindParam(":fecha",$datosModel['date']);
			$stm->bindParam(":precio",$datosModel['precio']);
			$stm->bindParam(":stock",$datosModel['unidades']);
			$stm->bindParam(":categoria",$datosModel['categoria']);
			$stm->bindParam(":id_tienda",$datosModel['id_tienda']);
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
			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_categoria,descripcion_categoria,date_added,id_tienda) VALUES(:nombre,:descripcion,:fecha,:id_tienda)");
			$stm->bindParam(":nombre",$datosModel['nombre']);
			$stm->bindParam(":descripcion",$datosModel['descripcion']);
			$stm->bindParam(":fecha",$datosModel['date']);
			$stm->bindParam(":id_tienda",$datosModel['id_tienda']);
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
		public function registrarVentaModel($tabla,$datosModel)
		{
			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (fecha_venta,total_venta,id_tienda) VALUES(:fecha,:total,:id_tienda)");
			$stm->bindParam(":fecha",$datosModel['fecha']);
			$stm->bindParam(":total",$datosModel['total']);
			$stm->bindParam(":id_tienda",$datosModel['tienda']);
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
		public function registrarProductosVentasModel($tabla,$datosModel)
		{
			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (id_venta,id_producto,codigo_producto,nombre_producto,cantidad) VALUES(:id_venta,:id_producto,:codigo_producto,:nombre_producto,:cantidad)");
			$stm->bindParam(":id_venta",$datosModel['venta']);
			$stm->bindParam(":id_producto",$datosModel['id']);
			$stm->bindParam(":codigo_producto",$datosModel['codigo']);
			$stm->bindParam(":nombre_producto",$datosModel['nombre']);
			$stm->bindParam(":cantidad",$datosModel['cantidad']);
			if($stm->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}
		}

			
		public function vistaVentasModel($tabla,$datosModel)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where id_tienda = :id_tienda");	
			$stmt->bindParam(":id_tienda",$datosModel);
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();
		}
		public function vistaDetalleModel($tabla,$datosModel)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where id_venta = :id_venta");	
			$stmt->bindParam(":id_venta",$datosModel);
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();
		}

		public function registrarTiendaModel($datosModel,$tabla)
		{
			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_tienda,direccion_tienda) VALUES(:nombre,:direccion)");
			$stm->bindParam(":nombre",$datosModel['nombre']);
			$stm->bindParam(":direccion",$datosModel['direccion']);
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

		//Funcion para registrar un usuario en la base de datos
		public function registrarUsuarioModel($datosModel,$tabla)
		{
			print_r($datosModel);
			echo $tabla;

			$stm = Conexion::conectar()->prepare("INSERT INTO $tabla (	firstname,lastname,user_name,user_password_hash,user_email,date_added,id_tienda) VALUES(:nombre,:apellido,:user,:password,:email,:fecha,:id_tienda)");

			$stm->bindParam(":nombre",$datosModel['nombre']);
			$stm->bindParam(":apellido",$datosModel['apellido']);
			$stm->bindParam(":user",$datosModel['user']);
			$stm->bindParam(":password",$datosModel['password']);
			$stm->bindParam(":email",$datosModel['email']);
			$stm->bindParam(":fecha",$datosModel['date']);
			$stm->bindParam(":id_tienda",$datosModel['id_tienda']);
			if($stm->execute())
			{
				return "success";
			}
			else
			{
				print_r(Conexion::conectar()->errorInfo());
			}

			$stm->close();
		}

		//Funcion del modelo para traer la vista de todos los productos
		public function vistaProductosModel($tabla,$datosModel)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla inner join categoria on $tabla.id_categoria = categoria.id_categoria where $tabla.id_tienda = :id_tienda");
			$stmt->bindParam(":id_tienda",$datosModel);	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		//Funcion para contar los usuarios que hay en la base de datos y ponerlo en un widget
		public function countUsersModel($tabla,$datosModel)
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla where id_tienda = :id_tienda");
			$stmt->bindParam(":id_tienda",$datosModel,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
		}
		//Funcion para contar los productos y pone4rlos en un widget
		public function countProductsModel($tabla,$datosModel)
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla where id_tienda = :id_tienda");
			$stmt->bindParam(":id_tienda",$datosModel,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
		}
		//Funcion para contar las categorias y ponerlas en un widge
		public function countCategoriesModel($tabla,$datosModel)
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla where id_tienda = :id_tienda");
			$stmt->bindParam(":id_tienda",$datosModel,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
		}

		//Funcion para hacer la vista de historial del dia en el que esta, se usara un rango de fechas para obtener que todo el dia este condicionado
		public function vistaHistorialModel($datosModel,$tabla)
		{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla inner join producto on $tabla.id_producto = producto.id_producto where fecha >= :today AND fecha <= :later AND $tabla.id_tienda = :id_tienda");
			$stmt->bindParam(":today",$datosModel['hoy'],PDO::PARAM_STR);
			$stmt->bindParam(":later",$datosModel['later'],PDO::PARAM_STR);
			$stmt->bindParam(":id_tienda",$datosModel['id_tienda'],PDO::PARAM_INT);	

			$stmt->execute();
			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		//Funcion para hacer la actualizacion del stock
		public function updateStockModel($datosModel,$tabla)
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
		//Funcion para hacer la actualizacion del stock
		public function updateStockModelForSales($datosModel,$tabla)
		{
			$datosModel['cantidad']=$datosModel['stock']-$datosModel['cantidad'];
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

		//Funcion para hacer la insercion de los datos del historial de la presente actualizacion
		public function insertarHistorialModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_producto,id_user,fecha,nota,referencia,cantidad,id_tienda) VALUES(:id_producto,:id_user,:fecha,:nota,:referencia,:cantidad,:id_tienda)");
			$stmt->bindParam(":id_producto",$datosModel['idProducto']);
			$stmt->bindParam(":id_user",$datosModel['idUser']);
			$stmt->bindParam(":fecha",$datosModel['fecha']);
			$stmt->bindParam(":nota",$datosModel['nota']);
			$stmt->bindParam(":referencia",$datosModel['referencia']);
			$stmt->bindParam(":cantidad",$datosModel['cantidad']);
			$stmt->bindParam(":id_tienda",$datosModel['id_tienda']);
			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}
			
		}
		//Funcion para obtener los datos del producto que nos servira para mostrarlo sen la interfaz del movimiento de inventario
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
		//Funcion para hacer la vista de categorias
		public function vistaCategoriasModel($tabla,$datosModel)
		{
			print_r($datosModel);
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where id_tienda = :id_tienda");
			$stmt->bindParam(":id_tienda",$datosModel);
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();
		}

		//Funcion para hacer la vista de usuarios
		public function vistaUsuariosModel($tabla,$datosModel)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where id_tienda = :id_tienda AND id_user != :id_user");	
			$stmt->bindParam(":id_tienda",$datosModel['id_tienda']);
			$stmt->bindParam(":id_user",$datosModel['id_user']);
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}
		//Funcion del modelo que permite traer los datos de la tienda a la que se quiere iniciar sesion
		//para comprobar si la tienda esta activada o desactivada
		public function loginTiendasModel($tabla,$datosModel)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where id_tienda = :id_tienda");
			$stmt->bindParam(":id_tienda",$datosModel);	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		//Funcion para hacer la vista de todas las tiendas y mostrarlas en la interfaz de superadmin omitiendo la que esta registrada
		//el superadmin
		public function vistaTiendasModel($tabla,$datosModel)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where id_tienda != :id_tienda");
			$stmt->bindParam(":id_tienda",$datosModel);	
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		//Funcion para checar la password del usuario
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
		public function vistaProductosSinStock($tabla,$datosModel)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where stock = 0 AND id_tienda = :id_tienda");
			$stmt->bindParam(":id_tienda",$datosModel);
			$stmt->execute();

			#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetchAll();

			$stmt->close();

		}

		//Funcion del modelo para borrar un producto en base a su id
		public function borrarProductoModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where id_producto = :id");
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

		//Funcion para borrar una categoria en base a su id
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

		//Funcion para desactivar en base a su id
		public function desactivarTiendaModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado_tienda = :estado where  id_tienda = :id");
			$stmt->bindParam(":id",$datosModel['id']);
			$stmt->bindParam(":estado",$datosModel['estado']);
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

		//Funcion para borrar lo sproductos cuando la categoria se borre
		public function borrarProductoPorCategoriaModel($datosModel,$tabla)
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

		//Funcion para borrar un usuario en base a su id
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
		//Funcion para borrar una venta en base a su id
		public function borrarVentaModel($datosModel,$tabla)
		{
			print_r($datosModel);
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where id_venta = :id");
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

		//Funcion para obtener lo datos de la categoria que se pretende actualizr
		public function editarCategoriaModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_categoria = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}
		//Funcion del modelo para traer los datos al querer actualizar una tienda
		public function editarTiendaModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla where id_tienda = :id");
			$stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch();
			
			$stmt->close();

		}
		//Funcion para obtener los datos del usuario que se pretende actualizar
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
			print_r($datosModel);
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_producto = :nombre, precio_producto = :precio, stock = :unidades where id_producto = :id");

			echo 'UPDATE ' . $tabla . ' SET nombre = ' . $datosModel['nombre'] . ', precio = ' . $datosModel['precio'] . ', unidades = ' . $datosModel['unidades'] . ' where id_producto = ' . $datosModel['id'];
			$stmt->bindParam(":nombre",$datosModel["nombre"]);
			$stmt->bindParam(":id",$datosModel["id"]);
			$stmt->bindParam(":precio",$datosModel["precio"]);
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
		//Funcion para hacer el update a la base de datos de la categoria
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

		//Funcion para hacer el update a la base de datos de la categoria
		public function actualizarTiendaModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_tienda = :nombre, direccion_tienda = :direccion where id_tienda = :id");
			$stmt->bindParam(":id",$datosModel["id"]);
			$stmt->bindParam(":nombre",$datosModel["nombre"]);
			$stmt->bindParam(":direccion",$datosModel["direccion"]);

			if($stmt->execute())
			{
				return "success";
			}
			else
			{
				return "error";
			}
		}

		//Funcion para hacer el update a la tabla de usuario
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

			$stmt = Conexion::conectar()->prepare("SELECT firstname,lastname,id_user,user_email, user_password_hash,id_tienda FROM $tabla WHERE user_email = :email AND user_password_hash = :password ");	
			$stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
			$stmt->execute();

			#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetch();

			$stmt->close();

		}

		public function obtenerTiendaModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_tienda = :id_tienda");
			$stmt->bindParam(":id_tienda", $datosModel, PDO::PARAM_STR);
			$stmt->execute();

			#fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement. 
			return $stmt->fetch();

			$stmt->close();
		}

		

	}
?>