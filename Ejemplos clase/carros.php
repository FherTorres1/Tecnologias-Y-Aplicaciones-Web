<?php
	/*CLASE
		Es un modelo que se utiliza objetos que COMPARTEN un mismo comportamiento,
		estado e identidad. 
	*/

	class Automovil
	{
		/*
			PROPIEDADES:
			Son las caracteristicas que puede tener un objeto.

		*/

		public $marca;
		public $modelo;

		/*
			Modelo:
			Es el algoritmo asociado a un objeto que indica de lo que este puede hacer.
			La unica diferencia entre metodo y funcion, es que llamamos metodo a las funciones
			de unaa CLASE (en POO), mientras que llamamos funciones a los algoritmos de Programacion
			Estructurada.
		*/

		public function mostrar()
		{
			/*
				This hace referencia al objeto actual (Automovil)
			*/
			echo"<p>Hola! soy un $this->marca, de modelo $this->modelo</p>";
		}
	}

	/*
		OBJETO
		Es el algoritmo asociado a un objeto que indica la capacidad de lo que este hace.
		Asi mismo, es la entidad provista de metodos o mensajes de los cuales responde a las propiedades
		con VALORES CONCRETOS.
	*/

	$a = new Automovil();
	$a-> marca ="Toyota";
	$a-> modelo = "Corolla";
	$a-> mostrar();

	$b = new Automovil();
	$b-> marca ="Ford";
	$b-> modelo = "Fiesta";
	$b-> mostrar();

	/*
		Abstracion
			Nuevos tipos de datos creados por el usuario
		
		Encapsulamiento
			Organizacion del codigo en grupos logicos
		
		Ocultamiento
			Oculta detalles de implementacion y se expoe solo lo que es necesario para el resto del sistema
	*/
?>