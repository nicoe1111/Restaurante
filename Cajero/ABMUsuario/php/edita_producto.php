<?php
require_once("../../../Class/ClassMySql.php");
$acceso = new AccesoMySql();

$cedula = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysql_query("SELECT * FROM usuario WHERE cedula = '$cedula'");
$valores2 = mysql_fetch_array($valores);

$datos = array(
				0 => $valores2['nombre'], 
				1 => $valores2['apellido'], 
				2 => $valores2['tipoUser'], 
				3 => md5($valores2['pass']),
				);
echo json_encode($datos);
?>