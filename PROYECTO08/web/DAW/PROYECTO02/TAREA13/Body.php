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

	function __construct()
	{
		$this->setTitle("TABLE");
	}
	
//FUNCIONES

	/*Descripcion: Genera una tabla HTML
	  Parámetros:
	  		- pintRows: Número entero, que indica el número de líneas de la tabla
			- pintColuns: Número entero, que indica el número de columnas de la tabla
	*/
	public function setTable($pintRows, $pintColumns)
	{
		$fstrTable = "<table>";
		$fintCount = 1;
		
		for($fintI=0;$fintI<=$pintRows;$fintI++)
		{
			$fstrTable = $fstrTable."\t<tr>\n";
			
			for($fintJ=0;$fintJ<=$pintColumns;$fintJ++)
				$fstrTable = $fstrTable."\t\t<td>\n".$fintCount++."</td>\n";
				
			$fstrTable = $fstrTable."\t</tr>";
		}
		$fstrTable = $fstrTable."</table>\n";
		$this->setContent($fstrTable);
	}

}

?>