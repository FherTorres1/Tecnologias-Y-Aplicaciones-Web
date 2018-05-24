<h1>EDITAR CARRERA</h1>

<form method="post">
	
	<?php

		$editarMaestro = new MvcController();
		$editarMaestro -> editarMaestroController();
		$editarMaestro -> actualizarMaestroController();

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