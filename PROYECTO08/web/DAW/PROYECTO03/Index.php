<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	include "Page.php";
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Proyecto 3</title>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/lightbox.js"></script>
</head>
<body>

<?php
	$page = new Page("Inicio");
	$page->body->setSimpleContent("Página de inicio del site de viajes");
	$page->getPage();
?>

</body>
</html>