<?php require_once("../../Class/ClassMySql.php");
       require_once '../../seguridad.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    <?php if(isset($_SESSION["loged"]) && $_SESSION["loged"]=="Mozo"){ ?>
    <header>Gestionar Comidas</header>
    <section>
    <table border="0" align="center">
    	<tr>
            <td width="500"><input type="text" placeholder="Buscar: Nombre o Tipo" id="bs-comida"/></td>
            <td width="150"><button id="nueva-comida" class="btn btn-primary">Confirmar Mesa</button></td>
        </tr>
    </table>
    </section>

    <div class="container-fluid" id="agrega-comidas">
        <div class="row">
            <div class="col-sm-6">
                <table class="table table-striped table-condensed table-hover">
                    <tr>
                        <th width="150">Nombre</th>
                        <th width="100">Precio</th>
                        <th width="80">Cantidad</th>
                    </tr>
                <?php

                    $acceso = new AccesoMySql();
                    $comidas = $acceso->CargarPlatos();
                    foreach ($comidas as $comida){
                        echo '<tr>
                                <td>'.$comida['nombre'].'</td>
                                <td>'.$comida['precio'].'</td>
                                <td ><input width="30" type="text" name="cantidadPedido[]" id="cantidadPedido"/></td>
                            </tr>';   
                    }
                ?>
                </table>
            </div>
            <div class="col-sm-6">
                <table>
                    <tr>
                        <td>
                            <ol id="selectable">
                                <li class="ui-state-default">1</li>
                                <li class="ui-state-default">2</li>
                                <li class="ui-state-default">3</li>
                                <li class="ui-state-default">4</li>
                                <li class="ui-state-default">5</li>
                                <li class="ui-state-default">6</li>
                                <li class="ui-state-default">7</li>
                                <li class="ui-state-default">8</li>
                                <li class="ui-state-default">9</li>
                                <li class="ui-state-default">10</li>
                                <li class="ui-state-default">11</li>
                                <li class="ui-state-default">12</li>
                              </ol>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <?php }else{ ?>
        <div class="alert alert-danger">
            <strong>Tiene que ser Mozo para ver esta pagina!</strong>
        </div>
    <?php } ?>
</body>
</html>
