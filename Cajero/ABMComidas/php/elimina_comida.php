<?php
require_once("../../../Class/ClassMySql.php");
$acceso = new AccesoMySql();
$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysql_query("DELETE FROM plato WHERE id_plato = '$id'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS
$acceso2 = new AccesoMySql();
$comidas = $acceso2->CargarPlatos();

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="150">Nombre</th>
                <th width="350">Descripcion</th>
                <th width="100">Precio</th>
                <th width="150">Tipo</th>
                <th width="100">Imagen</th>
            </tr>'; 
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
echo '</table>';