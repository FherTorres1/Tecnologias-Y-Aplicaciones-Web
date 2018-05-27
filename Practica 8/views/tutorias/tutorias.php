<h1 align="center">Mis Tutorias</h1>
<div align="center">
<input type="button" name="registrar_btn" value="Registrar Tutoria" class="button tiny success" style='width: 20%; font-size: 20px;' onclick="window.location='index.php?action=registrar_tutoria'">
</div>

<link rel="stylesheet" href="./css/foundation.css"/>
<table border="2" align="center" class="display" width="80%" id="example">
		
	<thead>
			
		<tr>
			<th>Id</th>
			<th>Alumno</th>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Tipo</th>
			<th>Descripcion</th>
			<th>Borrar?</th>
		</tr>

	</thead>

	<tbody>

		<?php
			//Se hace una instancia del controlador
			$vistaTutoria = new MvcController();
			//Se manda llamar la vista de la tutoria
			$vistaTutoria->vistaTutoriasController();
			//Se manda llamar el metodo para borrar alguna tutoria
			$vistaTutoria->borrarTutoriaController();

		?>
	</tbody>
</table>


<script type="text/javascript">
	//Funcion de JS para comprobar si queremos borrar alguna tutoria
	function confirmar()
	{
		var x = confirm("Seguro que deseas borrar el registro?");
		if(!x)
		{
			event.preventDefault();
		}
	}
</script>