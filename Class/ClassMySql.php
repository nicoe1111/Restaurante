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
    
        function CargarCategoriaPlatos(){
            $Platos = array();
            $sql = mysql_query("SELECT p.tipo FROM plato p GROUP BY p.tipo ORDER BY tipo ASC", $this->con);
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
    
    
       function CargarPlatosCategoria($categoria){
            $Platos = array();
            $sql = mysql_query("SELECT * FROM plato WHERE tipo = '$categoria'  ORDER BY tipo ASC", $this->con);
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
    
        function getHistorialVentas(){
            $HistorialVentas = array();
            $sql = mysql_query("SELECT * FROM historialventas ORDER BY fecha DESC", $this->con);
            if ($sql){
                while ($lista = mysql_fetch_array($sql)){
                      $HistorialVentas[] = $lista;
                }           	                  
            }else{
                echo "ERROR: en la consulta con la base de datos";
            }
            mysql_close($this->con);
            mysql_free_result($sql);
            return $HistorialVentas;  		
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

function FiltrarHistorialVenta($dato){
            $filtro = array();
            $sql = mysql_query("SELECT * FROM historialventas WHERE fecha LIKE '%$dato%' ORDER BY fecha DESC", $this->con);
            if ($sql){
                while ($lista = mysql_fetch_array($sql)){
                      $filtro[] = $lista;
                }           	                  
            }else{
                echo "ERROR: en la consulta con la base de datos";	
            }
            mysql_close($this->con);
            mysql_free_result($sql);
            return $filtro;  	
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

function ModificarPlatoSinImagen($id, $nombre, $precio, $descripcion, $tipo){
		$modificarUnidad = ("UPDATE plato SET nombre = '$nombre', precio = '$precio', descripcion = '$descripcion', tipo = '$tipo' WHERE id_plato = '$id'");
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
    
    function getMesasConPlatos(){
            $Mesa = array();
            $sql = mysql_query("SELECT * FROM mesa_plato mp WHERE mp.conf_cocina is false GROUP BY mp.id_mesa ORDER BY mp.id_mesa ASC", $this->con);
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
    
   function getPlatosMesa($id){
        $Platos = array();
        $sql = mysql_query("SELECT * FROM plato p JOIN mesa_plato mp ON p.id_plato = mp.id_plato WHERE mp.id_mesa = ' $id ' ORDER BY precio ASC", $this->con);
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
    
    function getPlatosMesaCocinero($id){
        $Platos = array();
        $sql = mysql_query("SELECT * FROM plato p JOIN mesa_plato mp ON p.id_plato = mp.id_plato WHERE mp.id_mesa = '$id' AND mp.conf_cocina is false", $this->con);
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
    
    function setPlatosMesaConfirmar($id){
        $sql = mysql_query("UPDATE `mesa_plato` SET `conf_cocina` = '1' WHERE `mesa_plato`.`id_mesa_plato` = '$id';", $this->con);
        mysql_close($this->con);
        return $sql; 
    }
    function CargarPedidos($mozo, $mesa){
            $Pedidos = array();
            $sql = mysql_query("SELECT * FROM mesa_plato WHERE Mozo='$mozo' and id_mesa='$mesa' and conf_mozo=false", $this->con);
            if ($sql){
                while ($lista = mysql_fetch_array($sql)){
                      $Pedidos[] = $lista;
                }           	                  
            }else{
                echo "ERROR: en la consulta con la base de datos";	
                
            }
            mysql_close($this->con);
            mysql_free_result($sql);
            return $Pedidos;  		
    }
    function InsertarPlatoOrden($Plato, $Mesa, $CantidadPlato, $Usuario){
    
            $insertarUnidad = "INSERT INTO mesa_plato(id_plato, id_mesa, Cantidad, Mozo) VALUES ('$Plato','$Mesa','$CantidadPlato', '$Usuario')";
            $sql = mysql_query($insertarUnidad,$this->con);			
            mysql_close($this->con);
            return $sql;
    }
    function eliminarOrden($id){
        $deletePlato = "DELETE FROM mesa_plato WHERE id_mesa_plato='$id'";
        $sql = mysql_query($deletePlato,$this->con);	
	if ($sql){
            echo "Se elimino la orden correctamente";
	}else{
            echo "ERROR: en la consulta con la base de datos";	
	}
        mysql_close($this->con);
        return $sql;
    }
    function terminarOrden($terminar){
        foreach($terminar as $i){
            $sql = mysql_query("UPDATE `mesa_plato` SET `conf_mozo` = '1' WHERE `mesa_plato`.`id_mesa_plato` = '$i';", $this->con);
        }
        
        mysql_close($this->con);
        return $sql; 
    }
    
    //Cajero-Cobrar//
    function getMesasCobrar(){
            $Mesa = array();
            $sql = mysql_query("SELECT * FROM mesa_plato mp WHERE mp.conf_cocina is true AND mp.conf_mozo is true AND mp.conf_caja is false GROUP BY mp.id_mesa ORDER BY mp.id_mesa ASC", $this->con);
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
    
    function getMososMesaCobrar($id){
            $Mesa = array();
            $sql = mysql_query("SELECT u.cedula, u.nombre, u.apellido , SUM(precio*Cantidad) as total FROM mesa_plato mp JOIN plato p ON mp.id_plato = p.id_plato JOIN usuario u ON u.cedula = mp.Mozo WHERE mp.conf_cocina is true AND mp.conf_mozo is true AND mp.id_mesa = '$id' AND mp.conf_caja is false GROUP BY mp.Mozo ORDER BY mp.id_mesa ASC", $this->con);
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

    function setMesaPlatoConfirmarCobro($id_mesa, $id_user, $total){
        $sql = mysql_query("UPDATE mesa_plato SET conf_caja = '1' WHERE id_mesa = '$id_mesa' AND Mozo = '$id_user' AND conf_cocina is true AND conf_mozo is true", $this->con);
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha = date("Y/m/d");
        $sql2 = mysql_query("INSERT INTO historialventas (idMozo, idMesa, precioTotal, fecha) VALUES ('$id_user','$id_mesa','$total', '$fecha')", $this->con);
        mysql_close($this->con);
        return $sql; 
    }
    /////////////////
    
    /////////////////GRAFICA/////////////
    
     function getValGrafica(){
            $Mesa = array();
            $sql = mysql_query("SELECT u.cedula, u.nombre, u.apellido , SUM(precio*Cantidad) as total FROM mesa_plato mp JOIN plato p ON mp.id_plato = p.id_plato JOIN usuario u ON u.cedula = mp.Mozo WHERE mp.conf_cocina is true AND mp.conf_mozo is true AND mp.conf_caja is true GROUP BY mp.Mozo ORDER BY mp.Mozo ASC", $this->con);
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
    
    ////////////////////////////////////
    
}

?>
