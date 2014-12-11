<?php
require_once "db.php";


$conexion = new db();

if($conexion->login($_POST["inputUser"],md5($_POST["inputPassword"])))
{
	session_start();
	$_SESSION["login"] = "true";
	header("Location:Index.php?id=1");
}
else
{
	header("Location:Index.php?id=-1&amp;errorlogin");
	if(!isset($_COOKIE["loginError"]))
		setcookie("loginError",1,time()+60);
	else
		setcookie("loginError",$_COOKIE["loginError"] + 1,time()+60);
}
?>