<?php require_once("../../Class/ClassMySql.php");
       require_once '../../seguridad.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tienda</title>
<script src="ABMComidas/js/myjava.js"></script>
</head>
<body>
    <?php if(isset($_SESSION["loged"]) && $_SESSION["loged"]=="Cajero"){ ?>
    <header>Gestionar Comidas</header>
    <section>
    <table border="0" align="center">
    	<tr>
        	<td width="500"><input type="text" placeholder="Buscar: Nombre o Tipo" id="bs-comida"/></td>
            <td width="150"><button id="nueva-comida" class="btn btn-primary">Nuevo</button></td>
        </tr>
    </table>
    </section>

    <div class="registros" id="agrega-comidas">
        <table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="150">Nombre</th>
                <th width="350">Descripcion</th>
                <th width="100">Precio</th>
                <th width="150">Tipo</th>
                <th width="100">Imagen</th>
            </tr>
        <?php
            
            $acceso = new AccesoMySql();
            $comidas = $acceso->CargarPlatos();
            foreach ($comidas as $comida){
                echo '<tr>
                        <td>'.$comida['nombre'].'</td>
                        <td>'.$comida['descripcion'].'</td>
                        <td>'.$comida['precio'].'</td>
                        <td>'.$comida['tipo'].'</td>
                        <td>'.$comida['imagen'].'</td>
                        <td><a href="javascript:editarComida('.$comida['id_plato'].');"><img width="30px" height="30px" src="css/Icono_Editar.png"/></a> <a href="javascript:eliminarComida('.$comida['id_plato'].');"><img width="30px" height="30px" src="css/Icono_Eliminar.jpg"/></a></td>
                    </tr>';   
            }
        ?>
        </table>
    </div>
    <!-- MODAL PARA EL REGISTRO DE comidas-->
    <div class="modal fade" id="registra-comida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Registra o Edita una Comida</b></h4>
            </div>
              <form id="formularioComida" method="POST" enctype="multipart/form-data" class="formularioComida" onsubmit="return agregaComida();">
            <div class="modal-body">
		<table border="0" width="100%">
                     <td rowspan="7">
                         <?php if(isset($_POST['proComida']) && $_POST['proComida'] == "Registro"){ ?>
                         <img name="archivo" id="archivo" value="Imagen menu" style="width: 250px; height: 250px"/>
                         <?php } ?>
                         <div id="conteinerImage">
                         
                         </div>
                    </td>
                    <tr>
                        <td colspan="2"><input type="text" style="display: none;" readonly="readonly" id="id" name="id" readonly="readonly"/></td>
                    </tr>
                     <tr>
                         <td  width="150" style="display: none;">Proceso: </td>
                        <td><input type="text" required="required" style="display: none;" readonly="readonly" id="proComida" name="proComida"/></td>
                    </tr>
                    <tr>
                    	<td>Nombre: </td>
                        <td><input type="text" required="required" name="nombreComida" id="nombreComida"/></td>
                    </tr>
                    <tr>
                    	<td>Descripcion: </td>
                        <td><input type="text" required="required" name="descripcion" id="descripcion" maxlength="100"/></td>
                    </tr>
                    <tr>
                    	<td>Precio: </td>
                        <td><input type="text" required="required" name="precio" id="precio" maxlength="100"/></td>
                    </tr>
                    <tr>
                    	<td>Tipo: </td>
                        <td><select required="required" name="tipoComida" id="tipoComida">
                        	<option value="Entrada">Entrada</option>
                                <option value="Plato principal">Plato principal</option>
                                <option value="Postre">Postre</option>
                                <option value="Bebida">Bebida</option>
                            </select></td>
                    </tr>
                    <tr>
                        <input type="file" name="imagen" id="imagen" onchange="readURL(this);"/>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<div id="mensaje"></div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="modal-footer">
            	<input type="submit" value="Registrar" class="btn btn-success" id="regComida"/>
                <input type="submit" value="Editar" class="btn btn-warning"  id="ediComida"/>
            </div>
            </form>
          </div>
        </div>
      </div>
    <?php }else{ ?>
        <h1> Tiene que ser Administrador para ver esta pagina</h1>
    <?php } ?>
</body>
</html>
