<?php
include("../admin/configuraciones/baseDeDatos.php");
include("templates/cabecera.php");
$query = "SELECT * FROM tabla_productos WHERE categoria_producto = 'Bengalas Pirulines'";
$registros = mysqli_query($conexion, $query);

?>




<?php
if (isset($_GET['mensaje'])) { ?>
    <div class="alert alert-success">
        <?php echo $_GET['mensaje']; ?>
    </div>

<?php } ?>


<div class="container container-productos">
    <div class="row">
        <?php foreach ($registros as $registro) { ?>
            <div class=" col-6 col-md-3 col-lg-2">
                <div class="card mt-3">
                    <img src="../admin/imagenes/<?php echo $registro['imagen_producto']; ?>" alt="ImagenDelProducto"
                        class="card-img-top img-card-pirulines">
                    <div class=" card-body card-body-cliente">
                        <h6 class="card-title text-center"><?php echo $registro['nombre_producto']; ?></h6>
                        <p><?php echo '$' . $registro['precio_producto']; ?></p>

                        <form action="carrito.php" method="post" class="form-productos">
                            <div class="quantity-selector ">
                                <button type="button" id="decrease"
                                    onclick="modificarCantidad('<?php echo $registro['id_producto']; ?>', -1)">-</button>
                                <input type="text" id="<?php echo $registro['id_producto']; ?>" value="0"
                                    name="cantidadesAComprar">
                                <button type="button" id="increase"
                                    onclick="modificarCantidad('<?php echo $registro['id_producto']; ?>', 1)">+</button>
                            </div>
                            <input type="hidden" readonly
                                value="<?php echo openssl_encrypt($registro['id_producto'], COD, KEY); ?>" name="txtID"
                                id="txtID">
                            <input type="hidden" readonly
                                value="<?php echo openssl_encrypt($registro['nombre_producto'], COD, KEY); ?>"
                                name="nombre_producto">
                            <input type="hidden" readonly
                                value="<?php echo openssl_encrypt($registro['precio_producto'], COD, KEY); ?>"
                                name="precio_producto">

                            <button type="submit" name="btnAccion" value="AgregarLisas"
                                class="btn btn-success mt-1 boton-agregar">
                                Agregar al carrito
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

<?php include("templates/pie.php"); ?>