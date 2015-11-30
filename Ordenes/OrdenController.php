<?php
    require_once(dirname(__FILE__)."/../Class/ClassMySql.php");
    require_once(dirname(__FILE__)."/../seguridad.php");
    
  
    
    
    extract($_POST);
    extract($_GET);
    
    $ObjAcceso = new AccesoMySql();		
    $ArrayPlatos = array();
    $ArrayPlatos = $ObjAcceso->CargarPlatos();
    
    if(isset($_POST['idPlato'])){

        $Plato = $_POST['idPlato'];
        $Mesa = $_POST['idMesa'];
        $CantidadPlato = $_POST['cantidad'];
        $Usuario = $_SESSION["usuario"];
        $acceso = new AccesoMySql();
        $acceso->InsertarPlatoOrden($Plato, $Mesa, $CantidadPlato, $Usuario);
        $totalPedidos = array();
        $totalPedidos = $acceso->CargarPedidos($Usuario, $Mesa);
        
        

    }
    if(isset($_POST['Mesa'])){
            $acceso = new AccesoMySql();
            $Usuario = $_SESSION["usuario"];
            $Mesa = $_POST['Mesa'];
            $totalPedidos = array();
            $totalPedidos = $acceso->CargarPedidos($Usuario, $Mesa);
            echo json_encode($totalPedidos);
        
    }
    if(isset($_POST['BorrarOrden'])){
            $acceso = new AccesoMySql();
            $IdOrden = $_POST['BorrarOrden'];
            $acceso->eliminarOrden($IdOrden);
            
        
    }
    
    
	
?>

