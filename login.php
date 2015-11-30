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

   
	<b>Usuario:</b></tr>
	<input type="text" id="usuario" name="usuario"/>
	<b>Clave:</b>
	<input type="password" id="clave" name="clave"/>
	<input type="submit" class="btn btn-primary" value="Login" id="enviar" name="enviar" onclick="return validarCampos();"/>
	
</form>

<?php }else{ ?>
    <center><h1> SE HA LOGEADO COMO <?php echo " ".$_SESSION["loged"]; ?> - <?php echo $_SESSION["usuario"]; ?></h1></center>
    <center><div align="right" style="margin-right: 30px"><a href="?logout=1"><input type="submit" class="btn btn-primary" value="Cerrar Sesion"/></a></div></center>
<?php } ?>

</body>
</html>