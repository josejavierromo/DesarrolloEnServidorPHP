<?php

class layout
{
	public $titulo = "TITULO DE LA PÁGINA";
	private $server;
	
	function __construct()
	{
		$this->server = $_SERVER['HTTP_USER_AGENT'];
	}
	
	function getTitulo()
	{
		return $this->titulo;
	}
	
	function getHttpAgentVersion()
	{
		return $this->server;
	}
	
}

?>