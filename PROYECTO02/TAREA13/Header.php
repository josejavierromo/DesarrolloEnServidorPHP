<?php

require_once "Element.php";

/*Autor: José Javier Romo Escobar
  Fecha: 04/10/2014
  2º DAW Semipresencial
  Descripción: Elemento cabecera de una página web, en donde se podrá establecer el menú
*/
class Header extends Element
{
	
//CONSTRUCTOR/ES
	function __construct()
	{
		$this->setTitle("");
	}
	
//FUNCIONES

	/*Descripción: Genera un menú de n elementos
	  Parámetros: 
	  	- $pintElements: Numero entero, que indica cuantos enlaces consta el menú de la cabecera
	*/
	public function setMenu($pintElements)
	{	
		$fstrContent="";
		for($fintI=0;$fintI<=$pintElements;$fintI++)
			$fstrContent = $fstrContent."&nbsp;Link\n".$fintI;
			
		$this->setContent($fstrContent);
	}
	
	
	
}


?>