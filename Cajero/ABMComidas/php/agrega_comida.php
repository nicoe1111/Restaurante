<?php
require_once("../../../Class/ClassMySql.php");
$acceso = new AccesoMySql();
$id = $_POST['id'];
$proceso = $_POST['proComida'];
$nombre = $_POST['nombreComida'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$tipo = $_POST['tipoComida'];
$imagen = $_FILES['imagen']['name'];
//VERIFICAMOS EL PROCESO

    function cargarImagen(){

        if (!empty($_FILES['imagen']['name'])){

              $MaxSubida = 4554227;
              $archivo = $_FILES["imagen"]["tmp_name"]; 
              $tamanio = $_FILES["imagen"]["size"];
              $tipo    = $_FILES["imagen"]["type"];
              $nombre  = $_FILES["imagen"]["name"];
              $directorio = "../../Imagenes/";			
              $directorio = $directorio . basename( $_FILES['imagen']['name']);

          if(!\file_exists($directorio)){
                if ($tamanio < $MaxSubida){
                       if(move_uploaded_file($archivo, $directorio)){
                            
                            return $nombre.$tipo;
                       }else {
                            echo "Lo sentimos, hubo un problema subiendo tu archivo. Error: ".$_FILES['imagen']['error'] ;
                       }
               }else{
               echo "NO se ha podido guardar el archivo en la base de datos. supera el tanio permitido ";
               }
                  header('Location:Inicio.php');
                  }
      }
    }


switch($proceso){
	case 'Registro':
            $acceso->crearPlato($nombre, $precio, $descripcion, $tipo, $imagen);
            cargarImagen();
	break;
	
	case 'Edicion':
            if($imagen != ""){
                $acceso->ModificarPlato($id, $nombre, $precio, $descripcion, $tipo, $imagen);
            }else{
                $acceso->ModificarPlatoSinImagen($id, $nombre, $precio, $descripcion, $tipo);
            }
            cargarImagen();
	break;
}

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
$acceso2 = new AccesoMySql();
$comidas = $acceso2->CargarPlatos();
echo '<table class="table table-striped table-condensed table-hover">
            <tr>
                <th width="150">Nombre</th>
                <th width="350">Descripcion</th>
                <th width="100">Precio</th>
                <th width="150">Tipo</th>
                <th width="100">Imagen</th>
            </tr>';
	foreach ($comidas as $comida){
                echo '<tr>
                        <td>'.$comida['nombre'].'</td>
                        <td>'.$comida['descripcion'].'</td>
                        <td>'.$comida['precio'].'</td>
                        <td>'.$comida['tipo'].'</td>
                        <td>'.$comida['imagen'].'</td>
                        <td><a href="javascript:editarComida('.$comida['id_plato'].');" ><img width="30px" height="30px" src="css/Icono_Editar.png"/></a> <a href="javascript:eliminarComida('.$comida['id_plato'].');"><img width="30px" height="30px" src="css/Icono_Eliminar.jpg"/></a></td>
                    </tr>';  
        }
echo '</table>';
