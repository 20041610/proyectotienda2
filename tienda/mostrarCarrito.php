<?php
include("../admin/configuraciones/baseDeDatos.php");
include("templates/cabecera.php");
?>

<?php
if (isset($_POST["agregarCantidad"])) {
    $id_producto = $_POST['id_producto'];
    $nueva_cantidad = (int) $_POST['cantidadesAComprar'];
    $_SESSION['carrito'][$id_producto]['cantidad_producto'] = $nueva_cantidad;
}
?>
<?php if (isset($_POST['sacarProducto'])) {
    $id_producto = $_POST['id_producto'];
    unset($_SESSION['carrito'][$id_producto]);
}


?>
<?php if (!empty($_SESSION['carrito'])) { ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-dark table-bordered">
                        <thead>
                            <h3>Carrito de compras</h3>
                            <tr>
                                <th width="40%" class="text-center" scope="col">Descripcion</th>
                                <th width="15%" class="text-center" scope="col">Cantidad</th>
                                <th width="20%" class="text-center" scope="col">Precio</th>
                                <th width="20%" class="text-center" scope="col">Total</th>
                                <th width="5%" class="text-center" scope="col">Aciones</th>


                            </tr>

                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            <?php foreach ($_SESSION['carrito'] as $indice => $producto) { ?>
                                <tr class="">
                                    <td width="40%" class="text-center"><?php echo $producto['nombre_producto']; ?></td>
                                    <td width="15%" class="text-center">
                                        <form action="" method="post">
                                            <input type="hidden" name="id_producto" value="<?php echo $indice; ?>">
                                            <div class="quantity-selector">
                                                <button type="button" id="decrease"
                                                    onclick="modificarCantidad('<?php echo $producto['id_producto']; ?>', -1)">-</button>
                                                <input type="text" id="<?php echo $producto['id_producto']; ?>"
                                                    value="<?php echo $producto['cantidad_producto']; ?>"
                                                    name="cantidadesAComprar">
                                                <button type="submit" name="agregarCantidad" id="increase"
                                                    onclick="modificarCantidad('<?php echo $producto['id_producto']; ?>', 1)">+</button>

                                            </div>
                                        </form>
                                    </td>
                                    <td width="20%" class="text-center"><?php echo $producto['precio_producto']; ?></td>
                                    <td width="20%" class="text-center">
                                        <?php echo number_format($producto['cantidad_producto'] * $producto['precio_producto']); ?>
                                    </td>
                                    <td width="5%" class="text-center">
                                        <form action="" method="post">
                                            <input type="hidden" name="id_producto" value="<?php echo $indice ?>">
                                            <button type="submit" class="btn btn-danger" name="sacarProducto">
                                                Sacar Producto
                                            </button>

                                        </form>
                                    </td>

                                </tr>
                                <?php $total = $total + ($producto['cantidad_producto'] * $producto['precio_producto']); ?>
                            <?php } ?>

                            <tr>
                                <td colspan="3" align="right">
                                    <h3>Total</h3>
                                </td>
                                <td align="right">
                                    <h3>$<?php echo number_format($total, 2); ?></h3>
                                </td>
                                <td align="right"></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php if (isset($_SESSION['cliente'])) { ?>
                        <form action="pedidoConfirmado.php" method="post">
                            <button name="realizar" type="submit" class="btn btn-primary">
                                Confirmar y enviar pedido
                            </button>
                        </form>
                    <?php } else { ?>
                        <a name="" id="" class="btn btn-primary" href="loginUsuario.php" role="button">Iniciar sesion o
                            registrarse para
                            confirmar</a>

                    <?php } ?>

                <?php } else { ?>

                    <div class="alert alert-primary" role="alert">
                        <strong>No hay productos en el carrito</strong>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php

?>



<?php
include("templates/pie.php");

?>