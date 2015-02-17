<?php

require_once "Element.php";

/*	@Autor José Javier Romo Escobar (2º DAW Semipresencial)
 *	@since 04/10/2014
 *	Elemento cabecera de una página web, en donde se podrá establecer el menú
*/
class Header extends Element
{
	/*Arreglo de arrays que especifican los elementos del menú principal del site*/
	private $menuElements=array("home"=>array("txt"=>"Inicio",
											  "url"=>"http://192.168.1.52/DAW/PROYECTO04/Index.php"),
								"pictures"=>array("txt"=>"Fotos",
												  "url"=>"http://192.168.1.52/DAW/PROYECTO04/Pictures.php"),
								"places"=>array("txt"=>"Lugares",
												"url"=>"http://192.168.1.52/DAW/PROYECTO04/Places.php"),
								"contact"=>array("txt"=>"Contactos",
												 "url"=>"http://192.168.1.52/DAW/PROYECTO04/Contact.php"),
								"facebook"=>array("txt"=>"Facebook",
												  "url"=>"http://www.facebok.com"),
								"twiter"=>array("txt"=>"Twiter",
												"url"=>"http://www.twiter.com"),
								"linkedin"=>array("txt"=>"LinkedIn",
												  "url"=>"http://www.linkedin.com"));
	
//CONSTRUCTOR/ES
	function __construct()
	{
		$this->setTitle("");
	}
	
//FUNCIONES

	/*	@autor José Javier Romo Escobar
	 *	@since 25/10/2014
	 *	Genera un menú principal del site
	 */
	public function setMenu()
	{
		$fstrContent = "<div id=\"menu\">\n";
		$fstrContent = $fstrContent."\t<ul id=\"nav\">\n";
		foreach($this->menuElements as $nameElement => $element)
		{
			$fstrContent = $fstrContent."\t\t<li id=\"$nameElement\">\n";
			$fstrContent = $fstrContent."\t\t\t<a href=".$element["url"].">".$element["txt"]."</a>\n";
			$fstrContent = $fstrContent."\t\t</li>\n";
		}
		$fstrContent = $fstrContent."\t</ul>\n";
		$fstrContent = $fstrContent."</div>";
		$this->setContent($fstrContent);
	}
	
	
}


?>