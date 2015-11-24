<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pagina Web Tecnologo Informatica San Jose</title>
</head>
<link rel="stylesheet" href="css/Estilo.css" type="text/css" />
<body>

<?php if(isset($_SESSION["loged"]))
        {
          require_once ("inicio.php"); 

        }else{ 
          Require_once("login.php");
          Require_once("Inicio.php"); 
        }
?>
</body>
</html>