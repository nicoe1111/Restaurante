<?php
require_once 'Class/ClassMySql.php';

    extract($_GET);
    $ObjAcceso = new AccesoMySql();
    $PlatosLista = $ObjAcceso->CargarPlatos();

    function cargarImagen(){

        if (!empty($_FILES['archivoSub']['name'])){

              $MaxSubida = $_POST['MAX_FILE_SIZE'];
              $archivo = $_FILES["archivoSub"]["tmp_name"]; 
              $tamanio = $_FILES["archivoSub"]["size"];
              $tipo    = $_FILES["archivoSub"]["type"];
              $nombre  = $_FILES["archivoSub"]["name"];
              $directorio = "Imagenes/";			
              $directorio = $directorio . basename( $_FILES['archivoSub']['name']);

          if(!\file_exists($directorio)){
                if ($tamanio < $MaxSubida){
                       if(move_uploaded_file($archivo, $directorio)){
                            echo "El archivo ". basename( $_FILES['archivoSub']['name'])." ha sido subido";
                            return $nombre.$tipo;
                       }else {
                            echo "Lo sentimos, hubo un problema subiendo tu archivo. Error: ".$_FILES['archivoSub']['error'] ;
                       }
               }else{
               echo "NO se ha podido guardar el archivo en la base de datos. supera el tanio permitido ";
               }
                  header('Location:Inicio.php');
                  }
      }
    }
                
    if(isset($_POST['crearComida'])){
            $nombreComida = $_POST['nombreComida'];
            $descripcionComida = $_POST['descripcionComida'];
            $precio = $_POST['precio'];
            $categoria = $_POST['categoria'];
            cargarImagen();
            $imagen = $_FILES['archivoSub']['name'];
            $ObjAcceso = new AccesoMySql();
            $comidas = $ObjAcceso->crearPlato($nombreComida, $precio, $descripcionComida, $categoria, $imagen);
            Header('Location: localhost/CocinaLabPhP/index.php'.$_SERVER['PHP_SELF']);
    }
    
    if(isset($_GET['DelPlato'])){
            $id = $_GET['DelPlato'];
            $ObjAcceso = new AccesoMySql();
            $ArrayPracticos = $ObjAcceso->eliminarPlato($id);
    }	
//		If(isset($_POST['actuaMateria'])){
//			$ArrayPracticos = array();
//			$idMateria = $_POST['SelecMateria'];
//			$ObjAcceso = new AccesoMySql();
//			$ArrayPracticos = $ObjAcceso->CargarPracticos($idMateria);
//
//		}
//		
//		If(isset($_POST['actuaUnidad'])){
//			$ArrayPracticos = array();
//			$idMateria = $_POST['idMateria'];
//			$idPractico = $_POST['SelecUnidad'];;
//			$ObjAcceso = new AccesoMySql();
//			$ArrayPracticos = $ObjAcceso->CargarPracticos($idMateria);
//		}
//		
//		If(isset($_POST['InsertarMateria'])){
//			$ArrayMateria = array();
//			$Materia = $_POST['materia'];
//			$semestre = $_POST['semestre'];;
//			$ObjAcceso = new AccesoMySql();
//			$ArrayMateria = $ObjAcceso->CargarMateria($Materia, $semestre);
//		
//		
//		}
//		
//		If(isset($_POST['ModificarUsuario'])){
//			$ArrayUser = array();
//			$user = $_POST['usuario'];
//			$clave = $_POST['clave'];
//			$ObjAcceso = new AccesoMySql();			
//			$ArrayUser = $ObjAcceso->ModificarUser($clave, $user);
//	
//		}
//		
//		If(isset($_POST['InsertarUsuario'])){
//			$ArrayUser = array();
//			$userInsert = $_POST['userInsert'];
//			$cedulaInsert = $_POST['cedulaInsert'];
//			$claveInsert = $_POST['claveInsert'];
//			$tipoInsert = $_POST['tipoInsert'];
//			$ObjAcceso = new AccesoMySql();	
//			$ArrayUser = $ObjAcceso->VerificarUsuarioUser($userInsert);
//			$CantUser = count($ArrayUser);
//			
//				if($CantUser < 1)
//				{
//					$ObjAcceso = new AccesoMySql();	
//					$ArrayUser = $ObjAcceso->InsertUser($userInsert, $cedulaInsert, $claveInsert, $tipoInsert);
//				}else
//					{
//						echo"El Usuario existe verifique bien la cedula ingresada";
//					}
//		}
//		
//		If(isset($_POST['InsertarUnidad'])){
//			$ArrayUser = array();
//			$nombre = $_POST['NuevaUnidad'];
//			$idMateria = $_POST['SelecMateriaUnidad'];
//			$ObjAcceso = new AccesoMySql();			
//			$ArrayUser = $ObjAcceso->InsertarUnidad($nombre, $idMateria);
//	
//		}
?>