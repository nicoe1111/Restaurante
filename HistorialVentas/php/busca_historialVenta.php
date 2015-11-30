<?php
require_once("../../Class/ClassMySql.php");
$acceso = new AccesoMySql();
$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$historialVentas = $acceso->FiltrarHistorialVenta($dato);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="150">Mozo</th>
                <th width="100">Mesa</th>
                <th width="80">Precio Total</th>
                <th width="80">Fecha</th>
            </tr>';
if(sizeof($historialVentas) >0){
    $precioTotal = "";
	foreach ($historialVentas as $historVenta){
                echo '<tr>
                <td>'.$historVenta['idMozo'].'</td>
                      <td>'.$historVenta['idMesa'].'</td>
                      <td>'.$historVenta['precioTotal'].'</td>
                      <td>'.$historVenta['fecha'].'</td>
                 </tr>'; 
                $precioTotal += $historVenta['precioTotal'];
        }
       echo ' <tr>
                <td>
                    <br/>
                    <h1> Precio total venta: '. $precioTotal.' </h1>
                </td>
            </tr>';
}else{
	echo '<tr>
		<td colspan="6">No se encontraron resultados</td>
            </tr>';
}
echo '</table>';
