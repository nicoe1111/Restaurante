<?php
require_once("../../Class/ClassMySql.php");
$acceso = new AccesoMySql();
$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$usuarios = $acceso->FiltrarUsuario($dato);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="300">Nombre</th>
                <th width="200">Apellido</th>
                <th width="150">Cedula</th>
                <th width="150">Tipo</th>
                <th width="50">Opciones</th>
            </tr>';
if(sizeof($usuarios) >0){
	foreach ($usuarios as $usuario){
                echo '<tr>
                        <td>'.$usuario['nombre'].'</td>
                        <td>'.$usuario['apellido'].'</td>
                        <td>'.$usuario['cedula'].'</td>
                        <td>'.$usuario['tipoUser'].'</td>
                        <td><a href="javascript:editarProducto('.$usuario['cedula'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$usuario['cedula'].');" class="glyphicon glyphicon-remove-circle"></a></td>
                    </tr>';   
        }
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>