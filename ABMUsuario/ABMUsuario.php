<?php require_once("Includes/Usuario/UsuarioController.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Administrar Web</title>

<script type="text/javascript">
 	function validarCampos() {
		var enviar = true;
		var Nombre = document.getElementById("Nombre").value;
                var Apellido = document.getElementById("Apellido").value;
                var Cedula = document.getElementById("Cedula").value;
		var Contrasenia = document.getElementById("Contrasenia").value;
                var Tipo = document.getElementById("Tipo").value;
		if(Nombre ==""){
			enviar = false;
			alert("Debe ingresar su nombre");
		}
		else if (Apellido ==""){
			enviar = false;
			alert("Debe ingresar su Apellido");
		}
                else if (Cedula ==""){
			enviar = false;
			alert("Debe ingresar su Cedula");
		}
                else if (Contrasenia ==""){
			enviar = false;
			alert("Debe ingresar su Contrasenia");
		}
                else if (Tipo ==""){
			enviar = false;
			alert("Debe seleccionar un Tipo");
		}
		return enviar;
	}
</script>

</head>
<link rel="stylesheet" href="css/Estilo.css" type="text/css" />
<body>

<?php if(isset($_SESSION["loged"]) && $_SESSION["loged"]=="Cajero"){ ?>

<form name="formu" action="?" method="POST"  enctype="multipart/form-data" >


    <h3>Crear nuevo menu</h3>
    <table>
        <tr>
            <td>
                <p>Nombre:</p>
            </td>    
            <td>
                <input type="text" id="Nombre" name="Nombre" size="30" maxlength="30"/>
            </td>            
        </tr>
        <tr>
            <td>
                <p>Apellido:</p>
            </td>
            <td>
                <input type="text" id="Apellido" name="Apellido" size="30" maxlength="30"/>
            </td>            
        </tr>       
        <tr>
            <td>
                <p>Cedula:</p>
            </td>
            <td>
                <input type="text" id="Cedula" name="Cedula" size="30" maxlength="30"/>
            </td>            
        </tr>         
        <tr>
            <td>
                <p>Contraseña:</p>
            </td>
            <td>
                <input type="text" id="Contrasenia" name="Contrasenia" size="30" maxlength="30"/>
            </td>            
        </tr>    
        <tr>
            <td>
                <p>Tipo:</p>
            </td>
            <td>
                <select id="Tipo" name="Tipo" style="margin-left: 2em" onchange="">
                    <option value="Mozo">Mozo</option>
                    <option value="Cajero">Cajero</option>
                    <option value="Cocina">Cocina</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Registrar" id="registrarUser" name="registrarUser" onclick="return validarCampos();"/>
            </td>
        </tr>
    </table>
</form>
<?php }else{ ?>
<h1> Tiene que ser Administrador para ver esta pagina</h1>
<?php } ?>
</body>
</html>