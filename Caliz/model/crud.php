<?php
	require_once('conexion.php');

	class Datos extends Conexion
	{
		public function ingresoUsuarioModel($datosModel,$tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM usuario where usuario = :usuario AND password = :password");
			$stmt->bindParam(":usuario",$datosModel['usuario']);
			$stmt->bindParam(":password",$datosModel['password']);
			$stmt->execute();
			return $stmt->fetchAll();

		}
	}
?>