<?php require_once("Class/ClassMySql.php");?>
    <head>
        <meta charset="utf-8">
        <title>jQuery UI Accordion - Default functionality</title>
        <script>
            $(function() {
                $("#accordion").accordion({
                    heightStyle: "200px",
                    collapsible: true,
                    active: true,
                    activate: function( event, ui ) {
                            $("#accordion").animate({ scrollTop: ui.newHeader.offset().top }, 'slow');
                    }
                });
            });
        </script>
    </head>
    <body>
        
        <div id="accordion">
            <?php 
            	$ObjAcceso = new AccesoMySql();		
		$ArrayCategoriaPlatos = array();
		$ArrayCategoriaPlatos = $ObjAcceso->CargarCategoriaPlatos();
                
            foreach ($ArrayCategoriaPlatos as $ind=>$Categoria){ ?>
            <h3><?php echo $Categoria['tipo']; ?></h3>
                 <?php 	$ObjAcceso1 = new AccesoMySql();		
                        $ArrayPlatos = array();
                        $ArrayPlatos = $ObjAcceso1->CargarPlatosCategoria($Categoria['tipo']);?> 
                       
            <div class="container">
                <?php foreach ($ArrayPlatos as $ind=>$plato){ ?> 
                <div class="content"> 
                    <table>
                        <tr>
                            <td>
                                <div style="width: 150px"><h1> $ <?php echo $plato['precio']; ?> </h1></div>
                            </td>
                            <td>
                               <div style="width: 400px"><img width="300px" height="200px" alt="<?php echo $plato['nombre']; ?>" src="Imagenes/<?php echo $plato['imagen']; ?>"/> </div>    
                            </td>
                            <td>
                                <h4> <?php echo $plato['descripcion']; ?> </h4>
                            </td>
                        </tr>
                    </table>
                 </div>
            <?php } ?>
            </div>
            <?php }?>
        </div>
    </body>
