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
											  "url"=>"http://192.168.1.13/html/DAW/PROYECTO06/Index.php?id=1",
											  "visible"=>true),
								"pictures"=>array("txt"=>"Fotos",
												  "url"=>"http://192.168.1.13/html/DAW/PROYECTO06/Index.php?id=2",
												  "visible"=>false),
								"places"=>array("txt"=>"Lugares",
												"url"=>"http://192.168.1.13/html/DAW/PROYECTO06/Index.php?id=3",
												"visible"=>false),
								"contact"=>array("txt"=>"Contactos",
  												 "url"=>"http://192.168.1.13/html/DAW/PROYECTO06/Index.php?id=4",												 												 												 "visible"=>false),
								"profile"=>array("txt"=>"Perfil",
												 "url"=>"http://192.168.1.13/html/DAW/PROYECTO06/Index.php?id=7",
												 "visible"=>false),
								"facebook"=>array("txt"=>"Facebook",
												  "url"=>"http://www.facebok.com",
												  "visible"=>true),
								"twiter"=>array("txt"=>"Twiter",
												"url"=>"http://www.twiter.com",
												"visible"=>true),
								"linkedin"=>array("txt"=>"LinkedIn",
												  "url"=>"http://www.linkedin.com",
												  "visible"=>true),
								"exit"=>array("txt"=>"Salir",
											  "url"=>"http://192.168.1.13/html/DAW/PROYECTO06/Index.php?id=8",
											  "visible"=>false));
	
//CONSTRUCTOR/ES
	function __construct()
	{
		$this->elementType = "header";
		$this->setTitle("");
	}
	
//FUNCIONES

	/*	@autor José Javier Romo Escobar
	 *	@since 25/10/2014
	 *	Genera un menú principal del site
	 */
	public function setMenu()
	{
		$fstrContent = "<nav id=\"menu\" class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">\n";
		$fstrContent = $fstrContent."\t<div class=\"container\">\n";
		$fstrContent = $fstrContent."\t\t<div id=\"navbar\" class=\"collapse navbar-collapse\">\n";
		$fstrContent = $fstrContent."\t\t\t<ul class=\"nav navbar-nav\">\n";
		foreach($this->menuElements as $nameElement => $element)
		{
			if(isset($_SESSION))
			{
				if(isset($_SESSION["login"]))
					$element["visible"] = $_SESSION["login"];
				else
					$element["visible"] = false;
			}
			
			if($element["visible"] == true)
			{
				$fstrContent = $fstrContent."\t\t\t\t<li id=\"$nameElement\">\n";
				$fstrContent = $fstrContent."\t\t\t\t\t<a href=".$element["url"].">".$element["txt"]."</a>\n";
				$fstrContent = $fstrContent."\t\t\t\t</li>\n";
			}
		}
		$fstrContent = $fstrContent."\t\t\t</ul>\n";
		$fstrContent = $fstrContent."\t\t</div>";
		$fstrContent = $fstrContent."\t</div>";
		$fstrContent = $fstrContent."</nav>";
		$this->setContent($fstrContent);
	}
	
	
}


?>