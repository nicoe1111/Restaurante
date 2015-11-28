<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Tabs</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        
        <link href="css/estiloModal.css" rel="stylesheet"/>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet"/>
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
            
        <script>
            $(function() {
                $( "#tabs" ).tabs();
            });
            $(function() {
                $( "#gestionUsuario" ).click(function(evt) {
                    $( "#contenedor" ).load("ABMUsuario/vistas/index.php")
                });
                $( "#verMesas" ).click(function(evt) {
                    $( "#contenedor" ).load("ABMMesa/vistas/index.php")
                });
                $( "#PlatosDetalles" ).click(function(evt) {
                    $( "#contenedor" ).load("PlatosDetalles.php")
                });
                $( "#getionComida" ).click(function(evt) {
                    $( "#contenedor" ).load("ABMComidas/vistas/index.php")
                });
                $( "#pedidosMesa" ).click(function(evt) {
                    $( "#contenedor" ).load("ABMPedidoMesa/vistas/index.php")
                });                  
            });
    </script>
</head>
<body>
    
    <ul class="nav nav-tabs">
        <li class="active"><a id="PlatosDetalles" href="PlatosDetalles.php" data-toggle="tab">Ver carta comidas</a></li>
        <li><a id="verMesas" href="#" data-toggle="tab">Ver mesas</a></li>
        <li><a href="#" data-toggle="tab">Cerrar</a></li>
        <li><a href="#" data-toggle="tab">Historial de ventas</a></li>
        <li><a href="#" data-toggle="tab">Confirmar plato</a></li>
        <li><a id="getionComida" href="3" data-toggle="tab">Administrar comidas</a></li>
        <li><a id="getionComida" href="3" data-toggle="tab">Administrar comidas</a></li>
        <li><a id="pedidosMesa" href="#" data-toggle="tab">Pedidos Mesa</a></li>
    </ul>
        
        
    <div id="contenedor">
        <?php include 'PlatosDetalles.php'; ?>
    </div>
</body>
</html>
