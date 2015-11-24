<?php
    require_once("Class/ClassMySql.php");

    extract($_POST);


    if(isset($_POST['registrarUser'])){

        $Nombre = $_POST['Nombre'];
        $Apellido = $_POST['Apellido'];
        $Cedula = $_POST['Cedula'];
        $Contrasenia = $_POST['Contrasenia'];
        $Tipo = $_POST['Tipo'];

        $acceso = new AccesoMySql();
        $return = $acceso->InsertarUsuario($Nombre, $Apellido, $Cedula, $Contrasenia, $Tipo);

    }
	
?>

