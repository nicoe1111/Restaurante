<?php require_once 'ComidaControler.php'; ?>
<form name="formABMcomidas1" action="index.php" method="GET">
    <h3>Seleccionar comida para modificar</h3>
    <div id="tablaComidas">
        <table>
           <?php foreach ($PlatosLista as $ind=>$Rowplato){ ?> 
                <tr>
                    <td>
                        <a class="modificarPlato" id="<?php echo $Rowplato['id_plato']; ?>" href="?ModifPlato=<?php echo $ind; ?>" > <?php echo $Rowplato['nombre']; ?></a>
                    </td>
                    <td>
                        <a id="elimiarPlato" href="?DelPlato=<?php echo $Rowplato['id_plato']; ?>" > <img width="40px" id="" height="40px" src="css/Icono_Eliminar.jpg"/></a>
                    </td>
                </tr>
            <?php } ?>
      </table>
  </div>
</form>