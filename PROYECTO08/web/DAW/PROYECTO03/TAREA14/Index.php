<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<?php 

//Definiendo un array

//A lo burro
$ciudades[] = "valencia";
$ciudades[] = "sevilla";
$ciudades[] = "barcelona";


//Ordenado 
$ciudades[1] = "valencia";
$ciudades[2] = "sevilla";
$ciudades[3] = "barcelona";

//Con la función array
$comunidades[] = array("Comunidad Valenciana", "Cataluña", "Madrid");

//Se muestra
foreach($ciudades as $nombre)
	echo ("El valor de la ciudad es $nombre <br>");

//Con indices
$capitales = array("España"=>"Madrid","Francia"=>"Paris","Italia"=>"Roma");

foreach($capitales as $indice => $valor)
	echo ("La capital de $indice es $valor<br>");

//Multidimensional
$comunidades = array("Cataluña"=>array("Tarragona","Lerida","Gerona","Barcelona"),
					 "Comunidad Valenciana"=>array("Alicante","Castellón","Valencia"));
					 
foreach($comunidades as $indice => $valor)
	foreach($valor as $provincia)
		echo ("Una provincia de $indice es $provincia<br>");

?>
<body>
</body>
</html>