<!doctype html>
<html lang="en">
    <head>
        <script>
            $(function() {
                $( "#tabs" ).tabs();
            });
            $(function() {
                /////////Cajero///////////
                $( "#gestionUsuario" ).click(function(evt) {
                    $( "#contenedor" ).load("Cajero/ABMUsuario/vistas/index.php")
                });
                $( "#getionComida" ).click(function(evt) {
                    $( "#contenedor" ).load("Cajero/ABMComidas/vistas/index.php")
                });
                $( "#historialVentas" ).click(function(evt) {
                    $( "#contenedor" ).load("Cajero/HistorialVentas/vistas/index.php")
                });
                $( "#cobrar" ).click(function(evt) {
                    $( "#contenedor" ).load("Cajero/Cobrar/vistas/index.php")
                });
                $( "#grafica" ).click(function(evt) {
                    $( "#contenedor" ).load("Cajero/pruebaGrafica.php")
                });
                /////////////////////////////
                $( "#verMesas" ).click(function(evt) {
                    $( "#contenedor" ).load("Cocina/vistas/index.php")
                });
                $( "#PlatosDetalles" ).click(function(evt) {
                    $( "#contenedor" ).load("PlatosDetalles.php")
                });
                $( "#pedidosMesa" ).click(function(evt) {
                    $( "#contenedor" ).load("ABMPedidoMesa/vistas/index.php")
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
        <?php if(isset($_SESSION["loged"]) && $_SESSION["loged"]=="Cocina"){ ?>
        <li><a id="verMesas" href="#" data-toggle="tab">Ver mesas</a></li>
        <?php } ?>
        <?php if(isset($_SESSION["loged"]) && $_SESSION["loged"]=="Cajero"){ ?>
        <li><a id="getionComida" href="#" data-toggle="tab">Administrar comidas</a></li>
        <li><a id="gestionUsuario" href="#" data-toggle="tab">Gestion Usuarios</a></li>
        <li><a id="historialVentas" href="#" data-toggle="tab">Historial Ventas</a></li>
        <li><a id="cobrar" href="#" data-toggle="tab">Cobrar</a></li>
        <li><a id="grafica" href="#" data-toggle="tab">Grafica de ventas</a></li>
        <?php } ?>
        <?php if(isset($_SESSION["loged"]) && $_SESSION["loged"]=="Mozo"){ ?>
            <li><a id="ordenes" href="#" data-toggle="tab">Ordenes</a></li>
        <?php } ?>
        
        
    </ul>
        
        
    <div id="contenedor">
        <?php include 'PlatosDetalles.php'; ?>
    </div>
</body>
</html>
