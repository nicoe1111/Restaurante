<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Tabs</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
</head>
<body>
 
    <div id="tabs" class="contenedor">
  <ul>
    <li><a href="#tabs-1">Ver carta comidas</a></li>
    <li><a href="#tabs-2">Ver mesas</a></li>
    <li><a href="#tabs-3">Cerrar mesa</a></li>
    <li><a href="#tabs-4">Historial de ventas</a></li>
    <li><a href="#tabs-5">Confirmar plato</a></li>
    <li><a href="#tabs-6">Administrar comidas</a></li>
  </ul>
  <div id="tabs-1">
    <?php include("PlatosDetalles.php"); ?>
  </div>
  <div id="tabs-2">
    <p>Aca lista de mesas con detalle de compras</p>
  </div>
  <div id="tabs-3">
    <p>Aca session de cajero lista de mesas abiertas y puede cerrar</p>
  </div>
  <div id="tabs-4">
    <p>Historial de ventas</p>
  </div>
  <div id="tabs-5">
    <p>Cocinero ve los pedidos y los confirma</p>
  </div>
  <div id="tabs-6">
    <?php Require_once("AdmComidas.php");?>
  </div>

</div>
 
 
</body>
</html>