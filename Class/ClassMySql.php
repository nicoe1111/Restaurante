<?php
    
class AccesoMysql {
private $bd;
private $usuario;
private $pass;
private $con;
private $host;
    
function __construct(){
	$this->host = "localhost";//mysql.webcindario.com
	$this->bd = "cocinalab";//tisj2013
	$this->usuario = "root";//tisj2013
	$this->pass = "";//TISJ2013
	$this->con = mysql_connect($this->host, $this->usuario, $this->pass);
	mysql_select_db($this->bd, $this->con);
}
    
public function getInstance() {
        $connex = new AccesoMysql();
        return $connex;
}
    
function validarUsuario($user, $pass){
    
	$sql = mysql_query("SELECT * FROM usuario WHERE pass='$pass' and cedula='$user'", $this->con);
		if ($sql){
                    if(mysql_num_rows($sql) != 0){
                    $rs = mysql_fetch_array($sql);            	
                    $tipoUsuario = $rs['tipoUser']; 				
                    }else{
                        echo "ERROR: reingrese el nombre usuario y el codigo"; 
                        echo "<br />";
                        echo "<a href='login.php'> Volver a Login </a>";
                            }                  
		}else{
                    echo "ERROR: en la consulta con la base de datos";	
                    echo "<br />";
                    echo "<a href='login.php'> Volver a Login </a>";			
		}
		mysql_close($this->con);
		mysql_free_result($sql);
		return $tipoUsuario;  		
}
    
    function CargarPlatos(){
            $Platos = array();
            $sql = mysql_query("SELECT * FROM plato ORDER BY tipo ASC", $this->con);
            if ($sql){
                while ($lista = mysql_fetch_array($sql)){
                      $Platos[] = $lista;
                }           	                  
            }else{
                echo "ERROR: en la consulta con la base de datos";
            }
            mysql_close($this->con);
            mysql_free_result($sql);
            return $Platos;  		
    }
    
    function crearPlato($nombreComida, $precio, $descripcionComida, $categoria, $imagen){
        $insertarPlato = "INSERT INTO plato(nombre, precio, descripcion, tipo, imagen) VALUES ('$nombreComida','$precio','$descripcionComida','$categoria','$imagen')";
        $sql = mysql_query($insertarPlato,$this->con);			
        mysql_close($this->con);
        return $sql;    
    }
    
function eliminarPlato($id){
        $deletePlato = "DELETE FROM plato WHERE id_plato='$id'";
        $sql = mysql_query($deletePlato,$this->con);	
	if ($sql){
            echo "Se elimino el plato correctamente";
	}else{
            echo "ERROR: en la consulta con la base de datos";	
	}
        mysql_close($this->con);
        return $sql;
}
    
