<?php
	//Conexion a la base de datos
	class Conexion{

	public static function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=practica12","root","");
		return $link;

	}

}
?>