<?php require_once("seguridad.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login</title>

<script type="text/javascript">
 	function validarCampos() {
		var enviar = true;
		var usuario = document.getElementById("usuario").value;
		var clave = document.getElementById("clave").value;
		if(usuario ==""){
			enviar = false;
			alert("Debe ingresar su nombre de USUARIO");
		}
		else if (clave ==""){
			enviar = false;
			alert("Debe ingresar su CLAVE");
		}
		return enviar;
	}
</script>

</head>
<body>

<?php if(!isset($_SESSION["loged"])){ ?>

<form name="login" action="seguridad.php" method="POST">
<fieldset>
<legend>USUARIOS REGISTRADOS</legend>
	<table height="15">
	<tr><b>Usuario:</b></tr>
	<tr><input type="text" id="usuario" name="usuario"/></tr>
	<tr><b>Clave:</b></tr>
	<tr><input type="password" id="clave" name="clave"/></tr>
	<tr><input type="submit" value="Login" id="enviar" name="enviar" onclick="return validarCampos();"/>
	</tr>
  </table>
  </fieldset>
</form>

<?php }else{ ?>
    <center><h1> SE HA LOGEADO COMO <?php echo " ".$_SESSION["loged"]; ?> - <?php echo $_SESSION["usuario"]; ?></h1></center>
    <center><div align="right"><a href="?logout=1">Cerrar Sesion</a></div></center>
<?php } ?>

</body>
</html>