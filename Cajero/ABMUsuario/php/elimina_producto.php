<?php
require_once("../../../Class/ClassMySql.php");
$acceso = new AccesoMySql();
$cedula = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysql_query("DELETE FROM usuario WHERE cedula = '$cedula'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$acceso2 = new AccesoMySql();
$usuarios = $acceso2->getAllUsers();

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

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