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

	

	//Funcion delete que borrara un usuario en base a su id
	function delete($type,$id)
	{
		global $PDO;

		//El parametro type nos permite saber que tipo de deportista es y asi saber de que tabla buscaremos y borraremos
		//ese deportista
		if($type==1)
		{
			$table = "futbolistas";
		}
		else if($type==2)
		{
			$table = "basquetbolistas";
		}
		$sql = "DELETE FROM $table WHERE id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
	}

	

	

	//Funcion que hace query de todos los conteos en la primera tabla del archivo count_view.php, aqui solo se 
	//manda llamar los distintos metodos que hacen las consultas query.
	function run_query()
	{
		$arr['total_users'] = queryTotalUsers();
		$arr['total_user_types'] = queryTotalUserTypes();
		$arr['total_status_types'] = queryTotalStatusTypes();
		$arr['total_user_logs'] = queryTotalLogs();
		$arr['total_user_active'] = queryActiveUsers();
		$arr['total_user_inactive'] = queryInactiveUsers();

		//Se regresa el array asociativo con todos los resultados		
		return $arr;

	}

	//Funcion que cuenta todos los usuarios para mostrarlos en la primera tabla en count_view.php
	function queryTotalUsers()
	{
		global $PDO;
		$sql = "SELECT COUNT(*) AS total_users FROM USER";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results[0]['total_users'];
	}

	//Funcion que cuenta todos los tipos de usuarios para mostrarlos en la primera tabla en count_view.php
	function queryTotalUserTypes()
	{
		global $PDO;
		$sql = "SELECT count(*) as total_user_types FROM user_type";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results[0]['total_user_types'];

	}

	//Funcion que cuenta todos los tipos de estado para mostrarlos en la primera tabla en count_view.php
	function queryTotalStatusTypes()
	{
		global $PDO;
		$sql = "SELECT count(*) as total_status_types FROM status";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results[0]['total_status_types'];

	}

	//Funcion que cuenta todos los logs para mostrarlos en la primera tabla en count_view.php
	function queryTotalLogs()
	{
		global $PDO;
		$sql = "SELECT count(*) as total_user_logs FROM user_log";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results[0]['total_user_logs'];

	}

	//Funcion que cuenta todos los usuarios ACTIVOS para mostrarlos en la primera tabla en count_view.php
	function queryActiveUsers()
	{
		global $PDO;
		$sql = "SELECT count(*) as total_users_active from user where status_id = 1";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results[0]['total_users_active'];

	}

	//Funcion que cuenta todos los usuarios INACTIVOS para mostrarlos en la primera tabla en el archivo count_view.php
	function queryinActiveUsers()
	{
		global $PDO;
		$sql = "SELECT count(*) as total_users_inactive from user where status_id = 2";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results[0]['total_users_inactive'];

	}

	//Funcion que crea la vista de la tabla 'users' para mostrarlos en count_view.php
	function queryUsersTable()
	{
		global $PDO;
		$sql = "SELECT * from user";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
	}

	//Funcion que crea la vista de la tabla 'user_logs' para mostrarlos en count_view.php
	function queryUserLogTable()
	{
		global $PDO;
		$sql = "SELECT * from user_log";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
	}

	//Funcion que hace la vista de de user_types para mostrarlos en count_view.php

	function queryUserTypeTable()
	{
		global $PDO;
		$sql = "SELECT * from user_type";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
	}

	//Funcion que hace la vista de la tabla 'status' para mostrarlo en count_vierw.php
	function queryStatusTable()
	{
		global $PDO;
		$sql = "SELECT * from status";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
	}

	//Esta funcion nos permite traer todos los futbolistas que tengamos en nuestra base de datos y mostrarlos en
	//sports_view.php
	function querySoccerPlayers()
	{
		global $PDO;
		$sql = "SELECT * from futbolistas";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
	}

	//Esta funcion nos permite traer todos los basquetbolistas que tengamos en nuestra base de datos y mostrarlos en
	//sports_view.php
	function queryBasketballPlayers()
	{
		global $PDO;
		$sql = "SELECT * from basquetbolistas";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
	}

	//Funcion donde se inserta un nuevo deportista
	function addUser($user,$password)
	{
		global $PDO;

		$safePassword = md5($password);
  		$sql = "INSERT INTO usuario (usuario,password) VALUES ('$user','$safePassword')";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
  	}

	function addProduct($nombre,$precio)
	{
		global $PDO;

  		$sql = "INSERT INTO producto (nombre,precio) VALUES ('$nombre','$precio')";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
  	}
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

  	function queryUsers()
  	{
  		global $PDO;
		$sql = "SELECT * from usuario";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
  	}

  	function deleteUser($id)
  	{
  		global $PDO;

  		$sql = "DELETE FROM usuario WHERE id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
  	}

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

  	function queryProducts()
  	{
  		global $PDO;
		$sql = "SELECT * from producto";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
  	}

  	function deleteProduct($id)
  	{
  		global $PDO;

  		$sql = "DELETE FROM producto WHERE id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
	}

	function search_per_id_product($id)
	{
		global $PDO;

		$sql = "SELECT * FROM producto where id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results[0];

	}

	function updateProduct($id,$nombre,$precio)
	{
		global $PDO;

  		$sql = "UPDATE producto SET nombre = '$nombre', precio = '$precio' where id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();

  	}

  	function querySales()
  	{
  		global $PDO;
		$sql = "SELECT * from venta";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
  	}

  	function querySalesDetails($id)
  	{
  		global $PDO;

  		$sql = "SELECT * from detalle_venta as dv inner join producto as pr on dv.id_producto = pr.id where id_venta = $id";
  		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results;
  	}

  	function addSale($monto,$fecha)
  	{
  		global $PDO;
  		$sql = "INSERT INTO venta (monto,fecha) VALUES ('$monto','$fecha')";
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  	}

  	function queryLastSale()
  	{
  		global $PDO;
  		
  		$sql = "SELECT max(id) from venta";
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  		$results = $statement->fetchAll();
  		return $results[0]['max(id)'];
  	}

  	function addDetailsSale($id_venta,$id_producto,$cantidad,$prom_prenda)
  	{
  		global $PDO;
  		$sql = "INSERT INTO detalle_venta (id_venta,id_producto,cantidad,prom_prenda) values ('$id_venta','$id_producto','$cantidad','$prom_prenda') ";

  		echo $sql;
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  	}

  	function queryIdProduct($nombre)
  	{
  		global $PDO;
  		$sql = "SELECT id FROM producto WHERE nombre = '$nombre'";
  		$statement = $PDO->PREPARE($sql);
  		$statement->EXECUTE();
  		$results = $statement->fetchAll();
  		return $results[0]['id'];
  	}

		


?>