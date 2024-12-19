<?php
include("../admin/configuraciones/baseDeDatos.php");
include("./carrito.php");
$carrito = $_SESSION['carrito'];
if (isset($_POST['realizar'])) {

    $total = 0;
    $mensaje = "Pedido enviado con exito.";
    $sid = session_id();

    // Obtener el id del usuario actual desde la sesión
    $select = "SELECT * FROM tabla_clientes WHERE nombre_cliente = '{$_SESSION['cliente']}'";
    $result = mysqli_query($conexion, $select);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Error: Usuario no encontrado.");
    }
    $id_cliente = $row['id_cliente']; //Para insertarlo en tabla_pedidos y registrar al usuario que hizo el pedido
    $correo_cliente = $row['correo_cliente']; //Para registrar su correo en tabla_pedidos

    foreach ($carrito as $indice => $producto) {
        $total = $total + ($producto['cantidad_producto'] * $producto['precio_producto']);
    }
    $sql = "INSERT INTO tabla_pedidos(id_cliente,clave_transaccion,fecha_pedido,correo,total_pedido) VALUES ('$id_cliente','$sid', NOW(), '$correo_cliente', '$total' )";
    $execute = mysqli_query($conexion, $sql);
    $idPedido = mysqli_insert_id($conexion);



    foreach ($carrito as $indice => $producto) {
        $sql2 = "INSERT INTO tabla_detalle_pedidos (id_pedido, id_producto, precio_unitario, cantidad_producto) VALUES ('$idPedido', '$producto[id_producto]', '$producto[precio_producto]', '$producto[cantidad_producto]')";
        $execute2 = mysqli_query($conexion, $sql2);
        unset($_SESSION['carrito']);
    }
}


/*if ($sql2) {
    $sql3 = "SELECT * FROM tabla_detalle_pedidos, tabla_productos 
    WHERE tabla_detalle_pedidos.id_producto = tabla_productos.id_producto
    AND tabla_detalle_pedidos.id_venta = $idVenta";
    $execute3 = mysqli_query($conexion, $sql3);
}*/

?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="/proyectotienda/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div>
                        <h1>¡Listo. Tu pedido fue enviado con éxito.!</h1>
                        <h4>Te avisaremos cuando esté terminado.</h4>
                        <a name="" id="" class="btn btn-primary" href="/proyectotienda/tienda/historialPedidos.php"
                            role="button">Ver el pedido</a>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="/proyectotienda/js/bootstrap.min.css"></script>
</body>

</html>