<?php

include("../templates_admin/cabecera.php");
include("../configuraciones/baseDeDatos.php");

$sql = "SELECT * FROM tabla_productos";/* Leemos tabla_productos para rescatar
los datos y mostrarlos despues */
$registros = mysqli_query($conexion, $sql); //Leemos la instruccion SELECT

?>
<div class="container">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>Productos</p>
                        <form action="clase_producto.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nombreDelProducto" class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" name="nombreDelProducto" id="nombreDelProducto"
                                    placeholder="Ingrese el nombre del producto" />
                            </div>
                            <div class="mb-3">
                                <label for="precioDelProducto" class="form-label">Precio del producto</label>
                                <input type="number" class="form-control" name="precioDelProducto"
                                    id="precioDelProducto" placeholder="Ingrese el precio del producto" />
                            </div>
                            <div class="mb-3">
                                <label for="categoriaProducto" class="form-label">Categoria del Producto</label>

                                <select class="form-select form-select-lg" name="categoriaProducto">
                                    <option value="Bengalas Lisas">Bengalas Lisas</option>
                                    <option value="Bengalas Pirulines">Bengalas Pirulines</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="imagenDelProducto" class="form-label">Imagen del Producto</label>
                                <input type="file" class="form-control" name="imagenDelProducto" id="imagenDelProducto"
                                    placeholder="Inserte la imagen del producto" />
                            </div>
                            <button type="submit" name="insertar" class="btn btn-primary">
                                Agregar
                            </button>

                        </form>
                    </blockquote>
                </div>
            </div>

        </div>
        <div class="col-7">
            <div class="table">
                <table class="table table-info table-bordered ">
                    <thead>
                        <tr>
                            <th scope="col"> ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Acciones</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($filas = mysqli_fetch_assoc($registros)) { ?>
                            <td>
                                <?php echo $filas['id_producto']; ?>
                            </td>
                            <td>
                                <?php echo $filas['nombre_producto']; ?>
                            </td>
                            <td><?php echo $filas['precio_producto']; ?></td>
                            <td><?php echo $filas['categoria_producto']; ?></td>
                            <td> <img class="imagenCambiante img-thumbnail rounded"
                                    src="../imagenes/<?php echo $filas['imagen_producto']; ?>" width="100" height="50"
                                    alt="imagendelproducto" onclick="AgrandarImagen(this)"></td>
                            <td><?php echo $filas['fecha_creacion']; ?></td>
                            <td><a name="" id="" class="btn btn-warning"
                                    href="editarProducto.php?idAModif=<?php echo $filas['id_producto']; ?>"
                                    role="button">Actualizar</a>
                                <a name="" id="" class="btn btn-danger"
                                    href="clase_producto.php?idABorrar=<?php echo $filas['id_producto']; ?>"
                                    role="button">Eliminar</a>

                            </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php

include("../templates_admin/pie.php");

?>