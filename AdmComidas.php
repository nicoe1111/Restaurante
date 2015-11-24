<?php 	require_once("seguridad.php");
        require_once("seguridad.php");
                extract($_POST);
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Administrar Web</title>

<script type="text/javascript">
 	function validarCampos() {
		var enviar = true;
		var nombre = document.getElementById("nombreComida").value;
		var descripcion = document.getElementById("descripcionComida").value;
                var precio = document.getElementById("precio").value;
                var categoria = document.getElementById("categoria").value;
		if(nombre ===""){
			enviar = false;
			alert("Debe ingresar nombre de comida");
		}
		else if (descripcion ===""){
			enviar = false;
			alert("Debe ingresar una descripcion de comida");
		}
		else if (precio ===""){
			enviar = false;
			alert("Debe ingresar un precio a la comida");
		}   
		else if (categoria ===""){
			enviar = false;
			alert("Debe seleccionar una categoria");
		}                  
		return enviar;
	}
</script>

</head>
<link rel="stylesheet" href="css/Estilo.css" type="text/css" />
<body>

<?php if(isset($_SESSION["loged"])){ ?>

<form name="formuMenu" action="?" method="POST"  enctype="multipart/form-data" >
    <h3>Crear nuevo menu</h3>
    <table>
        <tr>
            <td>
                <tr>
                    <td>
                        <p>Nombre:</p>
                    </td>    
                    <td>
                        <input type="text" id="nombreComida" name="nombreComida" size="30" maxlength="30"/>
                    </td>    
                    <td rowspan="4">
                     <img name="imagen" value="Imagen menu" style="width: 300px; height: 300px"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Descripcion:</p>
                    </td>
                    <td>
                        <input type="text"  id="descripcionComida" name="descripcionComida" size="30" maxlength="30"/>
                    </td>            
                </tr>       
                <tr>
                    <td>
                        <p>Precio:</p>
                    </td>
                    <td>
                        <input type="text" id="precio" name="precio" size="30" maxlength="30"/>
                    </td>            
                </tr>         
                <tr>
                    <td>
                        <p>Categoria:</p>
                    </td>
                    <td>
                        <select id="categoria" name="categoria" onchange="">
                            <option value="tipoEntrada">Entrada</option>
                            <option value="tipoPlato">Plato principal</option>
                            <option value="tipoEnsaladas">Ensaladas</option>
                            <option value="tipoPostre">Postre</option>
                            <option value="tipoRefresco">Refresco</option>
                        </select>
                    </td>
                </tr>
                <tr> 
                    <td>
                        <p>Imagen:</p>
                    </td>
                    <td>
                        <input type="hidden" name="MAX_FILE_SIZE"  value="2048"/>
                        <input type="file" name="archivoSub" value="Subir imagen"/>
                    </td>   
                </tr>
            </td>  
        </tr>    
    </table>
    <input type="submit" value="Crear comida" id="crearComida" name="crearComida" onclick="return validarCampos();"/>
</form>
<?php }else{ ?>
<h1> Tiene que ser Administrador para ver esta pagina</h1>
<?php } ?>
</body>
</html>