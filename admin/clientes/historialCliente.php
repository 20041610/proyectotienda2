<?php
include("../templates_admin/cabecera.php");
include("../configuraciones/baseDeDatos.php");

if (isset($_GET["txtID"])) {
    $txtID = $_GET["txtID"];
}
$sql = "SELECT
c.nombre_cliente,
p.id_pedido,
p.fecha_pedido, 
p.total_pedido, 
p.status_pedido,
dp.cantidad_producto, 
dp.precio_unitario,
pr.nombre_producto
FROM
tabla_clientes AS c
INNER JOIN 
tabla_pedidos AS p
ON
c.id_cliente = p.id_cliente
INNER JOIN 
tabla_detalle_pedidos AS dp 
ON p.id_pedido = dp.id_pedido
INNER JOIN 
tabla_productos AS pr
ON dp.id_producto = pr.id_producto
WHERE c.id_cliente = '$txtID'
ORDER BY 
p.fecha_pedido DESC, p.id_pedido, pr.nombre_producto";

$registros = mysqli_query($conexion, $sql);
?>
<?php
if (isset($_POST['cambiarEstado'])) {
    $id_pedido = $_POST['id_pedido'];
    $estadoDelPedido = $_POST['estadoDelPedido'];
    $update = "UPDATE tabla_pedidos SET status_pedido = '$estadoDelPedido' WHERE id_pedido = '$id_pedido'";
    $execute = mysqli_query($conexion, $update);
    header("Location: /proyectotienda/admin/pedidos.php");
}
?>
<?php
$arrayDePedidos = array(); //Para guardar los pedidos y su informacion(cliente, productos, cantidad, etc)
while ($registro = mysqli_fetch_assoc($registros)) {
    $id_pedido = $registro['id_pedido'];
    if (!isset($arrayDePedidos[$id_pedido])) {
        $arrayDePedidos[$id_pedido] = [
            'cliente' => $registro['nombre_cliente'],
            'fecha_pedido' => $registro['fecha_pedido'],
            'total_pedido' => $registro['total_pedido'],
            'status_pedido' => $registro['status_pedido'],
            'productos' => []
        ];
    }
    $arrayDePedidos[$id_pedido]['productos'][] = [
        'nombre_producto' => $registro['nombre_producto'],
        'cantidad' => $registro['cantidad_producto'],
        'precio_unitario' => $registro['precio_unitario']
    ];
}


?>
<h1 class="titulo text-center text-primary mb-4">Página de Pedidos</h1>

<!-- Página de Pedidos -->
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="table mt-5">
                <table class="table table-bordered">
                    <thead>
                        <tr colspan="6">
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Acciones</th>
                            <th>Estado actual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($arrayDePedidos as $id_pedido => $pedido) { ?>
                            <tr>
                                <td><?php echo $id_pedido; ?></td>
                                <td><?php echo $pedido['cliente']; ?></td>
                                <td><?php echo $pedido['fecha_pedido']; ?></td>
                                <td><?php echo "$" . $pedido['total_pedido']; ?></td>
                                <td>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#detalles_<?php echo $id_pedido; ?>">
                                        Ver Detalles
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                        data-bs-target="#modal_<?php echo $id_pedido; ?>">
                                        <?php echo $pedido['status_pedido']; ?>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal_<?php echo $id_pedido; ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Estado actual del pedido ID
                                                        <?php echo $id_pedido; ?>
                                                    </h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post">
                                                        <input type="hidden" name="id_pedido"
                                                            value="<?php echo $id_pedido; ?>">
                                                        <label for="estadoDelPedido_<?php echo $id_pedido; ?>"
                                                            class="form-label">Cambiar estado:</label>
                                                        <select name="estadoDelPedido"
                                                            id="estadoDelPedido_<?php echo $id_pedido; ?>"
                                                            class="form-select">
                                                            <option selected><?php echo $pedido['status_pedido']; ?>
                                                            </option>
                                                            <option value="Pedido en elaboración">Pedido en elaboración
                                                            </option>
                                                            <option value="Pedido terminado">Pedido terminado</option>
                                                            <option value="Pedido no iniciado">Pedido no iniciado</option>
                                                        </select>
                                                        <button type="submit" name="cambiarEstado"
                                                            class="btn btn-primary mt-3">Guardar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="collapse" id="detalles_<?php echo $id_pedido; ?>">
                                <td colspan="6">
                                    <!-- Detalles del pedido -->
                                    <strong>Detalles del Pedido:</strong>
                                    <div class="table mt-2">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio Unitario</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pedido['productos'] as $producto) { ?>
                                                    <tr>
                                                        <td><?php echo $producto['nombre_producto']; ?></td>
                                                        <td><?php echo $producto['cantidad']; ?></td>
                                                        <td><?php echo "$" . $producto['precio_unitario']; ?></td>
                                                        <td><?php echo "$" . ($producto['cantidad'] * $producto['precio_unitario']); ?>
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
include("../templates_admin/pie.php");
?>