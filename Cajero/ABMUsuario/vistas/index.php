<?php require_once '../../../seguridad.php'; ?>
<?php require_once("../../../Class/ClassMySql.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="Cajero/ABMUsuario/js/myjava.js"></script>
</head>
<body>
    <?php if(isset($_SESSION["loged"]) && $_SESSION["loged"]=="Cajero"){ ?>
    <header>Gestionar Usuarios</header>
    <section>
    <table border="0" align="center">
    	<tr>
        	<td width="335"><input type="text" placeholder="Busca un Usuario por: Nombre, Apellido, Cedula o Tipo" id="bs-prod"/></td>
            <td width="100"><button id="nuevo-producto" class="btn btn-primary">Nuevo</button></td>
        </tr>
    </table>
    </section>

    <div class="registros" id="agrega-registros">
        <table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="300">Nombre</th>
                <th width="200">Apellido</th>
                <th width="150">Cedula</th>
                <th width="150">Tipo</th>
                <th width="50">Opciones</th>
            </tr>
        <?php
            
            $acceso = new AccesoMySql();
            $usuarios = $acceso->getAllUsers();
            foreach ($usuarios as $usuario){
                echo '<tr>
                        <td>'.$usuario['nombre'].'</td>
                        <td>'.$usuario['apellido'].'</td>
                        <td>'.$usuario['cedula'].'</td>
                        <td>'.$usuario['tipoUser'].'</td>
                        <td><a href="javascript:editarProducto('.$usuario['cedula'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarProducto('.$usuario['cedula'].');" class="glyphicon glyphicon-remove-circle"></a></td>
                    </tr>';   
            }
        ?>
        </table>
    </div>
    <!-- MODAL PARA EL REGISTRO DE PRODUCTOS-->
    <div class="modal fade" id="registra-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Registra o Edita un Producto</b></h4>
            </div>
            <form id="formulario" class="formulario" onsubmit="return agregaRegistro();">
            <div class="modal-body">
				<table border="0" width="100%">
                    <tr style="display:none">
                    	<td width="150">Proceso: </td>
                        <td><input type="text" required="required" readonly="readonly" id="pro" name="pro"/></td>
                    </tr>
                    <tr>
                    	<td>Cedula: </td>
                        <td><input type="text" required="required" name="cedula" id="cedula"/></td>
                    </tr>
                    <tr>
                    	<td>Nombre: </td>
                        <td><input type="text" required="required" name="nombre" id="nombre" maxlength="100"/></td>
                    </tr>
                    <tr>
                    	<td>Apellido: </td>
                        <td><input type="text" required="required" name="apellido" id="apellido" maxlength="100"/></td>
                    </tr>
                    <tr>
                    	<td>Tipo: </td>
                        <td><select required="required" name="tipo" id="tipo">
                        	<option value="Mozo">Mozo</option>
                                <option value="Cajero">Cajero</option>
                                <option value="Cocina">Cocina</option>
                            </select></td>
                    </tr>
                    <tr>
                    	<td>Contraseña: </td>
                        <td><input type="text" required="required" name="pass" id="pass"/></td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<div id="mensaje"></div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="modal-footer">
            	<input type="submit" value="Registrar" class="btn btn-success" id="reg"/>
                <input type="submit" value="Editar" class="btn btn-warning"  id="edi"/>
            </div>
            </form>
          </div>
        </div>
      </div>
    <?php }else{ ?>
        <div class="alert alert-danger">
            <strong>Tiene que ser Cajero para ver esta pagina!</strong>
        </div>
    <?php } ?>
</body>
</html>
