<?php
		require_once("Class/ClassMySql.php");
		
		extract($_GET);
		
		$ObjAcceso = new AccesoMySql();		
		$ArrayPlatos = array();
		$ArrayPlatos = $ObjAcceso->CargarPlatos();
		
//		if(isset($_GET["platos"]))
//		{
//			$id = $_GET["platos"];
//			$ObjAcceso = new AccesoMySql();
//			$ArrayPLatos = array();
//			$ArrayPLatos = $ObjAcceso->CargarPlatos();
//		}
				
	?>