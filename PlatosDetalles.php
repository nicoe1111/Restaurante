<?php require_once("Includes/ProcesaInicio.php"); ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>jQuery UI Accordion - Default functionality</title>
        <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
<!--        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
        <script>
            $(function() {
                $( "#accordion" ).accordion();
            });
        </script>
    </head>
    <body>
        
        <div id="accordion" >
            <?php foreach ($ArrayPlatos as $ind=>$plato){ ?>
            <h3><?php echo $plato['nombre']; ?></h3>
            <div>
                <table>
                    <tr>
                        <td>
                            <div><h1> $ <?php echo $plato['precio']; ?> </h1></div>
                            <div><img width="100px" height="100px" alt="<?php echo $plato['nombre']; ?>" src="/Imagenes/ <?php echo $plato['id_plato']; ?>.jpg"/> </div>
                        </td>
                        <td>
                            <h4> <?php echo $plato['descripcion']; ?> </h4>
                        </td>
                    </tr>
                </table>
            </div>
            <?php } ?>
        </div>
    </body>
</html>