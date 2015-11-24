<?php
require_once("Class/ClassMySql.php");	
	session_start();	
	extract($_POST);
	extract($_GET);

if(isset($_POST['enviar'])){
	
		$usuario = $_POST['usuario'];
		$clave = $_POST['clave'];
		
		$exist = false;
		$acceso = new AccesoMySql();
		$exist = $acceso->validarUsuario($usuario, $clave);
	
	if ($exist != ""){
		$_SESSION["usuario"] = $usuario;
		$_SESSION["clave"] = $clave;
		$_SESSION["loged"] = $exist;
		$_SESSION["id"] = $exist["Id"];
		header ("location: index.php?tipo=".$_SESSION["loged"]."&user=".$_SESSION["usuario"]);
		exit();
	}
}
if(isset($_GET['logout'])){
$loged = $_GET['logout'];
	$_SESSION['logout'] = 1;	

	if ($_SESSION['logout']==1) {		
			session_unset();
			session_destroy();
			header("Location: index.php");
			exit();
		}
}
?>