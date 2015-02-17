<!DOCTYPE html>
<html>
<?php
	include "Page.php";
?>
<head>
<title>Proyecto 6</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/signing.css" rel="stylesheet">
<script type="text/javascript" src="js/lightbox.js"></script>
</head>
<body>

<?php
	if(isset($_GET["id"]))
	{

		switch($_GET["id"])
		{
			case 1: //Inicio
				$page = new Page("Inicio");
				if(isset($_SESSION["UserName"]))
					$page->body->setSimpleContent("Bienvenido, ".$_SESSION["UserName"]);
				else
					$page->body->setSimpleContent("");
				break;
			case 2://Fotos
				$page = new Page("Fotos");
				$page->body->setPicturesTable(3,3);
				break;
			case 3://Lugares
				$page = new Page("Lugares");
				$page->body->getTablePlaces();
				break;
			case 4://Contactos
					$page = new Page("Contacto");
				$page->body->setSimpleContent("Envía un email a <a href=\"mailto:jose.romoe@gmail.com\">jose.romoe@gmail.com</a>");
				break;
			case 5://Modificación de lugar
				$page = new Page("");
				if(isset($_GET["iddestino"]))
					$page->body->getFormPlace($_GET["iddestino"]);
				else
					$page->body->setSimpleContent("");
				break;
			case 6://Inserción de lugar
				$page = new Page("");
				$page->body->getFormPlace(-999);
				break;
			case 7://Formulario del perfil
				$page = new Page("Perfil");
				$page->body->getFormProfile();
				break;
			case 8:
				$page = new Page("");
				$page->body->closeSession();
				break;
			default:
				$page = new Page("");
				if(isset($_GET["errorlogin"]))
				{
					$page->body->setSimpleContent("Contraseña o usuario incorrectos");
				}
				else
					header("Location:Index.php?id=1");
				break;
		}
		$page->getPage();
	}
	else
		header("Location:Index.php?id=1");
		
?>

</body>
</html>