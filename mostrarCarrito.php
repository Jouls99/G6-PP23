<?php
include 'global/config.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>
<br>
<h3>Lista del carrito</h3>
<?php if (!empty($_SESSION['CARRITO'])) { ?>
    
<table class="table table-light table-bordered">
    <tbody>
        <tr>
            <th width="40%">Descripcion</th>
            <th width="15%">Cantidad</th>
            <th width="20%">Precio</th>
            <th width="20%">Total</th>
            <th width="5%">--</th>
        </tr>
        <?php $total=0; ?>
        <?php foreach($_SESSION['CARRITO'] as $indice=>$PRODUCTO) {?>
        <tr>
            <td width="40%"><?php echo $PRODUCTO['Nombre'] ?></td>
            <td width="15%" class="text-center"><?php echo $PRODUCTO['cantidad'] ?></td>
            <td width="20%" class="text-center"><?php echo $PRODUCTO['Precio'] ?></td>
            <td width="20%" class="text-center"><?php echo number_format($PRODUCTO['Precio']*$PRODUCTO['cantidad'],2)  ?></td>
            <td width="5%">
                <form action="" method="post">
                    <input type="hidden" name="ID" id="ID" value="<?php echo openssl_encrypt($PRODUCTO['ID'],COD,KEY) ; ?>">
                    <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button></td>
                </form>
        </tr>
        <?php $total=$total+($PRODUCTO['Precio']*$PRODUCTO['cantidad']); ?>
        <?php }?>
        
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="right"><h3>$<?php echo number_format($total,2) ?></h3></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">

                <form action="remito.php" method="post">
                    <div class="alert alert-success" role="alert">
                        <div class="form-group">
                        <label for="my-input">Confirme su pedido</label>
                        
                        </div>
                        <small id="Help" class="form-text text-muted" >Los productos se encuentran en proceso de preparación....</small>
                    </div>
                <button class="btn btn-primary btn-lg btn-block" type="butto" name="btnAccion" value="Proceder">Confirmar Pedido >> </button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
<?PHP }else{ ?>
    <div class="alert alert-success" role="alert">
        No hay productos en el carrito
    </div>
<?PHP }?>
<?php
include 'templates/pie.php';
?>