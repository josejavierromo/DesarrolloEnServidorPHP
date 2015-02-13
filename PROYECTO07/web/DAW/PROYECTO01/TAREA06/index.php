<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
//Declaración de variables globales

//Tipos de variables
//Variables enteras
$numero = 1;
$Numero = 2;
$NUMERO = 3;
$numero_negativo = -4;

//Variables en coma flotante
$decimal = 1.1785;

//Varaibles String
$cadena = "Esto es un ejemplo de cadena de texto";

//Variables boleanas
$verdadero = TRUE;

//Constantes
define("PI",3.14);

?>


<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento explicativo de variables PHP5</title>
</head>

<body>
	<?php
	//Impresión de los valores de las variables globales del documento
		echo "<h1>Variables Integer</h1>";
		echo "La variable 'numero' tiene un valor de: $numero";
		echo "<br>La variable 'Numero' tiene un valor de: $Numero";
		echo "<br>La variable 'NUMERO' tiene un valor de: $NUMERO";
		echo "<br>La variable 'numero_negativo' tiene un valor de: $numero";
		
		echo "<h1>Variables Coma flotante</h1>";
		echo "La variable 'decimal' tiene un valor de: $decimal";
		
		echo "<h1>Variables de Texto</h1>";
		echo "La variable 'cadena' tiene un valor de: $cadena";
		
		echo "<h1>Variables Boolean</h1>";
		echo "La variable 'verdadero' tiene un valor de: $verdadero";
		
		echo "<h1>Constantes</h1>";
		echo "La constante 'PI' tiene un valor de: ".PI."<br>";
	?>
</body>
</html>