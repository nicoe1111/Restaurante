<?php
require_once("../../../Class/ClassMySql.php");
$acceso = new AccesoMySql();
$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$comidas = $acceso->FiltrarComida($dato);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="150">Nombre</th>
                <th width="350">Descripcion</th>
                <th width="100">Precio</th>
                <th width="150">Tipo</th>
                <th width="100">Imagen</th>
            </tr>';
if(sizeof($comidas) >0){
	foreach ($comidas as $comida){
                echo '<tr>
                        <td>'.$comida['nombre'].'</td>
                        <td>'.$comida['descripcion'].'</td>
                        <td>'.$comida['precio'].'</td>
                        <td>'.$comida['tipo'].'</td>
                        <td>'.$comida['imagen'].'</td>
                        <td><a href="javascript:editarComida('.$comida['id_plato'].');" ><img width="30px" height="30px" src="css/Icono_Editar.png"/></a> <a href="javascript:eliminarComida('.$comida['id_plato'].');"><img width="30px" height="30px" src="css/Icono_Eliminar.jpg"/></a></td>
                    </tr>';   
        }
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
