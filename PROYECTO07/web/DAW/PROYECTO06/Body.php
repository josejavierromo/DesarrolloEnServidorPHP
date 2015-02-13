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
		$this->elementType = "body";
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
		$columns = array("IDLugar","Nombre","Poblacion","Provincia","Pais","Fecha","Descripcion");
		$this->getInfo("Destinos",$columns);
		$this->setContent($this->createTablePlaces());
	}
	
	public function getFormPlace($pintDestino)
	{
		$columns = array("Nombre","Poblacion","Provincia","Pais","Fecha","Descripcion");
		$fstrTitleForm = "";
		$nombre = "";
		$poblacion = "";
		$provincia = "";
		$pais = "";
		$fecha = "";
		$descripcion = "";
			
		if($pintDestino != -999)
		{
			$this->connect();
			$fstrTitleForm = "Modificar lugar";
			$this->createQuery("Destinos",$columns);
			$this->cstrSQLQ = $this->cstrSQLQ." WHERE IDLugar=".$pintDestino;
			$this->resultado = $this->mysqli->query($this->cstrSQLQ);
			
			$this->resultado->data_seek(0);
			$fila = $this->resultado->fetch_row();
			$nombre = $fila[0];
			$poblacion = $fila[1];
			$provincia = $fila[2];
			$pais = $fila[3];
			$fecha = $fila[4];
			$descripcion = $fila[5];
		}
		else
			$fstrTitleForm = "Nuevo lugar";
		
		$fstrForm = "<div class=\"container\">\n";
		$fstrForm = $fstrForm."\t<form action=\"".$this->saveContentForm("Destinos",($pintDestino != -999),"Nombre","IDLugar",$pintDestino,"Location:Index.php?id=3",false)."\" method=\"POST\" class=\"form-signin\" role=\"form\">\n";
		$fstrForm = $fstrForm."\t\t<h3 class=\"form-signin-heading\">".$fstrTitleForm."</h3>\n";
		$fstrForm = $fstrForm."\t\t<label for=\"Nombre\" class=\"sr-only\">Nombre</label>\n";
		$fstrForm = $fstrForm."\t\t<input type=\"text\" id=\"Nombre\" name=\"Nombre\" class=\"form-control\" placeholder=\"Lugar\" required autofocus value=\"".$nombre."\">\n";
		$fstrForm = $fstrForm."\t\t<label for=\"Poblacion\" class=\"sr-only\">Población</label>\n";
		$fstrForm = $fstrForm."\t\t<input type=\"text\" id=\"Poblacion\" name=\"Poblacion\" class=\"form-control\" placeholder=\"Población\" required autofocus value=\"".$poblacion."\">\n";
		$fstrForm = $fstrForm."\t\t<label for=\"Provincia\" class=\"sr-only\">Provincia</label>\n";
		$fstrForm = $fstrForm."\t\t<input type=\"text\" id=\"Provincia\" name=\"Provincia\" class=\"form-control\" placeholder=\"Provincia\" required autofocus value=\"".$provincia."\">\n";
		$fstrForm = $fstrForm."\t\t<label for=\"Pais\" class=\"sr-only\">Pais</label>\n";
		$fstrForm = $fstrForm."\t\t<input type=\"text\" id=\"Pais\" name=\"Pais\" class=\"form-control\" placeholder=\"Pais\" required autofocus value=\"".$pais."\">\n";
		$fstrForm = $fstrForm."\t\t<label for=\"Fecha\" class=\"sr-only\">Fecha</label>\n";
		$fstrForm = $fstrForm."\t\t<input type=\"date\" id=\"Fecha\" name=\"Fecha\" class=\"form-control\" placeholder=\"Fecha\" required autofocus value=\"".$fecha."\">\n";
		$fstrForm = $fstrForm."\t\t<label for=\"Descripcion\" class=\"sr-only\">Descripción</label>\n";
		$fstrForm = $fstrForm."\t\t<input type=\"text\" id=\"Descripcion\" name=\"Descripcion\" class=\"form-control\" placeholder=\"Descripción\" required autofocus value=\"".$descripcion."\">\n";
		$fstrForm = $fstrForm."\t\t<button class=\"btn btn-lg \" type=\"submit\">Guardar</button>\n";
		$fstrForm = $fstrForm."\t\t<button class=\"btn btn-lg \" type=\"reset\">Cancelar</button>\n";
		$fstrForm = $fstrForm."\t</form>";
		$fstrForm = $fstrForm."</div> <!-- /container -->";
		
		$this->setContent($fstrForm);
	}

	/*	@autor José Javier Romo Escobar
	 *	@since 10/12/2014
	 *	
	 *	Genera el formulario para mostrar la información del perfil de usuario
	 */		
	public function getFormProfile()
	{			
		$fstrForm = "<div class=\"container\">\n";
		$fstrForm = $fstrForm."\t<form class=\"form-signin\" role=\"form\" action=\"".$this->saveContentForm("Usuarios",($_SESSION["IdUsuario"]!=0),"Nombre","IDUsuario",$_SESSION["IdUsuario"],"Location:Index.php?id=7",true)."\" method=\"post\" enctype=\"multipart/form-data\">";
		$fstrForm = $fstrForm."<label for=\"foto\" class=\"sr-only\"></label>";
		$fstrForm = $fstrForm."<img id=\"foto\" class=\"form-control\" name=\"foto\" src=\"img/".$_SESSION["UserPicture"]."\"";
		$fstrForm = $fstrForm."<label for=\"Imagen\" class=\"sr-only\"></label>";
		$fstrForm = $fstrForm."<input class=\"file\" type=\"file\" name=\"Imagen\" id=\"Imagen\"></input>";
		$fstrForm = $fstrForm."\t\t<label for=\"Nombre\" class=\"sr-only\">Nombre</label>\n";
		$fstrForm = $fstrForm."\t\t<input type=\"text\" id=\"Nombre\" name=\"Nombre\" class=\"form-control\" placeholder=\"Nombre\" required autofocus value=\"".$_SESSION["UserName"]."\">\n";
		$fstrForm = $fstrForm."<button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\">Enviar</button>";
		$fstrForm = $fstrForm."</form>";
		$fstrForm = $fstrForm."</div> <!-- /container -->";
		
		$this->setContent($fstrForm);
	}
	
	/*	@autor José Javier Romo Escobar
	 *	@since 25/11/2014
	 *	
	 *	Guarda el contenido del formulario enviado mediante POST
	 */	
	private function saveContentForm($pstrTable,$pbolUpdate,$pstrField,$pstrIdField,$pintIdValue,$pstrLocation,$pbolWithFiles)
	{
		if($pbolUpdate)
		{
			if(isset($_POST[$pstrField]))
			{
				echo("Modificando");
				$this->updateInfo($pstrTable,array_keys($_POST), array_values($_POST)," WHERE ".$pstrIdField." = ".$pintIdValue);
				header($pstrLocation);
			}
		
			if($pbolWithFiles)
				if(isset($_FILES[$pstrField]))
					move_uploaded_file($_FILES[$pstrField]["tmp_name"], "img/".$_FILES[$pstrField]["name"]);
		}
		else
		{
			if(isset($_POST[$pstrField]))
			{
				$this->setInfo($pstrTable,array_keys($_POST), array_values($_POST));
				header($pstrLocation);
			}
		}
		
	}
	
	/*	@autor José Javier Romo Escobar
	 *	@since 25/11/2014
	 *	
	 *	Genera la tabla html donde se mostrará la información de la consulta SELECT
	 */
	private function createTablePlaces()
	{
		$fintIndex = 0;
		
		
		$fstrTable = "<div class=\"table-responsive\">\n";
		$fstrTable = $fstrTable."\t<table class=\"table table-striped\">\n";
		$fstrTable = $fstrTable."\t\t<thead>\n";
		//Abre la fila de cabecera
		$fstrTable = $fstrTable."\t\t\t<tr>\n";
		$fields = $this->resultado->fetch_fields();
		foreach($fields as $column)
			$fstrTable = $fstrTable."\t\t\t\t<th>".$column->name."</th>\n";
		
		$fstrTable = $fstrTable."\t\t\t</tr>\n";
		$fstrTable = $fstrTable."\t\t</thead>\n";
		$fstrTable = $fstrTable."\t\t<tbody>\n";
		for($i=0;$i< $this->resultado->num_rows; $i++)
		{
			$this->resultado->data_seek($i);
			$fila = $this->resultado->fetch_row();
			$fstrTable = $fstrTable."\t\t\t<tr>";
			foreach($fields as $column)
			{
				$fstrTable = $fstrTable."\t\t\t\t<td><a href=\"http://192.168.1.13/html/DAW/PROYECTO06/Index.php?id=5&amp;iddestino=".$fila[0]."\">".$fila[$fintIndex]."</a></td>\n";
				$fintIndex += 1;
			}
			$fintIndex = 0;
			$fstrTable = $fstrTable."\t\t\t</tr>";			
			
		}
		$fstrTable = $fstrTable."\t\t\t</tbody>\n";
		$fstrTable = $fstrTable."\t\t\t<tfoot>\n";
		$fstrTable = $fstrTable."\t\t\t\t<tr>\n";
		$fstrTable = $fstrTable."\t\t\t\t\t<th><a href=\"http://192.168.1.13/html/DAW/PROYECTO06/Index.php?id=6\">Añadir nuevo lugar</a></th>\n";
		$fstrTable = $fstrTable."\t\t\t\t</tr>\n";
		$fstrTable = $fstrTable."\t\t\t</tfoot>\n";
		$fstrTable = $fstrTable."</table>";
		$fstrTable = $fstrTable."</div>";

		$this->resultado->free();
		return $fstrTable;
	}
	
	public function closeSession()
	{
		$this->exitLogin();
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