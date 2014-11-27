<?php
require_once "Element.php";

/*	@Autor José Javier Romo Escobar (2º DAW Semipresencial)
 *	@since 04/10/2014
 *	Elemento pie de la página web
 */
class Footer extends Element
{
	
//CONSTRUCTOR/ES

	function __construct()
	{
		$this->setTitle("");
	}
	
//FUNCIONES
	/*	@autor José Javier Romo Escobar (2º DAW Semipresencial)
	 *	@since 04/10/2014
	 *	Devuelve el elemento Html que representa el pie de la página
	 */
	public function setFooter()
	{
		$fstrFooter = "<hr>\n\t<center>Creado por José Romo\t</center>\n</hr>\n";
		$this->setContent($fstrFooter);
	}
	
}



?>