<?php
	//Se comprueba si se ha iniciado sesion
	if(!isset($_SESSION['validar']))
	{
		header("Location: index.php");
	}
?>
<h1 align="center">Dashboard</h1>
<link rel="stylesheet" href="./css/foundation.css"/><br><br><br>
<h3 align="center">Productos sin Stock</h3>
<table border="2" align="center" class="display" width="80%" id="example">
		
	<thead>
			
		<tr>
			<th>Nombre</th>
			<th>Unidades</th>
		</tr>

	</thead>
	</thead>

	<tbody>

		<?php
			//Se hace una instancia del controlador
			$vistaProductos = new MvcController();
			//Se manda llamar al vista de productos sin Stock
			$vistaProductos->vistaProductosSinStock();

		?>
	</tbody>
</table>

