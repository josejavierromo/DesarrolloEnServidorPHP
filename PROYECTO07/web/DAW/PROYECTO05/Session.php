<?php
if($_POST["inputUser"] == "jose" && $_POST["inputPassword"] == "admin123")
{
	session_start();
	$_SESSION["login"] = "true";
	$_SESSION["user"] = "José Javier";
	
	header("Location:Index.php?id=1");
}
else
{
	header("Location:Index.php?id=-1&amp;errorlogin");
}

?>