<?php
require_once "Header.php";
require_once "Body.php";
require_once "Footer.php";


/*	@autor José Javier Romo Escobar (2º DAW Semipresencial)
 *	@since 04/10/2014
 *	Representa una página web con todos sus elementos
*/
class Page
{
//VARIABLES PÚBLICAS
	public $header, $body, $footer;
	
//CONSTRUCTOR/ES

	function __construct($pstrTitle)
	{
		if(!isset($_COOKIE["loginError"]))
			setcookie("loginError",0,time()+60);
			
		$this->header = new Header();
		$this->body = new Body($pstrTitle);
		$this->footer = new Footer();

		$this->header->setMenu();
		$this->footer->setFooter();
		
	}
	
//FUNCIONES
	/*	@autor José Javier Romo Escobar
	 *	@since 04/10/2014
	 *	Obtiene la estructura de la página con todos sus elementos básicos
	*/
	public function getPage()
	{
		echo $this->header.$this->body.$this->footer;
	}
	
}



?>