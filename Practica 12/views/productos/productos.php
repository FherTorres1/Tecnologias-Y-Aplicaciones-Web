<?php
	//Se comprueba si se ha inciiado sesion
	if(!isset($_SESSION['validar']))
	{
		header("Location: index.php");
	}
?>
<h1 align="center">Productos</h1>
<div align="center">
<input type="button" name="registrar_btn" value="Registrar Producto" class="button tiny success" style='width: 20%; font-size: 20px;' onclick="window.location='index.php?action=registrar_producto'">
</div>

<link rel="stylesheet" href="./css/foundation.css"/>
<table border="2" align="center" class="display" width="80%" id="example">
		
	<thead>
			
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Unidades</th>
			<th>Editar?</th>
			<th>Borrar?</th>
		</tr>

	</thead>

	<tbody>

		<?php
			//Se hace una instancia del controlador
			$vistaProducto = new MvcController();
			//Se manda llamar el metodo para traer la vista de los productos
			$vistaProducto->vistaProductosController();
			//Se manda llamar el metodo para borrar algun producto en base a su ID
			$vistaProducto->borrarProductoController();

		?>
	</tbody>
</table>


<script type="text/javascript">
	//Funcion de JS para confirmar si queremos borrar una carrera
	function confirmar()
	{
		var x = confirm("Seguro que deseas borrar el registro?");
		if(!x)
		{
			event.preventDefault();
		}
	}
</script>