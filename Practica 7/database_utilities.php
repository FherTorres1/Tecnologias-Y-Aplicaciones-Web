<?php

	//Se requerira el archivo database_credentials.php para tener las credenciales de la base de datos
	require_once('database_credentials.php');

	//Se crea la conexion de base de datos usando PDO
	try
	{

		$PDO = new PDO(	$dsn, $user, $password);

	}
	catch(PDOException $e)
	{

		echo 'Error al conectarnos: ' . $e->getMessage();
	}

	//Funcion donde se inserta un nuevo usuario
	function addUser($user,$password)
	{
		global $PDO;

		//Se encripta la contrasena del usuario con MD5
		$safePassword = md5($password);
  		$sql = "INSERT INTO usuario (usuario,password) VALUES ('$user','$safePassword')";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
  	}

  	//Funcion donde se inserta un producto
	function addProduct($nombre,$precio)
	{
		global $PDO;

  		$sql = "INSERT INTO producto (nombre,precio) VALUES ('$nombre','$precio')";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
  	}

  	//Funcion para buscar comprobar si el usuario existe al momento de hacer login, regresa un true si esta registrado en la base de datos o un false si no lo esta
  	function findUser($user,$password)
  	{
  		global $PDO;

  		$safePassword = md5($password);
  		$sql = "SELECT * FROM usuario where usuario = '$user' AND password = '$safePassword'";
  		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		if($statement->rowCount() > 0)
		{
			return true;
		}
		return false;
  	}

  	//Funcion que obtiene todos los usuarios para mostrarlos en la tabla
  	function queryUsers()
  	{
  		global $PDO;
		$sql = "SELECT * from usuario";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
  	}

  	//Funcion que borra un usuario
  	function deleteUser($id)
  	{
  		global $PDO;

  		$sql = "DELETE FROM usuario WHERE id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
  	}

  	//Funcion para traer los datos del usuario en el formulacio para actualizar
	function search_per_id_user($id)
	{
		global $PDO;

		$sql = "SELECT * FROM usuario where id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results[0];

	}

	//Funcion que actualiza los datos del usuario segun se hayan captado en el formulario
	function updateUser($usuario,$id)
	{
		global $PDO;

  		$sql = "UPDATE usuario SET usuario = '$usuario' where id='$id'";

		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();

  	}

  	//Funcion para traer la informacion de todos los productos y mostrarlos en la tabla
  	function queryProducts()
  	{
  		global $PDO;
		$sql = "SELECT * from producto";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
  	}

  	//Funcion para borrar productos
  	function deleteProduct($id)
  	{
  		global $PDO;

  		$sql = "DELETE FROM producto WHERE id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
	}

	//Funcion para traer los datos del producto en el formulario de actualizar
	function search_per_id_product($id)
	{
		global $PDO;

		$sql = "SELECT * FROM producto where id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results[0];

	}

	//Funcion para actualizar los datos del producto
	function updateProduct($id,$nombre,$precio)
	{
		global $PDO;

  		$sql = "UPDATE producto SET nombre = '$nombre', precio = '$precio' where id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();

  	}

  	//Funcion para traer todas las ventas y mostrarla en la tabla de ventas
  	function querySales()
  	{
  		global $PDO;
		$sql = "SELECT * from venta";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
  	}

  	//Funcion para traer los detalles de cada venta cuando se de click en el boton Detalle de Venta
  	function querySalesDetails($id)
  	{
  		global $PDO;

  		$sql = "SELECT * from detalle_venta as dv inner join producto as pr on dv.id_producto = pr.id where id_venta = $id";
  		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
  	}

  	//Funcion para agregar los datos de control de una venta
  	function addSale($monto,$fecha)
  	{
  		global $PDO;
  		$sql = "INSERT INTO venta (monto,fecha) VALUES ('$monto','$fecha')";
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  	}

  	//Funcion para traer la ultima venta que se registro y asi poder registrar sus detalles
  	function queryLastSale()
  	{
  		global $PDO;
  		
  		$sql = "SELECT max(id) from venta";
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  		$results = $statement->fetchAll();
  		return $results[0]['max(id)'];
  	}

  	//Funcion para registrar los detalles de cada venta
  	function addDetailsSale($id_venta,$id_producto,$cantidad,$prom_prenda)
  	{
  		global $PDO;
  		$sql = "INSERT INTO detalle_venta (id_venta,id_producto,cantidad,prom_prenda) values ('$id_venta','$id_producto','$cantidad','$prom_prenda') ";

  		echo $sql;
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  	}

  	//Funcion para traer los datos del producto en base a su id y poderlo registrar en detalle_venta
  	function queryIdProduct($nombre)
  	{
  		global $PDO;
  		$sql = "SELECT id FROM producto WHERE nombre = '$nombre'";
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  		$results = $statement->fetchAll();
  		return $results[0]['id'];
  	}

  	//Funcion que busca la ventas en base a su fecha (se utiliza para el filtro de busqueda por fecha)
  	function querySalesPerDate($date)
  	{
  		global $PDO;
  		if($date == '1970-01-01')
  		{
  			return querySales();
  		}
  		$sql = "SELECT * from venta where fecha = '$date'";
  		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
  	}

		


?>