<?php require_once("../../Class/ClassMySql.php");
       require_once '../../seguridad.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tienda</title>
<script src="ABMComidas/js/myjava.js"></script>

  <style>
  #feedback { font-size: 1.4em; }
  #selectable .ui-selecting { background: #FECA40; }
  #selectable .ui-selected { background: #F39814; color: white; }
  #selectable { list-style-type: none; margin: 0; padding: 0; width: 450px; }
  #selectable li { margin: 3px; padding: 1px; float: left; width: 100px; height: 80px; font-size: 4em; text-align: center; }
  </style>
  <script>
  $(function() {
    $( "#selectable" ).selectable();
  });
  </script>

</head>
<body>
    <?php if(isset($_SESSION["loged"]) && $_SESSION["loged"]=="Cajero"){ ?>
    <header>Gestionar Comidas</header>
    <section>
    <table border="0" align="center">
    	<tr>
            <td width="500"><input type="text" placeholder="Buscar: por Fecha" id="bs-comida"/></td>
        </tr>
    </table>
    </section>

    <div class="container-fluid" id="agrega-comidas">
        <div class="row">
            <div class="col-sm-6">
                <table class="table table-striped table-condensed table-hover">
                    <tr>
                        <th width="150">Mozo</th>
                        <th width="100">Mesa</th>
                        <th width="80">Precio Total</th>
                        <th width="80">Fecha</th>
                    </tr>
                <?php

                    $acceso = new AccesoMySql();
                    $historial = $acceso->getHistorialVentas();
                    foreach ($historial as $historVenta){
                        echo '<tr>
                                <td>'.$historVenta['idMozo'].'</td>
                                <td>'.$historVenta['idMesa'].'</td>
                                <td>'.$historVenta['precioTotal'].'</td>
                                <td>'.$historVenta['fecha'].'</td>
                            </tr>';   
                    }
                ?>
                </table>
            </div>
        </div>
    </div>
    <?php }else{ ?>
        <h1> Tiene que ser Administrador para ver esta pagina</h1>
    <?php } ?>
</body>
</html>