<?php
require_once("../../Class/ClassMySql.php");
$acceso = new AccesoMySql();
$id = $_POST['id'];

$acceso->setPlatosMesaConfirmar($id);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

        $acceso = new AccesoMySql();
        $mesas = $acceso->getMesasConPlatos();
        if(sizeof($mesas)>0){
        echo '<div id="accordion1">';
          foreach ($mesas as $mesa){
                $acceso = new AccesoMySql();
                $usuarios = $acceso->getPlatosMesaCocinero($mesa['id_mesa']);
               // if(sizeof($usuarios)>0){
          echo  '<h3> '.$mesa['nombre'].' </h3>
                <div style="height: auto !important">
                <table class="table table-striped table-condensed table-hover">
                <tr>
                    <th width="300">id_mesa_plato</th>
                    <th width="300">id_plato</th>
                    <th width="200">nombre</th>
                    <th width="150">precio</th>
                    <th width="150">Confirma Cocina</th>
                </tr>';
                $total=0;
                foreach ($usuarios as $usuario){
                    $total=$total+$usuario['precio'];
                echo  '<tr>
                        <td>'.$usuario['id_mesa_plato'].'</td>
                        <td>'.$usuario['id_plato'].'</td>
                        <td>'.$usuario['nombre'].'</td>
                        <td>'.$usuario['precio'].'</td>
                        <td> <button id="confirmarComida" onclick="doFunction('.$usuario['id_mesa_plato'].');" type="button" class="btn btn-success" > Comida Pronta</button> </td>
                    </tr>';
                 } 
                echo '</table>Precio Total ='.$total.'</div>';
                //}
           
           }
        echo '</div>';
        }else{
            echo '<div class="alert alert-info"><strong>No hay mas encargos para el cocinero!</strong></div>';
         }