<?php
/*Autor: José Javier Romo Escobar
  Fecha: 04/10/2014
  2º DAW Semipresencial
  Descripción: Clase que representa un elemento dentro de una página web.
  			   Por ejemplo, un elemento header, body, footer
*/
class Element
{
//VARIABLES PRIVADAS
	//Título del elemento
	private $cstrTitle;
	//Contenido del elemento
	private $cstrContent;

//CONTRUCTOR/ES
	//Constructor de la clase
	function __construct()
	{
		$this->cstrTitle="";
	}
	
	
//FUNCIONES DE LA CLASE

	//Devuelve el título del elemento
	protected function getTitle()
	{
		return $this->cstrTitle;
	}

	//Devuelve el contenido del elemento
	protected function getContent()
	{
		return $this->cstrContent;
	}
	
	//Establece el título del elemento
	protected function setTitle($pstrTitle)
	{
		$this->cstrTitle = $pstrTitle;
	}
	
	//Establece el contenido del elemento
	protected function setContent($pstrContent)
	{
		$this->cstrContent = $pstrContent;
	}
	
	//Devuelve todo el contenido del elemento, en una cadena de texto
	public function __toString()
	{
		return "<br>".$this->cstrTitle."<br>".$this->cstrContent;
	}
	
}
?>