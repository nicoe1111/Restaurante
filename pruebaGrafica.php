<?php require_once 'Class/ClassMySql.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Pagina Web Tecnologo Informatica San Jose</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet"/>
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"/>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    
    <script>
        <?php 
            $acceso = new AccesoMySql();
            $datos = $acceso->getValGrafica();
        ?>
        
        var datos=[
            <?php foreach ($datos as $dato){ ?>
                {y: '<?php echo $dato['cedula'].' '.$dato['nombre'].' '.$dato['apellido'];?>', a: <?php echo $dato['total']?>},   
            <?php }?>
         ];
        
        $.getScript('http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',function(){
            $.getScript('http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js',function(){
              Morris.Bar({
                 element: 'bar-example',
                 data: datos,
                 xkey: 'y',
                 ykeys: 'a',
                 labels: 'Total Ventas'
              });
          });
      });
    </script>

</head>
<body>
    
    <div id="bar-example" style="height: 250px;"></div>
</body>
</html>
