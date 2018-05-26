<h1 align="center">Carreras</h1>
<input type="button" name="registrar_btn" value="Registrar Carrera" onclick="window.location='index.php?action=registrar_carrera'">

<link rel="stylesheet" href="./css/foundation.css"/>
<table border="2" align="center">
		
	<thead>
			
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Editar?</th>
			<th>Borrar?</th>
		</tr>

	</thead>

	<tbody>

		<?php
			$vistaCarrera = new MvcController();
			$vistaCarrera->vistaCarrerasController();
			$vistaCarrera->borrarCarreraController();

		?>
	</tbody>
</table>


<script type="text/javascript">
	function confirmar()
	{
		var x = confirm("Seguro que deseas borrar el registro?");
		if(!x)
		{
			event.preventDefault();
		}
	}
</script>