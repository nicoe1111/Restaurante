<?php
require_once("../../../Class/ClassMySql.php");
$acceso = new AccesoMySql();

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysql_query("SELECT * FROM plato WHERE id_plato = '$id'");
$valores2 = mysql_fetch_array($valores);

$datos = array(
                0 => $valores2['nombre'], 
                1 => $valores2['descripcion'], 
                2 => $valores2['precio'], 
                3 => $valores2['tipo'],
                4 => $valores2['imagen'],
                );
        echo json_encode($datos);
?>