<?php require_once("OrdenController.php"); ?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>jQuery UI Accordion - Default functionality</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        
        <link rel="stylesheet" href="css/Estilo.css" type="text/css">
        
        <style>
          #feedback { font-size: 1.4em; }
          #platos .ui-selecting { background: #FECA40; }
          #platos .ui-selected { background: #F39814; color: white; }
          #platos { list-style-type: none; margin: 0; padding: 0; width: 100%; }
          #platos li { margin: 3px; padding: 0.4em; font-size: 1em; height: 18px; }
          
          #mesas .ui-selecting { background: #FECA40; }
          #mesas .ui-selected { background: #F39814; color: white; }
          #mesas { list-style-type: none; margin: 0; padding: 0; width: 450px; }
          #mesas li { margin: 3px; padding: 1px; float: left; width: 100px; height: 80px; font-size: 4em; text-align: center; }
          </style>
          <style>
            
            .tableM{
            width: 100%;
            border: 1px solid #F39814;
            color: black;
            }
            .tdM {
                color: black;
                border: 1px solid #F39814;
            }

            .thM{
                background-color: #F39814;
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
                                success: function(response){
                                    var total=0;
                                    var i=0;
                                    $('#tablaTotales').html('');
                                    $('#tablaTotales').append('<tr><th class="thM">' + "Cantidad" + '</th><th class="thM">' + "Plato" + '</th><th class="thM">' + "Precio Unidad" + "</th></tr>");
                                    $.each(response, function(i, item){
                                        i++;
                                        var plato = php_var.filter(function(a){ return a.id_plato === item.id_plato; })[0];
                                        var nombrePlato = plato.nombre;
                                        var precioPlato = plato.precio;
                                        var idOrden = item.id_mesa_plato;
                                        total = total + (precioPlato*item.Cantidad);
                                        $('#tablaTotales').append('<tr id="tr'+i+'"><td id="cantidad'+i+'" class="tdM">' + item.Cantidad + '</td>\n\
                                        <td id="plato'+i+'" class="tdM">' + nombrePlato + '</td><td class="tdM">' + "$"+precioPlato + '</td>\n\
                                        <td class="tdM"><center><input name="BorrarBtn" id="Borrar'+i+'" type="submit" value="Borrar" onclick="return borrar('+i+')"/></center> \n\
                                        <td id="TdId'+i+'" style="visibility:collapse;" class="idTerminar">' +idOrden+ '</td></td></tr>');
                                    });
                                    $('#tablaTotales').append('<tfoot><tr><td class="thM"></td><td class="thM">' + "TOTAL" + '</td><td class="thM">' + "$"+total + "</td></tr></tfoot>");
                                     



                                }
                            });
                        });
                        
                    });
                }
            });
          });
          </script>
          <script>
              var php_var = <?php echo json_encode($ArrayPlatos); ?>;  
              function x(){
              var idPlato = document.getElementById('idPlato').value;
              var idMesa = document.getElementById('idMesa').value;
              var cantidad = document.getElementById('cantidad').value;
              var dataString = 'idPlato=' + idPlato + '&idMesa=' + idMesa + '&cantidad=' + cantidad;
              
                $.ajax({
                    type: "POST",
                    url: "Ordenes/OrdenController.php",
                    data: dataString,
                    cache: false,
                    success: function() {
                             }

                });
              return false;
              }
              function appendRow(cantidad, idPlato) {
                    var plato = php_var.filter(function(a){ return a.id_plato === idPlato; })[0];
                    var nombrePlato = plato.nombre;
                    var precioPlato = plato.precio;
                    var tbl = document.getElementById('tablaTotales'), // table reference
                        row = tbl.insertRow(tbl.rows.length),      // append table row
                        i;
                    // insert table cells to the new row
                    createCell(row.insertCell(0), cantidad, 'row');
                    createCell(row.insertCell(1), nombrePlato, 'row');
                    createCell(row.insertCell(2), precioPlato, 'row');
                }
              function createCell(cell, text, style) {
                    var div = document.createElement('div'), // create DIV element
                        txt = document.createTextNode(text); // create text node
                    div.appendChild(txt);                    // append text node to the DIV
                    div.setAttribute('class', style);        // set DIV class attribute
                    div.setAttribute('className', style);    // set DIV class attribute for IE (?!)
                    cell.appendChild(div);                   // append DIV to the table cell
                }
  
          </script>
         
          <script>
              function y(){
                  var idMesa=document.getElementById('idMesa').value;
                  $.ajax({
                      type: "POST",
                      url: "OrdenesController.php",
                      data:idMesa.serialize(),
                      cache: false
                      
                  });
              }
//                function y(){
//                 var data = idMesa=document.getElementById('idMesa').value;  
//                 $.post("Ordenes/OrdenController.php",function(data){
//
//                 alert(data);
//                 });
//                 return false;
//                 }
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
                             }

                });
              return false;
              }
          </script>
          <script>
              function terminar(){
                  var i = 1;
                  var result = '';
                  var td = '';
                  var aux='a';
                  var x = document.getElementsByClassName("idTerminar");
                  alert(x);
                  alert(x.length);
                  var text[];
                  var len = x.length;
                  for (i = 0; i < len; i++) { 
                        text[i] = x[i].innerHTML;
                        alert(text);
                    }
                  alert(text);

                  alert(result);
                  $.ajax({
                    type: "POST",
                    url: "Ordenes/OrdenController.php",
                    data: text,
                    cache: false,
                    success: function() {
                             alert("!");
                             }

                });
                return false;
            }
          </script>
          
    </head>
    <body>
        <form name="formOrden" id="formOrden" method="POST" >
            <table>
                <tr>
                    <td width="70%">
                        <ol id="platos">
                            <input type="" id="idPlato" name="idPlato" value="" />
                            <?php foreach ($ArrayPlatos as $ind=>$plato){ ?>
                            <li id="<?php echo $plato['id_plato']; ?>" class="ui-widget-content"><?php echo $plato['nombre']; ?> Precio: $<?php echo $plato['precio']; ?></li>
                            <?php } ?>
                        </ol>
                        <input type="number" min="0" name="cantidad" id="cantidad"/>
                        
                    </td>
                    <td>
                        <input type="" id="idMesa" name="idMesa" value="" onchange="y();"/>
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
                    </td>
                    
                </tr>
            </table>
            <input type="submit" id="agregarPlato" name="agregarPlato" value="Agregar Plato" onclick="return x()"/>
            
        </form>
        <form name="form2" id="form2" action="?" method="POST"  enctype="multipart/form-data" >
            
            <div id="myDiv">
                
            <table id="tablaTotales"  class="tableM">
                
                    
            </table>
            </div> 
            <input type="submit" id="finalizarMesa" name="finalizarMesa" value="Finalizar Mesa" onclick="return terminar()"/>
        </form>
        
    </body>
</html>

