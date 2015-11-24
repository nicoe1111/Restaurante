<?php 	require_once("seguridad.php");
		extract($_POST);
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Administrar Web</title>

</head>
<link rel="stylesheet" href="css/Estilo.css" type="text/css" />
<body>

<?php if(isset($_SESSION["loged"])){ ?>

<center><h1> SE HA LOGEADO COMO <?php echo " ".$_SESSION["loged"]; ?></h1></center>
<center><h2> <?php echo $_SESSION["usuario"]; ?></h2></center>
<center><div align="right"><a href="?logout=1">Cerrar Sesion</a></div></center>

<form name="formu" action="?" method="POST"  enctype="multipart/form-data" >

&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>
<fieldset>
	<legend><h3>Modificar Usuario </h3></legend>
	Nombre:<input type="text"name="usuario" value="<?php echo $_SESSION["usuario"]; ?>" readonly="readonly">
	Clave:<input type="password"name="clave" value="<?php echo $_SESSION["clave"]; ?>">
	<center><div><input type="submit" value="Modificar Usuario" id="ModificarUsuario" name="ModificarUsuario" onclick=""/></div></center>
</fieldset>

&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>

<fieldset>
	<legend><h3>Ingresar nuevo Usuario </h3></legend>

	Nombre y Apellido:<input type="text"name="userInsert">
	Cedula:<input type="text"name="cedulaInsert">
	Clave:<input type="text"name="claveInsert">
	Tipo:<input type="text"name="tipoInsert" value="Administrador" readonly="readonly">
	<center><div><input type="submit" value="Insertar Usuario" id="InsertarUsuario" name="InsertarUsuario" onclick=""/></div></center>
</fieldset>


&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>

<fieldset>
	<legend><h3>Ingresar nueva materia</h3></legend>
	Nombre Materia:<input type="text"name="materia">
	Semestre:<input type="text"name="semestre" size="1" maxlength="1">
	<center><div><input type="submit" value="Insertar Materia" id="InsertarMateria" name="InsertarMateria" onclick=""/></div></center>
</fieldset>

&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>

<fieldset>
	<legend><h3>Ingresar nueva Unidad asociada a una materia</h3></legend>
		<select name="SelecMateriaUnidad" style="margin-left: 2em" onchange="">
	
			<?php		
					foreach($ArrayMaterias as $ind=>$MaterUnidad)
					{ ?>
						<option value="<?php echo $MaterUnidad['Id'];?>"><?php echo $MaterUnidad['Nombre']." Semestre ".$MaterUnidad['Semestre'];?></option>
			<?php   } ?>
	
		</select>
	Nombre Unidad:<input type="text"name="NuevaUnidad" size="30" maxlength="30">
	<center><div><input type="submit" value="Insertar Unidad" id="InsertarUnidad" name="InsertarUnidad" onclick=""/></div></center>
</fieldset>

&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>  
<fieldset>
	<legend><h3>Ingresar Nuevos Archivos asociados a una materia y una unidad</h3></legend>
	<table >
	<tr>
	<?php
	if(!isset($_POST['actuaMateria']) && !isset($_POST['idMateria']))
	 { ?>
		<select name="SelecMateria" style="margin-left: 2em" onchange="">
	<?php		
			foreach($ArrayMaterias as $ind=>$Materia)
			{ ?>
				<option value="<?php echo $Materia['Id'];?>"><?php echo $Materia['Nombre']." Semestre ".$Materia['Semestre'];?></option>
	<?php   } ?>
		</select>
		<center><div><input type="submit" value="Siguiente >>" id="actuaMateria" name="actuaMateria" onclick=""/></div></center>
<?php } ?>
	<?php
	if(isset($_POST['actuaMateria']))
	{ ?>
		<select name="SelecUnidad" style="margin-left: 2em">
		<?php
			foreach($ArrayPracticos as $ind=>$Practicos)
			{ ?>
				<option value="<?php echo $Practicos['Id'];?>"><?php echo $Practicos['Nombre'];?></option>
	<?php	} ?>
	</select>
	<input type="hidden" id="idMateria" name="idMateria" value="<?php echo $idMateria ?>">
	<center><div><input type="submit" value="Siguiente >>" id="actuaUnidad" name="actuaUnidad" onclick=""/></div></center>
<?php } ?>
	<?php
	if(isset($_POST['actuaUnidad']))
	{ ?>
	<input type="hidden" name="MAX_FILE_SIZE"  value="2048">
	Archivo: <input type="file" name="archivoSub"/>
	<input type="text" id="idUnidad" name="idUnidad" value="<?php echo $idPractico ?>">
	<input type="text" id="idMateria" name="idMateria" value="<?php echo $idMateria ?>">
	<center><div><input type="submit" value="Insertar" id="insertar" name="insertar" onclick=""/></div></center>
	<?php } ?>
	&nbsp;<br/>&nbsp;<br/>
	</tr>
  </table>
  </fieldset>
  
  &nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>
 
</form>
<?php }else{ ?>
<h1> Tiene que ser Administrador para ver esta pagina</h1>
<?php } ?>
</body>
</html>