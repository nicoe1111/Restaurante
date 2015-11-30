<?php require_once '../../../seguridad.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require_once("../../../Class/ClassMySql.php"); ?>
<script>
    $(function() {
        $("#accordion1").accordion({
            heightStyle: "content",
            active: true, 
            collapsible: true
        });
    });
    function actualizarAcordeon(){
        $("#accordion1").accordion({
            heightStyle: "content",
            active: true, 
            collapsible: true
        });
    };
    
    function doFunction($id_mesa, $id_user, $total){
                var url = 'Cajero/Cobrar/php/setear_confirmar.php';
		$.ajax({
                    type:'POST',
                    url:url,
                    data: {id_mesa: $id_mesa, id_user: $id_user, total: $total},
                    success: function(datos){
                            $('#contenido').html(datos);
                            actualizarAcordeon();
                    }
                });
                return false;
    };
</script>
</head>
<body>
    <?php if(isset($_SESSION["loged"]) && $_SESSION["loged"]=="Cajero"){ ?>
    <header>Ver Mesas</header>
    <div id="contenido" >
        <?php
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
                
                <h3>Mesa <?php echo $mesa['id_mesa']; ?></h3>
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
                        <td> <button id="confirmarComida" onclick="doFunction(<?php echo $mesa['id_mesa'].', '.$usuario['cedula'].', '.$usuario['total']; ?>)" type="button" class="btn btn-success" > Cobrar </button> </td>
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
        
    </div>
    <?php }else{ ?>
        <div class="alert alert-danger">
            <strong>Tiene que ser Cajero para ver esta pagina!</strong>
        </div>
    <?php } ?>
</body>
</html>
