<?php

//El id se pasara por medio de url dependiendo del producto que elegimos para eliminar y asi poder eliminar el producto correcto
$id = isset( $_GET['id'] ) ? $_GET['id'] : '';

//Se requerira el archivo database_utilities.php donde se tendran los distintos metodos de las diferentes sentencias sql
require_once('database_utilities.php');

//Borraremos el producto con el metodo deleteProduct que se encuentra en database_credentials.php en base al id que fue pasado por variable
deleteProduct($id);

//Se redirigira automaticamente a las tablas de productos
header('Location: products_view.php')
?>