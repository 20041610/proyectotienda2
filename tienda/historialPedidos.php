<?php
include("../admin/configuraciones/baseDeDatos.php");
include("./templates/cabecera.php");
// Obtener el id del usuario actual desde la sesión
$select = "SELECT * FROM tabla_clientes WHERE nombre_cliente = '{$_SESSION['cliente']}'";
$result = mysqli_query($conexion, $select);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Error: Usuario no encontrado.");
}
$id_cliente = $row['id_cliente']; //Para buscar pedidos segun el id del usuario

$sql = "SELECT 
    tped.id_pedido,
    tped.clave_transaccion, 
    tped.fecha_pedido, 
    tped.total_pedido, 
    tped.status_pedido,
    tdp.cantidad_producto, 
    tdp.precio_unitario,
    tp.nombre_producto
FROM 
    tabla_pedidos tped
INNER JOIN 
    tabla_detalle_pedidos tdp 
ON 
    tped.id_pedido = tdp.id_pedido
INNER JOIN 
    tabla_productos tp
ON 
    tdp.id_producto = tp.id_producto
WHERE 
    tped.id_cliente = $id_cliente
ORDER BY 
    tped.fecha_pedido DESC, tped.id_pedido, tp.nombre_producto";

$execute = mysqli_query($conexion, $sql);

$pedidos = array();
while ($registro = mysqli_fetch_assoc($execute)) {
    $id_pedido = $registro['id_pedido'];
    if (!isset($pedidos[$id_pedido])) {
        $pedidos[$id_pedido] = [
            'fecha_pedido' => $registro['fecha_pedido'],
            'total_pedido' => $registro['total_pedido'],
            'status_pedido' => $registro['status_pedido'],
            'productos' => []
        ];
    }
    $pedidos[$id_pedido]['productos'][] = [
        'nombre_producto' => $registro['nombre_producto'],
        'cantidad' => $registro['cantidad_producto'],
        'precio_unitario' => $registro['precio_unitario']
    ];
}

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="table mt-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Total</th>
                            <th scope="col">Acciones</th>
                            <th scope="col">Estado actual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $id_pedido => $pedido) { ?>
                            <tr class="">
                                <td scope="row"><?php echo $id_pedido; ?></td>
                                <td><?php echo $pedido['fecha_pedido']; ?></td>
                                <td><?php echo "$" . $pedido['total_pedido']; ?></td>
                                <td>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#<?php echo $id_pedido; ?>" aria-expanded="false"
                                        aria-controls="detallesPedido<?php echo $id_pedido; ?>">
                                        Ver Detalles
                                    </button>
                                </td>
                                <td><?php echo $pedido['status_pedido']; ?></td>
                            </tr>

                            <tr class="collapse table-dark" id="<?php echo $id_pedido; ?>">
                                <td colspan="6">
                                    <strong>Detalles del Pedido:</strong>
                                    <div class="table">
                                        <table class="table table-warning table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Productos</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Precio Unitario</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pedido['productos'] as $producto) { ?>
                                                    <tr>
                                                        <td width="40%"><?php echo $producto['nombre_producto']; ?></td>
                                                        <td><?php echo $producto['cantidad']; ?></td>
                                                        <td><?php echo "$" . $producto['precio_unitario']; ?></td>
                                                        <td class="">
                                                            <?php echo "$" . ($producto['cantidad'] * $producto['precio_unitario']); ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan="3" align="right">
                                                    </td>

                                                    <td colspan="2" align="left">
                                                        <h3>Subtotal:
                                                            $<?php echo number_format($pedido['total_pedido'], 2); ?></h3>

                                                    </td>

                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
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
include("./templates/pie.php");

?>