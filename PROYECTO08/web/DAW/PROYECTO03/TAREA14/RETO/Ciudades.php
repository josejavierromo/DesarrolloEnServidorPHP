<?php
class Ciudades
{
	private $ciudades;
	private $lista="";
	
	function __construct()
	{
		$this->ciudades = array("Comunidad Valenciana"=>array("Alicante"=>"Alicante","Valencia"=>"Valencia","Castellon"=>"Castellón"),
								"Cataluña"=>array("Tarragona"=>"Tarragona","Lerida"=>"Lleida","Barcelona"=>"Barcelona","Gerona"=>"Gerona"),
								"Andalucia"=>array("Sevilla"=>"Sevilla","Malaga"=>"Málaga","Jaen"=>"Jaén","Granada"=>"Granada","Almeria"=>"Almería","Cadiz"=>"Cádiz"));
	}
	
	//Imprime el array de comunidades en formato de lista de html
	public function imprimirComunidades()
	{
		//Abre la lista
		$this->lista = "<ul id='Comunidades'>\n";
		//Recorre el array
		foreach($this->ciudades as $indice => $comunidad)
		{
			//Escribe el elemetno de la lista
			$this->lista = $this->lista."\t<li>$indice</li>\n";
			$this->devuelveProvincias($indice);
		}
		$this->lista = $this->lista."</ul>";
		echo $this->lista;
		$this->lista = "";
	}
	
	//Devuelve las provincias de la comunidad indicada
	public function devuelveProvincias($comunidad)
	{
		
		//Abre una lista nueva para mostrar las provincias
		$this->lista = $this->lista."\t\t<ul id='ciudades'>\n";
		
		foreach($this->ciudades[$comunidad] as $indice=>$capital)
		{
			//Escribe el nodo de la provincia
			$this->lista = $this->lista."\t\t\t<li>$indice<li>\n";
			$this->devuelveCapital($comunidad,$indice);
		}
		$this->lista = $this->lista."\t\t</ul>\n";
	}
	
	//Devuelve la capital de la provincia y comunidad indicadas
	public function devuelveCapital($comunidad, $provincia)
	{
		//Escribe una nueva lista para mostrar las capitales
		$this->lista = $this->lista."\t\t\t\t<ul id='capitales'>\n";
		$this->lista = $this->lista."\t\t\t\t\t<li>".$this->ciudades[$comunidad][$provincia]."</li>\n";
		$this->lista = $this->lista."\t\t\t\t</ul>\n";
	}
	
	
}
?>