<?php
		//include("Class/ClassMySql.php");
//		$ArrayMaterias = array();
//		$ObjAcceso = new AccesoMySql();
//		$ArrayMaterias = $ObjAcceso->CargarMaterias();
		
		if(isset($_POST['insertar'])){
		
			if (empty($_FILES['archivoSub']['name'])){
				header("location: AdministrarWeb.php?");
				exit;
			}
		
			$MaxSubida = $_POST['MAX_FILE_SIZE'];
			$idPractico = $_POST['idUnidad'];
			$Idmateria = $_POST['idMateria'];
			$usuario = $_SESSION["usuario"];
			$archivo = $_FILES["archivoSub"]["tmp_name"]; 
			$tamanio = $_FILES["archivoSub"]["size"];
			$tipo    = $_FILES["archivoSub"]["type"];
			$nombre  = $_FILES["archivoSub"]["name"];
			$directorio = "Practicos/";			
			$directorio = $directorio . basename( $_FILES['archivoSub']['name']);
			
			if(!file_exists($directorio))
			{
				
				$ObjAcceso = new AccesoMySql();
				$ArrayUser = $ObjAcceso->CargarUsuarioUser($usuario);
				
				foreach($ArrayUser as $ind=>$User)
				{
					$idUsuario = $User['Id'];
				}
				
					 if ($tamanio < $MaxSubida)
					{

						if(move_uploaded_file($_FILES['archivoSub']['tmp_name'], $directorio))
						{
						echo "El archivo ". basename( $_FILES['archivoSub']['name']). " ha sido subido";
						}
						else {
						echo "Lo sentimos, hubo un problema subiendo tu archivo. Error: ".$_FILES['archivoSub']['error'] ;;
						}
						
						$ObjAcceso = new AccesoMySql();		
						$sql = $ObjAcceso->Insertar_Archivo($idPractico, $nombre, $Idmateria, $idUsuario);
					}else{
					echo "NO se ha podido guardar el archivo en la base de datos. ";
					}
				header('Location:index.php');
		}
			echo "NO se ha podido guardar el archivo, ya existe un archivo con ese nombre";
			echo "<br />";
			echo "<a href='index.php'> Volver a Cargar otro archivo </a>";
		}
		
		If(isset($_POST['actuaMateria'])){
			$ArrayPracticos = array();
			$idMateria = $_POST['SelecMateria'];
			$ObjAcceso = new AccesoMySql();
			$ArrayPracticos = $ObjAcceso->CargarPracticos($idMateria);
		
		
		}
		
		If(isset($_POST['actuaUnidad'])){
			$ArrayPracticos = array();
			$idMateria = $_POST['idMateria'];
			$idPractico = $_POST['SelecUnidad'];;
			$ObjAcceso = new AccesoMySql();
			$ArrayPracticos = $ObjAcceso->CargarPracticos($idMateria);
		}
		
		If(isset($_POST['InsertarMateria'])){
			$ArrayMateria = array();
			$Materia = $_POST['materia'];
			$semestre = $_POST['semestre'];;
			$ObjAcceso = new AccesoMySql();
			$ArrayMateria = $ObjAcceso->CargarMateria($Materia, $semestre);
		
		
		}
		
		If(isset($_POST['ModificarUsuario'])){
			$ArrayUser = array();
			$user = $_POST['usuario'];
			$clave = $_POST['clave'];
			$ObjAcceso = new AccesoMySql();			
			$ArrayUser = $ObjAcceso->ModificarUser($clave, $user);
	
		}
		
		If(isset($_POST['InsertarUsuario'])){
			$ArrayUser = array();
			$userInsert = $_POST['userInsert'];
			$cedulaInsert = $_POST['cedulaInsert'];
			$claveInsert = $_POST['claveInsert'];
			$tipoInsert = $_POST['tipoInsert'];
			$ObjAcceso = new AccesoMySql();	
			$ArrayUser = $ObjAcceso->VerificarUsuarioUser($userInsert);
			$CantUser = count($ArrayUser);
			
				if($CantUser < 1)
				{
					$ObjAcceso = new AccesoMySql();	
					$ArrayUser = $ObjAcceso->InsertUser($userInsert, $cedulaInsert, $claveInsert, $tipoInsert);
				}else
					{
						echo"El Usuario existe verifique bien la cedula ingresada";
					}
		}
		
		If(isset($_POST['InsertarUnidad'])){
			$ArrayUser = array();
			$nombre = $_POST['NuevaUnidad'];
			$idMateria = $_POST['SelecMateriaUnidad'];
			$ObjAcceso = new AccesoMySql();			
			$ArrayUser = $ObjAcceso->InsertarUnidad($nombre, $idMateria);
	
		}
				
	?>