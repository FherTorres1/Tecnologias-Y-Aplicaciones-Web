<?php
require_once('methods.php');
$id = isset( $_GET['id'] ) ? $_GET['id'] : '';
delete($id);
header('Location: index.php')
?>