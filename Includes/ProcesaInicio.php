<?php
		require_once("Class/ClassMySql.php");
		
		extract($_GET);
		
		$ObjAcceso = new AccesoMySql();		
		$ArrayPlatos = array();
		$ArrayPlatos = $ObjAcceso->CargarPlatos();
				
	?>