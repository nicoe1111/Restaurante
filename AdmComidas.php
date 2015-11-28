<?php 	require_once("seguridad.php");
        require_once("Includes/Comida/ComidaControler.php");
                extract($_POST);
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Gestion Comidas</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<style>
    #feedback { font-size: 1.4em; }
    #selectable .ui-selecting { background: #FECA40; }
    #selectable .ui-selected { background: #F39814; color: white; }
    #selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
    #selectable li { margin: 3px; padding: 0.4em; font-size: 1.4em; height: 18px; }
</style>
<script>
$(function() {
  $( "#selectable" ).selectable();
});
</script>
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
        
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#imagen')
            .attr('src', e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
      }
    }  
//    
//    $(function(){
//       $('#elimiarPlato').on('click', function(){
//           var url = 'Comida/tablaComidas.php';
//           $.ajax({
//               type: 'POST',
//               url: url,
//               success: function(dato){
//                   $('#tablaComidas').html(dato);
//               }
//               
//           });
//           
//       }); 
//    });
    
</script>

</head>
<link rel="stylesheet" href="css/Estilo.css" type="text/css" />
<body>

<?php if(isset($_SESSION["loged"])){ ?>

    <form name="formABMcomidas" action="index.php" method="POST"  enctype="multipart/form-data" >
    <h3>Crear nuevo menu</h3>
    <table class="contenedor">
        <tr>
            <td>
                <tr>
                    <td>
                        <p>Nombre:</p>
                    </td>    
                    <td>
                        <input type="text" id="nombreComida" name="nombreComida" size="30" maxlength="30" />
                    </td>    
                    <td rowspan="4">
                        <img name="imagen" id="imagen" value="Imagen menu" style="width: 300px; height: 300px"/>
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
                            <option value="Entrada">Entrada</option>
                            <option value="Plato principal">Plato principal</option>
                            <option value="Ensaladas">Ensaladas</option>
                            <option value="Postre">Postre</option>
                            <option value="Refresco">Refresco</option>
                        </select>
                    </td>
                </tr>
                <tr> 
                    <td>
                        <p>Imagen:</p>
                    </td>
                    <td>
                        <input type="hidden" name="MAX_FILE_SIZE"  value="4554227">
                            <input type="file" name="archivoSub" value="Subir imagen" onchange="readURL(this);"/>
                    </td>   
                </tr>
            </td>  
        </tr>    
    </table>
    <input type="submit" value="Crear comida" id="crearComida" name="crearComida" style="margin-left: auto; margin-left: 300px" onclick="return validarCampos(); parent.window.location.reload();"/>
    </form>
    <br>&nbsp</br><br>&nbsp</br>
    <br>&nbsp</br>
    <form name="formABMcomidas1" action="index.php" method="GET">
        <h3>Seleccionar comida para modificar</h3>
        <div id="tablaComidas">
            <table>
               <?php foreach ($PlatosLista as $ind=>$Rowplato){ ?> 
                    <tr>
                        <td>
                            <a class="modificarPlato" id="<?php echo $Rowplato['id_plato']; ?>" href="?ModifPlato=<?php echo $ind; ?>" onclick="parent.window.location.reload();" > <?php echo $Rowplato['nombre']; ?></a>
                        </td>
                        <td>
                            <a id="elimiarPlato" href="?DelPlato=<?php echo $Rowplato['id_plato']; ?>" onclick="parent.window.location.reload();" > <img width="40px" id="" height="40px" src="css/Icono_Eliminar.jpg"/></a>
                        </td>
                    </tr>
                <?php } ?>
          </table>
      </div>
    </form>
  <?php } else { ?>
  <h1> Tiene que ser Administrador para ver esta pagina</h1>
  <?php } ?>
  
</body>
</html>