<?php
require_once("../../../Class/ClassMySql.php");
$acceso = new AccesoMySql();
$id_mesa = $_POST['id_mesa'];
$id_user = $_POST['id_user'];

$acceso->setMesaPlatoConfirmarCobro($id_mesa, $id_user);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
  $acceso = new AccesoMySql();
            $mesas = $acceso->getMesasCobrar();
            if(sizeof($mesas)>0){
        ?>
        <div id="accordion1">
        
            <?php
            foreach ($mesas as $mesa){
                $acceso = new AccesoMySql();
                $usuarios = $acceso->getMososMesaCobrar($mesa['id_mesa']);
//                if(sizeof($usuarios)>0){
            ?>
                
                <h3><?php echo $mesa['nombre']; ?></h3>
                <div style="height: auto !important">
                <table class="table table-striped table-condensed table-hover">
                <tr>
                    <th width="300">Cedula</th>
                    <th width="300">Nombre</th>
                    <th width="200">Apellido</th>
                    <th width="150">Total</th>
                    <th width="150">Opcion</th>
                </tr>
                <?php 
                foreach ($usuarios as $usuario){?>
                    <tr>
                        <td><?php echo $usuario['cedula']; ?></td>
                        <td><?php echo $usuario['nombre']; ?></td>
                        <td><?php echo $usuario['apellido']; ?></td>
                        <td><?php echo $usuario['total']; ?></td>
                        <td> <button id="confirmarComida" onclick="doFunction(<?php echo $mesa['id_mesa'].', '.$usuario['cedula']; ?>)" type="button" class="btn btn-success" > Cobrar </button> </td>
                    </tr>
                <?php } ?>
                </table></div>
            <?php // }
                }
            }else{
              echo '<div class="alert alert-info">
                        <strong>No hay mas mesas para cobrar!</strong>
                    </div>';
            } ?>
       
        </div>