<?php
//Autor: José Javier Romo Escobar
//Curso: 2º DAW Semipresencial
//Descripcion: Página correspondiente al Proyecto01 (Index.php), en la que se muestran imagenes en una tabla HTML, mediante código PHP.
//Fecha: 14/09/2014 21:19
 ?>
 <!--
 Autor: José Javier Romo Escobar
 Curso: 2º DAW Semipresencial
 Descripcion: Página correspondiente al Proyecto01 (Index.php), en la que se muestran imagenes en una tabla HTML, mediante código PHP.
 Fecha: 14/09/2014 -->
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Proyecto 1</title>
<link rel="stylesheet" href="lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="lightbox.js"></script>
</head>
<?php 
//VARIABLES GLOBALES DEL DOCUMENTO
//Ejemplo: g-> Tipo de acceso (global o local); int-> tipo de variable; Images-> nombre de la variable. gintImages.

//Indica el índice de imágenes
$gintImages = 0;
//Indica el número total de imágenes a mostrar
$gintTotalImages = 4;
//Nombre del fichero de la imagen en el servidor
$gstrFileName = "foto_0%d.jpg";
?>


<body>
<!-- Tabla contenedora de las imagenes a mostrar -->
<table cellpadding="0" cellspacing="0">
<?php
	//Abrimos una nueva fila
	echo "<tr>\n"; 
	for($gintImages=0; $gintImages<$gintTotalImages;$gintImages++)
	{		
		//Abre la celda
		echo "\t<td>\n";
		echo "\t<!-- Celda de la imagen ".($gintImages + 1)."-->\n";
		//Abre primero el hipervínculo, para que la imagen también sirva como enlace
		echo "\t\t<a href='".sprintf($gstrFileName,$gintImages+1)."' rel='lightbox'>\n";
		//Escribe la etiqueta de la imagen. (Se utiliza sprintf para actualizar el valor del nombre del fichero)
		echo "\t\t\t<img  src='".sprintf($gstrFileName,$gintImages+1)."' alt='".sprintf($gstrFileName,$gintImages+1)."' width='200px' height='200px'/>\n";
		echo "\t\t</a>\n";
		echo "\t\t<div id='caption'>\n";
		echo "\t\t\t<a href='".sprintf($gstrFileName,$gintImages+1)."' rel='lightbox'>";
		//Escribe el texto para mostrar el enlace al usuario
		echo str_replace(".jpg","",sprintf($gstrFileName,$gintImages+1));
		//Escribe el cierre del hipervínculo
		echo "</a>\n";
		echo "\t\t</div>\n";
		//Cierra la celda
		echo "\t</td>\n";
		//Cada 2 imagenes se cambia de línea
		if($gintImages%2==1 && $gintImages+1<$gintTotalImages)
		{
			echo "<!-- Cerramos la fila y abrimos una nueva-->\n";
			echo "</tr>\n";
			echo "<tr>\n";
		}
		//Detecta que es la última fila de la tabla, por lo tanto no abre una nueva fila
		elseif($gintImages+1==$gintTotalImages)
		{
			echo "<!-- Cerramos la última fila de la tabla -->\n";
			echo "</tr>\n";
		}
	}
?>
</table>
</body>
</html>