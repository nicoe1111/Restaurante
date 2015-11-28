<?php
require_once("../../Class/ClassMySql.php");
$acceso = new AccesoMySql();
$cedula = $_POST['cedula'];
$proceso = $_POST['pro'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$tipo = $_POST['tipo'];
$pass = $_POST['pass'];
//VERIFICAMOS EL PROCESO
echo "proceso =".$proceso;
switch($proceso){
	case 'Registro':
            $acceso->InsertarUsuario($nombre, $apellido, $cedula, $pass, $tipo);
//		mysql_query("INSERT INTO usuario (cedula, nombre, precio_unit, precio_dist, fecha_reg)VALUES('$cedula','$nombre','$tipo','$precio_uni','$pass', '$fecha')");
	break;
	
	case 'Edicion':
		$acceso->ModificarUsuario($nombre, $apellido, $cedula, $pass, $tipo);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

//$registro = mysql_query("SELECT * FROM productos ORDER BY id_prod ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
$acceso2 = new AccesoMySql();
$usuarios = $acceso2->getAllUsers();
echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="300">Nombre</th>
                <th width="200">Apellido</th>
                <th width="150">Cedula</th>
                <th width="150">Tipo</th>
                <th width="50">Opciones</th>
            </tr>';
	foreach ($usuarios as $usuario){
                echo '<tr>
                        <td>'.$usuario['nombre'].'</td>
                        <td>'.$usuario['apellido'].'</td>
                        <td>'.$usuario['cedula'].'</td>
                        <td>'.$usuario['tipoUser'].'</td>
                        <td><a href="javascript:editarProducto('.$usuario['cedula'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$usuario['cedula'].');" class="glyphicon glyphicon-remove-circle"></a></td>
                    </tr>';   
        }
echo '</table>';
?>