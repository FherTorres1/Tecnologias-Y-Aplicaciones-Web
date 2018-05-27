<nav>
<ul>
	<?php
		//Se hace una instancia del controlador
		$vistaController = new MvcController();
		//Metodo para conocer que usuario ha accedido y con eso desplegar su respectivo NAV
		$vistaController->controlNav(); 
	?>
</ul>
</nav>