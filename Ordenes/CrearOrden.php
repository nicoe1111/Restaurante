<?php require_once("OrdenController.php"); ?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Ordenes</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        
        <link rel="stylesheet" href="css/Estilo.css" type="text/css">
        
        <style>
          #feedback { font-size: 1.4em; }
          #platos .ui-selecting { background: #2aabd2; }
          #platos .ui-selected { background: #28a4c9; color: white; }
          #platos { list-style-type: none; margin: 0; padding: 0; width: 100%; }
          #platos li { margin: 3px; padding: 0em; font-size: 1em; height: 25px; text-align: center;}
          
          #mesas .ui-selecting { background: #2aabd2; }
          #mesas .ui-selected { background: #28a4c9; color: white; }
          #mesas { list-style-type: none; margin: 0; padding: 0; width: 450px; }
          #mesas li { margin: 3px; padding: 1px; float: left; width: 100px; height: 80px; font-size: 4em; text-align: center; }
          </style>
          <style>
            
            .tableM{
            width: 100%;
            border: 1px solid #28a4c9;
            color: black;
            }
            .tdM {
                color: black;
                border: 1px solid #28a4c9;
            }

            .thM{
                background-color: #28a4c9;
                color: white;
            }
</style>
          <script>
              $(function() {
                $( "#platos" ).selectable({
                  stop: function() {
                    var result = $( "#select-result" ).empty();
                    $( ".ui-selected", this ).each(function() {
                        $( "#platos li" ).click(function(){document.getElementById('idPlato').value = $( "#platos .ui-selected" ).attr('id');})
                    });
                  }
                });
              });
              $(function() {
                $("#platos").selectable({
                      selecting: function(event, ui){
                            if( $("#platos .ui-selected, #platos .ui-selecting").length > 1){
                                  $(ui.selecting).removeClass("#platos ui-selecting");
                            }
                      }
                });
               });
          </script>
          <script>
          var php_var = <?php echo json_encode($ArrayPlatos); ?>;    
          $(function() {
            $( "#mesas" ).selectable({
                  stop: function() {
                    var result = $( "#select-result" ).empty();
                    $( ".ui-selected", this ).each(function() {
                        $( "#mesas li" ).click(function(){document.getElementById('idMesa').value = $( "#mesas .ui-selected" ).text();
                            var mesa = 'Mesa=' + document.getElementById('idMesa').value;
                            $.ajax({
                                type: "POST",
                                url: "Ordenes/OrdenController.php",
                                data: mesa,
                                dataType: "json",
                                success: function recargar(response){
                                    var total=0;
                                    var i=0;
                                    $('#tablaTotales').html('');
                                    $('#tablaTotales').append('<tr><th class="thM">' + "Cantidad" + '</th><th class="thM">' + "Plato" + '</th><th class="thM">' + "Precio Unidad" + '</th><th class="thM"></th><th class="thM"></th></tr>');
                                    $.each(response, function(i, item){
                                        i++;
                                        var plato = php_var.filter(function(a){ return a.id_plato === item.id_plato; })[0];
                                        var nombrePlato = plato.nombre;
                                        var precioPlato = plato.precio;
                                        var idOrden = item.id_mesa_plato;
                                        total = total + (precioPlato*item.Cantidad);
                                        $('#tablaTotales').append('<tr id="tr'+i+'"><td id="cantidad'+i+'" class="tdM">' + item.Cantidad + '</td>\n\
                                        <td id="plato'+i+'" class="tdM">' + nombrePlato + '</td><td class="tdM">' + "$"+precioPlato + '</td>\n\
                                        <td class="tdM"><center><input name="BorrarBtn" class="btn btn-xs btn-danger" id="Borrar'+i+'" type="submit" value="Borrar" onclick="return borrar('+i+')"/></center> \n\
                                        <td id="TdId'+i+'" style="display:none;" class="idTerminar">' +idOrden+ '</td></td></tr>');
                                    });
                                    $('#tablaTotales').append('<tfoot><tr><td class="thM"></td><td class="thM"><b>' + "TOTAL" + '</b></td><td class="thM"><b>' + "$"+total + '</b></td><td class="thM"></td><td class="thM"></td></tr></tfoot>');
                                     



                                }
                            });
                        });
                        
                    });
                }
            });
          });
          $(function() {
                $("#mesas").selectable({
                      selecting: function(event, ui){
                            if( $("#mesas .ui-selected, #mesas .ui-selecting").length > 1){
                                  $(ui.selecting).removeClass("#mesas ui-selecting");
                            }
                      }
                });
         });
          </script>
          <script>
              var php_var = <?php echo json_encode($ArrayPlatos); ?>;  
              function agregar(){
              var idPlato = document.getElementById('idPlato').value;
              var idMesa = document.getElementById('idMesa').value;
              var cantidad = document.getElementById('cantidad').value;
              var dataString = 'idPlato=' + idPlato + '&idMesa=' + idMesa + '&cantidad=' + cantidad;
                $.ajax({
                    type: "POST",
                    url: "Ordenes/OrdenController.php",
                    data: dataString,
                    cache: false,
                    success: function(datos) {
                            $('#mesas .ui-selected').click();
                    }
                });
              return false;
              }
              
  
          </script>
         
          
          
          <script>
              
              function borrar(a){
              var td='TdId'+a;
              
              var dataString = document.getElementById(td).innerHTML;
              $.ajax({
                    type: "POST",
                    url: "Ordenes/OrdenController.php",
                    data: "BorrarOrden= " + dataString,
                    cache: false,
                    success: function() {
                             alert("Pedido eliminado correctamente!");
                             $('#mesas .ui-selected').click();
                             }

                });
              return false;
              };
          </script>
          <script>
              function terminar(){
                  var elements = document.getElementsByClassName("idTerminar");
                  var res = [];
                    for(var i = 0, length = elements.length; i < length; i++) {

                            res[i]=elements[i].innerHTML;
                            
                    }
                  
                  
                  $.ajax({
                    type: "POST",
                    url: "Ordenes/OrdenController.php",
                    cache: false,
                    data: {idTerminar:res},
                    success: function() {
                             alert("Orden enviada para cobro correctamente!");
                             $('#mesas .ui-selected').click();
                             }

                  
                  });
                  return false;
            }
          </script>
          
    </head>
    <body>
        <form name="formOrden" id="formOrden" method="POST" >
            <div class="row">
                <div class="col-sm-4">
                        <label for="platos"><h2>Platos:</h2></label>
                        <ol id="platos">
                            <input type="hidden" id="idPlato" name="idPlato" value="" />
                            <?php foreach ($ArrayPlatos as $ind=>$plato){ ?>
                            <li id="<?php echo $plato['id_plato']; ?>" class="ui-widget-content"><?php echo $plato['nombre']; ?> $<?php echo $plato['precio']; ?></li>
                            <?php } ?>
                        </ol>
                        <labale for="cantidad"><b>Cantidad:</b></labale>
                        <input type="number" min="1" name="cantidad" id="cantidad" value="1"/>
                        <input type="submit" id="agregarPlato" name="agregarPlato" value="Agregar Plato" onclick="return agregar()" class="btn btn-info btn-sm"/>
                </div>
                <div class="col-sm-6">
                    <input type="hidden" id="idMesa" name="idMesa" value="" onchange=""/>
                    <label for="mesas"><h2>Mesas:</h2></label>
                    <ol id="mesas">
                        <li class="ui-state-default">1</li>
                        <li class="ui-state-default">2</li>
                        <li class="ui-state-default">3</li>
                        <li class="ui-state-default">4</li>
                        <li class="ui-state-default">5</li>
                        <li class="ui-state-default">6</li>
                        <li class="ui-state-default">7</li>
                        <li class="ui-state-default">8</li>
                        <li class="ui-state-default">9</li>
                        <li class="ui-state-default">10</li>
                        <li class="ui-state-default">11</li>
                        <li class="ui-state-default">12</li>
                    </ol>  
                            
                    
                </div>
            </div>
            
        </form>
        <div id="myDiv">
        <form name="form2" id="form2" action="?" method="POST"  enctype="multipart/form-data" >
            
            <div id="myDiv">
                
            <table id="tablaTotales"  class="tableM">
                
                    
            </table>
            </div> 
            <input type="submit" id="finalizarMesa" name="finalizarMesa" value="Finalizar Mesa" onclick="return terminar()" class="btn  btn-success btn-sm"/>
        </form>
        </div>
        
    </body>
</html>

                    
