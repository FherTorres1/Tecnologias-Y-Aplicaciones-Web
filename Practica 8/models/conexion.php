<?php
	class Conexion{

	public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=practica8","root","");
		return $link;

	}

}
?>