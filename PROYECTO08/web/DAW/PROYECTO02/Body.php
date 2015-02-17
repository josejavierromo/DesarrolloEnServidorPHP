<?php
require_once "Element.php";

/*Autor: José Javier Romo Escobar
  04/10/2014
  2º DAW Semipresencial
  Descripción: Elemento cuerpo de la página, que creará una tabla
*/
class Body extends Element
{
//CONSTRUCTOR/ES

	function __construct($pstrTitle)
	{
		$this->setTitle($pstrTitle);
	}
	
//FUNCIONES

	/*Descripcion: Genera una tabla HTML
	  Parámetros:
	  		- pintRows: Número entero, que indica el número de líneas de la tabla
			- pintColuns: Número entero, que indica el número de columnas de la tabla
	*/
	public function setTable($pintRows, $pintColumns)
	{
		$fstrTable = "<table>\n";
		$fstrFileName = "";
		$fintCount = 1;
		
		for($fintI=1;$fintI<=$pintRows;$fintI++)
		{
			$fstrTable = $fstrTable."\t<tr>\n";
			
			for($fintJ=1;$fintJ<=$pintColumns;$fintJ++)
			{
				//Monta el nombre de la imagen a mostrar
				$fstrFileName = sprintf("img/foto_0%d.jpg",$fintCount);
				//Comprueba si existe el fichero, para crear la celda que la contendrá
				if(file_exists($fstrFileName)){
					$fstrTable = $fstrTable."\t\t<td>\n";
					$fstrTable = $fstrTable."\t\t<!-- Celda de la imagen ".($fintCount)."-->\n";
					$fstrTable = $fstrTable."\t\t\t<a href='".$fstrFileName."' rel='lightbox'>\n";
					$fstrTable = $fstrTable."\t\t\t\t<img  src='".$fstrFileName."' alt='".$fintCount."' width='150px' height='150px'/>\n";
					$fstrTable = $fstrTable."\t\t\t</a>\n";
					$fstrTable = $fstrTable."\t\t</td>\n";
					$fintCount++;
				}
			}
			$fstrTable = $fstrTable."\t</tr>\n";
		}
		$fstrTable = $fstrTable."</table>\n";
		$this->setContent($fstrTable);
	}

}

?>