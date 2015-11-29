<?php require_once '../../seguridad.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tienda</title>
<!--<link href="css/estiloModal.css" rel="stylesheet"/>-->
<!--<script src="ABMUsuario/js/jquery.js"></script>-->
<!--<link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
<link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet"/>
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"/>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>-->
<?php require_once("../../Class/ClassMySql.php"); ?>
<script>
    $(function() {
        $("#accordion1").accordion({
            heightStyle: "content"
        });
    });
    function actualizarAcordeon(){
        $("#accordion1").accordion({
            heightStyle: "content"
        });
    };
    
    function doFunction($id){
                var url = 'ABMMesa/php/setear_confirmar.php';
		$.ajax({
                    type:'POST',
                    url:url,
                    data:'id='+$id,
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
            $mesas = $acceso->getMesasConPlatos();
            if(sizeof($mesas)>0){
        ?>
        <div id="accordion1">
        
            <?php
            foreach ($mesas as $mesa){
                $acceso = new AccesoMySql();
                $usuarios = $acceso->getPlatosMesaCocinero($mesa['id_mesa']);
//                if(sizeof($usuarios)>0){
            ?>
                
                <h3><?php echo $mesa['nombre']; ?></h3>
                <div style="height: auto !important">
                <table class="table table-striped table-condensed table-hover">
                <tr>
                    <th width="300">id_mesa_plato</th>
                    <th width="300">id_plato</th>
                    <th width="200">nombre</th>
                    <th width="150">precio</th>
                    <th width="150">Confirma Cocina</th>
                </tr>
                <?php 
                $total=0;
                foreach ($usuarios as $usuario){
                    $total = $total+$usuario['precio'];
                ?>
                    <tr>
                        <td><?php echo $usuario['id_mesa_plato']; ?></td>
                        <td><?php echo $usuario['id_plato']; ?></td>
                        <td><?php echo $usuario['nombre']; ?></td>
                        <td><?php echo $usuario['precio']; ?></td>
                        <td> <button id="confirmarComida" onclick="doFunction(<?php echo $usuario['id_mesa_plato']; ?>);" type="button" class="btn btn-success" > Comida Pronta</button> </td>
                    </tr>
                <?php } ?>
                </table><?php echo 'Precio Total ='.$total;?></div>
            <?php // }
                }
            }else{
              echo '<div class="alert alert-info"><strong>No hay mas encargos para el cocinero!</strong></div>';
            } ?>
       
        </div>
        
    </div>
    <?php }else{ ?>
    <div class="alert alert-danger" style="font: 30px Arial; height: 300px; text-align: center; vertical-align: central;">
            <strong>Tiene que ser Administrador para ver esta pagina!</strong>
        </div>
    <?php } ?>
</body>
</html>
