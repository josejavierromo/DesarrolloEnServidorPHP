<?php
/*@Autor José Javier Romo Escobar (2º DAW Semipresencial)
  @since 04/10/2014
  Clase que representa un elemento dentro de una página web.
  @example Un elemento header, body, footer
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

	/* @autor José Javier Romo Escobar
	   @since 04/10/2014
       Devuelve el título del elemento 
	*/
	protected function getTitle()
	{
		return $this->cstrTitle;
	}

	/* @autor José Javier Romo Escobar
	   @since 04/10/2014
       Devuelve el contenido del elemento
	*/
	protected function getContent()
	{
		return $this->cstrContent;
	}
	
	/* @autor José Javier Romo Escobar
	   @since 04/10/2014
	   Establece el título del elemento
	*/
	protected function setTitle($pstrTitle)
	{
		$this->cstrTitle = "<h3>".$pstrTitle."</h3>";
	}
	
	/* @autor José Javier Romo Escobar
	   @since 04/10/2014
       Establece el contenido del elemento
	*/
	protected function setContent($pstrContent)
	{
		$this->cstrContent = $pstrContent;
	}
	
	/* @autor José Javier Romo Escobar
	   @since 04/10/2014
	   Devuelve todo el contenido del elemento, en una cadena de texto
	*/
	public function __toString()
	{
		return "\n<br>\n".$this->cstrTitle."<br>\n".$this->cstrContent;
	}
	
}
?>