<?php require_once '../Class/ClassMySql.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Pagina Web Tecnologo Informatica San Jose</title>
    <style>
        .morris-hover{position:absolute;z-index:1000}.morris-hover.morris-default-style{border-radius:10px;padding:6px;color:#666;background:rgba(255,255,255,0.8);border:solid 2px rgba(230,230,230,0.8);font-family:sans-serif;font-size:12px;text-align:center}.morris-hover.morris-default-style .morris-hover-row-label{font-weight:bold;margin:0.25em 0}
        .morris-hover.morris-default-style .morris-hover-point{white-space:nowrap;margin:0.1em 0}
    </style>
    <script>
        <?php 
            $acceso = new AccesoMySql();
            $datos = $acceso->getValGrafica();
        ?>
        
        var datos=[
            <?php foreach ($datos as $dato){ ?>
                {y: '<?php echo $dato['nombre'].' '.$dato['apellido'];?>', a: <?php echo $dato['total']?>},   
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
