<!doctype html>
<html lang="en">
    <head>
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
                $( "#historialVentas" ).click(function(evt) {
                    $( "#contenedor" ).load("HistorialVentas/vistas/index.php")
                });
                $( "#ordenes" ).click(function(evt) {
                    $( "#contenedor" ).load("Ordenes/CrearOrden.php")
                }); 
            });
    </script>
</head>
<body>
    
    <ul class="nav nav-tabs">
        <li class="active"><a id="PlatosDetalles" href="PlatosDetalles.php" data-toggle="tab">Ver carta comidas</a></li>
        <li><a id="verMesas" href="#" data-toggle="tab">Ver mesas</a></li>
        <li><a id="getionComida" href="#" data-toggle="tab">Administrar comidas</a></li>
        <li><a id="gestionUsuario" href="#" data-toggle="tab">Gestion Usuarios</a></li>
        <li><a id="pedidosMesa" href="#" data-toggle="tab">Pedidos Mesa</a></li>
        <li><a id="historialVentas" href="#" data-toggle="tab">Historial Ventas</a></li>
        <li><a id="ordenes" href="#" data-toggle="tab">Ordenes</a></li>
    </ul>
        
        
    <div id="contenedor">
        <?php include 'PlatosDetalles.php'; ?>
    </div>
</body>
</html>
