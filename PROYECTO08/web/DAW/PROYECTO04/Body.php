<?php
require_once "Element.php";

/*	@autor José Javier Romo Escobar (2º DAW Semipresencial)
 *	@since 04/10/2014
 * 
 *	Elemento cuerpo de la página, que creará una tabla
 */
class Body extends Element
{
//CONSTRUCTOR/ES

	function __construct($pstrTitle)
	{
		$this->setTitle($pstrTitle);
	}
	
//FUNCIONES

	/*	@autor José Javier Romo Escobar (2º DAW Semipresencial)
	 *	@since 04/10/2014
	 *
	 *  Genera una tabla HTML
	 *  @param integer pintRows Número entero, que indica el número de líneas de la tabla
	 *	@param integer pintColuns Número entero, que indica el número de columnas de la tabla
	*/
	public function setPicturesTable($pintRows, $pintColumns)
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
	/* @autor José Javier Romo Escobar 
	 * @since 06/11/2014
	 *
	 * Devuelve una tabla Html con la información de lugares, almacenados en la base de datos
	*/
	public function getTablePlaces()
	{
		$this->cobjDb = new db("localhost","root","win1201.F","Viajes");
		$this->cobjDb->connect();
		$this->setContent($this->cobjDb->getInfo("Lugares"));
	}
	
	/*	@autor José Javier Romo Escobar (2º DAW Semipresencial)
	 *	@since 25/10/2014
	 *
	 *  Función que añade un texto simple en la página
	 *	@param string $pstrContent Texto a mostrar en la página
	 */
	public function setSimpleContent($pstrContent)
	{
		$this->setContent($pstrContent);
	}
}

?>