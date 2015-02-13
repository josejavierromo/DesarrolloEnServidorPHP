<?php
require_once "Element.php";

/*Autor: José Javier Romo Escobar
  Fecha: 04/10/2014
  2º DAW Semipresencial
  Descripcion: Elemento pie de la página web
*/
class Footer extends Element
{
	
//CONSTRUCTOR/ES

	function __construct()
	{
		$this->setTitle("");
	}
	
//FUNCIONES

	public function setFooter()
	{
		$fstrFooter = "<hr>\n\t<center>Creado por José Romo\t</center>\n</hr>\n";
		$this->setContent($fstrFooter);
	}
	
}



?>