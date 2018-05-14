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

	//Funcion que busca la informacion de un usuario en base a su id, esto se hace para la parte traer los datos de cada
	//deportista cuando queramos actualizar su informacion
	function search_per_id($type,$id)
	{
		global $PDO;

		//El parametro type nos permite saber que tipo de deportista es y asi saber de que tabla buscaremos
		//ese deportista
		if($type==1)
		{
			$table = "futbolistas";
		}
		else if($type ==2)
		{
			$table = "basquetbolistas";
		}
		$sql = "SELECT * FROM $table where id='$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();
		$results = $statement-> fetchAll();
		return $results[0];

	}

	//Funcion que actualiza los datos del usuario segun se hayan captado en el formulario
	function update($type,$id,$idBf,$nombre,$posicion,$carrera,$email)
	{
		global $PDO;

		//El parametro type nos permite saber que tipo de deportista es y asi saber de que tabla buscaremos y actualizaremos
		//ese deportista
		if($type==1)
		{
			$table="futbolistas";
		}
		else if($type==2)
		{
			$table="basquetbolistas";
		}

		//Buscaremos el id que registro el usuario en el formulario, para saber si existe.
		$sql = "SELECT * FROM $table where id = '$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();

		//Si este es el caso, entonces regresaremos un valor booleano en falso para evitar que se haga la actualizacion
		//Tambien esta previsto de que el usuario no cambio el id y siendo esto, entonces si habra un id existente en la tabla
		//Por lo que condicionamos si el id que ya tenia el deportista es igual al que el usuario actualizo.
		//Asi que tenemos dos tipos de id's: El que quiere registrar el usuario '$id' y el anterior $idBf
		//Todo esto lo tenemos porque al momento de actualizar sin cambiar el id, entonces hara la busqueda con el id sin cambiar
		//Entonces si hace la consulta anterior el resultado sera un registro, lo que querra decir que el id si existe
		//y entonces no hara la actualizacion lo que es erroneo. Se condiciona si son los mismos id, si este es el caso
		//Entonces se procede a hacer la actualizacion aunque la consulta anterior haya traido algun resultado

		if($statement->rowCount() > 0 && $id != $idBf){

		//Si la consulta anterior trajo algun resultado, y los dos id's son diferentes entonces se regresara un falso
    	return false;
  	}
  	else
  	{
  		//Si no se repite el id, entonces procedemos a hacer la sentencia query
  		$sql = "UPDATE $table SET id = '$id', nombre='$nombre', posicion = '$posicion', carrera = '$carrera', email = '$email' where id='$idBf'";

  		echo $sql;
			$statement = $PDO->PREPARE($sql);
			$statement->EXECUTE();

			//Regresamos verdadero para que se proceda a hacer todo el proceso
			return true;
  	}

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
	function add($type,$id,$nombre,$posicion,$carrera,$email)
	{
		//El parametro type nos permite saber que tipo de deportista es y asi saber de que tabla buscaremos y actualizaremos
		//ese deportista
		global $PDO;
		if($type==1)
		{
			$table="futbolistas";
		}
		else if($type==2)
		{
			$table="basquetbolistas";
		}


		//Esta consulta nos permite saber si ya esta el id que ingreso el usuario registrado en nuestra base de datos
		$sql = "SELECT * FROM $table where id = '$id'";
		$statement = $PDO->PREPARE($sql);
		$statement->EXECUTE();

		//Si la consulta trajo algun resultado, entonces si esta el id registrado y entonces se regresa un falso
		//Para evitar que se haga la insercion
		if($statement->rowCount() > 0){
    	return false;
  	}
  	else
  	{
  		//De lo contrario se hace la insercion
  		$sql = "INSERT INTO $table (id,nombre,posicion,carrera,email) VALUES ('$id','$nombre','$posicion','$carrera','$email')";
			$statement = $PDO->PREPARE($sql);
			$statement->EXECUTE();
			return true;
  	}

	}
?>