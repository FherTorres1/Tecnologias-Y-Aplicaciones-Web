<?php
	//Conexion a la base de datos
	class Conexion{

	//Funcion para conectarse a la base de datos mediante PDO
	public static function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=examenu2","root","");
		return $link;

	}

}
?>