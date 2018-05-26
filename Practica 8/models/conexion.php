<?php
	class Conexion{

	public static function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=practica8","root","");
		return $link;

	}

}
?>