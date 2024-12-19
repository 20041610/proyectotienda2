<?php
include("../templates_admin/cabecera.php");
include("../configuraciones/baseDeDatos.php");
if (isset($_GET['idAModif'])) {
    $select = "SELECT * FROM tabla_productos WHERE id_producto = ('$_GET[idAModif]') ";
    $execute = mysqli_query($conexion, $select);
    $registro = mysqli_fetch_assoc($execute);
}
?>


<div class="container">
    <div class="row">
        <div class="col-4">

        </div>
        <div class="col-4 mt-3">
            <div class="card">
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>Editar Producto</p>
                        <form action="clase_producto.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nombreDelProducto" class="form-label">Nombre del Producto</label>
                                <input type="text" value="<?php echo $registro['nombre_producto']; ?>"
                                    class="form-control" name="nombreDelProducto" id="nombreDelProducto"
                                    placeholder="Ingrese el nombre del producto" />
                            </div>
                            <div class="mb-3">
                                <label for="precioDelProducto" class="form-label">Precio del producto</label>
                                <input type="number" value="<?php echo $registro['precio_producto']; ?>"
                                    class="form-control" name="precioDelProducto" id="precioDelProducto"
                                    placeholder="Ingrese el precio del producto" />
                            </div>
                            <div class="mb-3">
                                <label for="categoriaProducto" class="form-label">Categoria del Producto</label>
                                <select class="form-select form-select-lg" name="categoriaProducto">
                                    <option selected value="<?php echo $registro['categoria_producto']; ?>">
                                        <?php echo $registro['categoria_producto']; ?></option>
                                    <option value="Bengalas Lisas">Bengalas Lisas</option>
                                    <option value="Bengalas Pirulines">Bengalas Pirulines</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="imagenDelProducto" class="form-label">Imagen del producto: <img
                                        class="img-thumbnail rounded"
                                        src="../imagenes/<?php echo $registro['imagen_producto']; ?>" width="100"
                                        height="50" alt="imagendelproducto"></label>
                                <input type="file" class="form-control" name="imagenDelProducto" id="imagenDelProducto"
                                    placeholder="Inserte la imagen del producto" />
                            </div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="idAModif"
                                    value="<?php echo $registro['id_producto']; ?>" />
                            </div>

                            <button type="submit" name="modificar" class="btn btn-primary">
                                Guardar Cambios
                            </button>
                            <a class="btn btn-danger" href="index.php" role="button">Cancelar</a>



                        </form>

                    </blockquote>
                </div>
            </div>

        </div>
        <div class="col-4">

        </div>
    </div>
</div>
<?php
include("../templates_admin/pie.php");
?>