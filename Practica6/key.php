<?php

//El id se pasara por medio de url dependiendo del usuario que elegimos para eliminar y asi poder eliminar el usuario correcto
$id = isset( $_GET['id'] ) ? $_GET['id'] : '';

//Se obtendra una variable tipo para saber que tipo de deportista es, y asi poder borrar el deportista de su respectiva tabla
$type = isset( $_GET['type'] ) ? $_GET['type'] : '';


//Se requerira el archivo database_utilities.php donde se tendran los distintos metodos de las diferentes sentencias sql
require_once('database_utilities.php');

//Borraremos el usuario con el metodo delete que se encuentra en methods.php en base al id que fue pasado por variable
delete($type,$id);

//Se redirigira automaticamente a las tablas de deportistas
header('Location: sports_view.php')
?>