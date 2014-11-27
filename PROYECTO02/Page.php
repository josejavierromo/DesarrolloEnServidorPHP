<?php
require_once "Header.php";
require_once "Body.php";
require_once "Footer.php";


/*Autor: José Javier Romo Escobar
  Fecha: 04/10/2014
  2º DAW Semipresencial
  Descripcion: Representa una página web con todos sus elementos
*/
class Page
{
//VARIABLES PÚBLICAS
	private $title = "TÍTULO DE LA PÁGINA";
	private $header, $body, $footer;
	
//CONSTRUCTOR/ES

	function __construct($pintRows, $pintColumns)
	{
		$this->header = new Header();
		$this->body = new Body("Fotografías");
		$this->footer = new Footer();

		$this->header->setMenu(6);
		$this->body->setTable($pintRows,$pintColumns);
		$this->footer->setFooter();
	}
	
//FUNCIONES

	public function getPage()
	{
		echo $this->header.$this->body.$this->footer;
	}
	
}



?>