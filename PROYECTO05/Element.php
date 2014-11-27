<?php
require_once "db.php";

/*@Autor José Javier Romo Escobar (2º DAW Semipresencial)
  @since 04/10/2014
  Clase que representa un elemento dentro de una página web.
  @example Un elemento header, body, footer
*/
class Element extends db
{
//VARIABLES PRIVADAS
	//Título del elemento
	private $cstrTitle;
	//Contenido del elemento
	private $cstrContent;
	//Tipo de elemento (header, body o footer)
	protected $elementType;

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
		if($this->elementType == "body")
			if($this->checkSession() == true)
				$this->cstrTitle = "<h3>".$pstrTitle."</h3>";
			else
				$this->cstrTitle = "";
		else
			$this->cstrTitle = "<h3>".$pstrTitle."</h3>";
	}
	
	/* @autor José Javier Romo Escobar
	   @since 04/10/2014
       Establece el contenido del elemento, para el elemento body comprueba además que se haya autenticado el usuario
	*/
	protected function setContent($pstrContent)
	{
		if($this->elementType == "body")
		{
			if($this->checkSession()== true)
				$this->cstrContent = $this->cstrContent."\n".$pstrContent;
			else
				$this->getLoginForm();
		}
		else
			$this->cstrContent = $pstrContent;
	}
	
	/* @autor José Javier Romo Escobar
	   @since 04/10/2014
       Vacia la variable contenido del elemento
	*/
	protected function resetContent()
	{
		$this->cstrContent = "";
	}
	
	/*	@autor José Javier Romo Escobar
	 *	@since 25/11/2014
	 *	Comprueba si el objeto sesión ha sido instanciado y autentificado
	 */
	protected function checkSession()
	{
		if(!isset($_SESSION))
			session_start();
		
		if(isset($_SESSION))
			if(isset($_SESSION["login"]))
			{
				if($_SESSION["login"] == "false")
					return false;
				else
					return true;
			}
			else
				return false;
		else
			return false;
	}
	
	
	/*	@autor José Javier Romo Escobar (2º DAW Semipresencial)
	 *	@since 25/11/2014
	 *	
	 *	Función que genera el formulario de Login del site
	 */
	private function getLoginForm()
	{
		$fstrForm = "<div class=\"container\">\n";
		$fstrForm = $fstrForm."\t<form action=\"Session.php\" method=\"POST\" class=\"form-signin\" role=\"form\">\n";
		$fstrForm = $fstrForm."\t\t<h2 class=\"form-signin-heading\">Por favor inicia sesión</h2>\n";
		$fstrForm = $fstrForm."\t\t<label for=\"inputUser\" class=\"sr-only\">Usuario</label>\n";
		$fstrForm = $fstrForm."\t\t<input type=\"text\" id=\"inputUser\" name=\"inputUser\" class=\"form-control\" placeholder=\"Usuario\" required autofocus>\n";
		$fstrForm = $fstrForm."\t\t<label for=\"inputPassword\" class=\"sr-only\">Contraseña</label>\n";
		$fstrForm = $fstrForm."\t\t<input type=\"password\" id=\"inputPassword\" name=\"inputPassword\" class=\"form-control\" placeholder=\"Contraseña\" required>\n";
		$fstrForm = $fstrForm."\t\t<button class=\"btn btn-lg btn-block\" type=\"submit\">Inicio</button>\n";
		$fstrForm = $fstrForm."\t</form>";
		$fstrForm = $fstrForm."</div> <!-- /container -->";
		
		$this->cstrContent = $fstrForm;
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