<h1>EDITAR CARRERA</h1>

<form method="post">
	
	<?php

		$editarAlumno = new MvcController();
		$editarAlumno -> editarAlumnoController();
		//$editarCarrera -> actualizarCarreraController();

	?>

</form>

<script type="text/javascript">
	function confirmar()
	{
		var x = confirm("Deseas guardar los datos?");
		if(!x)
		{
			event.preventDefault();
		}
	}
</script>