    function getAllUsers(){
            $Users = array();
            $sql = mysql_query("SELECT * FROM usuario ORDER BY nombre ASC", $this->con);
            if ($sql){
                while ($lista = mysql_fetch_array($sql)){
                      $Users[] = $lista;
                }           	                  
            }else{
                echo "ERROR: en la consulta con la base de datos";	
            }
            mysql_close($this->con);
            mysql_free_result($sql);
            return $Users;  		
    }
  
function CargarArchivos($id_Mat, $id_Prac){
	$menu_archivos = array();
	$sql = mysql_query("SELECT * FROM archpracticos WHERE Id_Materia='$id_Mat' and Id_Practico= '$id_Prac'", $this->con);
	if ($sql){
			while ($lista = mysql_fetch_array($sql)){
				$menu_archivos[] = $lista;
			}           	                  
	}else{
		echo "ERROR: en la consulta con la base de datos";	
		echo "<br />";
		echo "No pudo cargar los nombres de los archivos";
	}
		mysql_close($this->con);
		return $menu_archivos;  		
}
    
function CargarUsuario($id){
	$ArrayUser = array();
	$sql = mysql_query("SELECT * FROM usuarios WHERE Id='$id'", $this->con);
		if ($sql){
        	if(mysql_num_rows($sql) != 0){
            	$rs = mysql_fetch_array($sql); 
				$ArrayUser[] = $rs;
			}else{
				echo "ERROR: reingrese el nombre usuario y el codigo"; 
				echo "<br />";
				echo "<a href='login.php'> Volver a Login </a>";
				}                  
		}else{
			echo "ERROR: en la consulta con la base de datos";	
			echo "<br />";
			echo "<a href='login.php'> Volver a Login </a>";			
		}
		mysql_close($this->con);
		mysql_free_result($sql);
		return $ArrayUser;  		
}
    
function CargarUsuarioUser($user){
	$ArrayUser = array();
	$sql = mysql_query("SELECT * FROM usuarios WHERE Cedula='$user'", $this->con);
		if ($sql){
        	if(mysql_num_rows($sql) != 0){
            	$rs = mysql_fetch_array($sql); 
				$ArrayUser[] = $rs;
			}else{
				echo "ERROR: no existe el usuario"; 
				}                  
		}else{
			echo "ERROR: en la consulta con la base de datos";			
		}
		mysql_close($this->con);
		mysql_free_result($sql);
		return $ArrayUser;  		
}
    
function InsertarTema_Unidad($nombrePractico, $Id_materia){
    
		$insertarUnidad = "INSERT INTO practicos(Nombre, Id_Materia) VALUES ('$nombrePractico','$Id_materia')";
			$sql = mysql_query($insertarUnidad,$this->con);			
			mysql_close($this->con);
			return $sql;
}
    
function InsertarUsuario($nombre, $apellido, $CI, $pass, $tipo){
    
		$insertarUnidad = "INSERT INTO usuario(nombre, apellido, cedula, pass, tipoUser) VALUES ('$nombre','$apellido','$CI','$pass','$tipo')";
			$sql = mysql_query($insertarUnidad,$this->con);			
			mysql_close($this->con);
			return $sql;
}

function FiltrarUsuario($dato){
            $Users = array();
            $sql = mysql_query("SELECT * FROM usuario WHERE nombre LIKE '%$dato%' OR apellido LIKE '%$dato%' OR cedula LIKE '%$dato%' OR tipoUser LIKE '%$dato%' ORDER BY cedula ASC", $this->con);
            if ($sql){
                while ($lista = mysql_fetch_array($sql)){
                      $Users[] = $lista;
                }           	                  
            }else{
                echo "ERROR: en la consulta con la base de datos";	
            }
            mysql_close($this->con);
            mysql_free_result($sql);
            return $Users;  	
}

function FiltrarComida($dato){
            $platos = array();
            $sql = mysql_query("SELECT * FROM plato WHERE nombre LIKE '%$dato%' OR precio LIKE '%$dato%' OR tipo LIKE '%$dato%' ORDER BY id_plato ASC", $this->con);
            if ($sql){
                while ($lista = mysql_fetch_array($sql)){
                      $platos[] = $lista;
                }           	                  
            }else{
                echo "ERROR: en la consulta con la base de datos";	
            }
            mysql_close($this->con);
            mysql_free_result($sql);
            return $platos;  	
}

function ModificarUsuario($nombre, $apellido, $cedula, $pass, $tipo){
		$insertarUnidad = ("UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', tipoUser = '$tipo', pass = '$pass' WHERE cedula = '$cedula'");
			$sql = mysql_query($insertarUnidad,$this->con);			
			mysql_close($this->con);
			return $sql;
}

function ModificarPlato($id, $nombre, $precio, $descripcion, $tipo, $imagen){
		$modificarUnidad = ("UPDATE plato SET nombre = '$nombre', precio = '$precio', descripcion = '$descripcion', tipo = '$tipo', imagen = '$imagen' WHERE id_plato = '$id'");
			$sql = mysql_query($modificarUnidad,$this->con);			
			mysql_close($this->con);
                        echo 'iddddd'.$id;
			return $sql;
}
    
function CargarMateria($Materia, $semestre){
    
		$insertarMateria = "INSERT INTO materias(Nombre, Semestre) VALUES ('$Materia','$semestre')";
			$sql = mysql_query($insertarMateria,$this->con);			
			mysql_close($this->con);
			return $sql;
}
    
function ModificarUser($clave, $user){
	echo $clave;
	echo $user;
            
		$UpdateUser = "UPDATE usuarios SET Contrasenia='$clave' WHERE Cedula='$user'";
			$sql = mysql_query($UpdateUser,$this->con);			
			mysql_close($this->con);
			return $sql;
}
    
function VerificarUsuarioUser($user){
	$ArrayUser = array();
	$sql = mysql_query("SELECT * FROM usuarios WHERE Cedula='$user'", $this->con);
		mysql_close($this->con);
		mysql_free_result($sql);
		return $ArrayUser;  		
}
    
function InsertarUnidad($nombre, $idMateria){
    
		$insertarMateria = "INSERT INTO practicos(Nombre, Id_Materia) VALUES ('$nombre','$idMateria')";
			$sql = mysql_query($insertarMateria,$this->con);			
			mysql_close($this->con);
			return $sql;
}

function getAllMesas(){
            $Mesa = array();
            $sql = mysql_query("SELECT * FROM mesa ORDER BY nombre ASC", $this->con);
            if ($sql){
                while ($lista = mysql_fetch_array($sql)){
                      $Mesa[] = $lista;
                }           	                  
            }else{
                echo "ERROR: en la consulta con la base de datos";	
            }
            mysql_close($this->con);
            mysql_free_result($sql);
            return $Mesa;  		
    }
}

?>
