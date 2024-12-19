<?php

session_start();
echo "carrito conectado";
if (isset($_POST['btnAccion'])) {
    switch ($_POST['btnAccion']) {
        case 'AgregarLisas':
            include("../admin/configuraciones/baseDeDatos.php");
            if (is_numeric(openssl_decrypt($_POST['txtID'], COD, KEY))) {
                $id_producto = openssl_decrypt($_POST['txtID'], COD, KEY);
                $mensaje .= "Id correcto" . $id_producto;
            } else {
                $mensaje . "Error. Id incorrecto" . $id_producto;
                break;
            }
            if (is_string(openssl_decrypt($_POST['nombre_producto'], COD, KEY))) {
                $nombre_producto = openssl_decrypt($_POST['nombre_producto'], COD, KEY);
                $mensaje .= "Nombre correcto" . $nombre_producto;
            } else {
                $mensaje . "Error. Nombre incorrecto" . $nombre_producto;
                break;
            }
            if (is_string(openssl_decrypt($_POST['precio_producto'], COD, KEY))) {
                $precio_producto = openssl_decrypt($_POST['precio_producto'], COD, KEY);
                $mensaje .= "Producto correcto" . $precio_producto;
            } else {
                $mensaje . "Error. Precio incorrecto" . $precio_producto;
                break;
            }
            $cantidad_producto = $_POST['cantidadesAComprar'];
            $mensaje .= "Cantidad: " . $cantidad_producto;

            //Declaracion del carrito de compras y su carga de datos
            if (!isset($_SESSION['carrito'])) {
                $producto = array(
                    'id_producto' => $id_producto,
                    'nombre_producto' => $nombre_producto,
                    'precio_producto' => $precio_producto,
                    'cantidad_producto' => $cantidad_producto

                );
                $_SESSION['carrito'][0] = $producto;
                $mensaje = "Producto agregado al carrito";
                header("Location: /proyectotienda/tienda/bengalasLisas.php?mensaje=" . $mensaje);
            } else {
                $numero_productos = count($_SESSION['carrito']);
                $producto = array(
                    'id_producto' => $id_producto,
                    'nombre_producto' => $nombre_producto,
                    'precio_producto' => $precio_producto,
                    'cantidad_producto' => $cantidad_producto

                );
                $_SESSION['carrito'][$numero_productos] = $producto;
                $mensaje = "Producto agregado al carrito";
                header("Location: /proyectotienda/tienda/bengalasLisas.php?mensaje=" . $mensaje);
            }
            break;
        case "AgregarPirulines":

            include("../admin/configuraciones/baseDeDatos.php");
            if (is_numeric(openssl_decrypt($_POST['txtID'], COD, KEY))) {
                $id_producto = openssl_decrypt($_POST['txtID'], COD, KEY);
                $mensaje .= "Id correcto" . $id_producto;
            } else {
                $mensaje . "Error. Id incorrecto" . $id_producto;
                break;
            }
            if (is_string(openssl_decrypt($_POST['nombre_producto'], COD, KEY))) {
                $nombre_producto = openssl_decrypt($_POST['nombre_producto'], COD, KEY);
                $mensaje .= "Nombre correcto" . $nombre_producto;
            } else {
                $mensaje . "Error. Nombre incorrecto" . $nombre_producto;
                break;
            }
            if (is_string(openssl_decrypt($_POST['precio_producto'], COD, KEY))) {
                $precio_producto = openssl_decrypt($_POST['precio_producto'], COD, KEY);
                $mensaje .= "Producto correcto" . $precio_producto;
            } else {
                $mensaje . "Error. Precio incorrecto" . $precio_producto;
                break;
            }
            $cantidad_producto = $_POST['cantidadesAComprar'];
            $mensaje .= "Cantidad: " . $cantidad_producto;

            //Declaracion del carrito de compras y su carga de datos
            if (!isset($_SESSION['carrito'])) {
                $producto = array(
                    'id_producto' => $id_producto,
                    'nombre_producto' => $nombre_producto,
                    'precio_producto' => $precio_producto,
                    'cantidad_producto' => $cantidad_producto

                );
                $_SESSION['carrito'][0] = $producto;
                $mensaje = "Producto agregado al carrito";
                header("Location: /proyectotienda/tienda/bengalasPirulines.php?mensaje=" . $mensaje);
            } else {
                $numero_productos = count($_SESSION['carrito']);
                $producto = array(
                    'id_producto' => $id_producto,
                    'nombre_producto' => $nombre_producto,
                    'precio_producto' => $precio_producto,
                    'cantidad_producto' => $cantidad_producto

                );
                $_SESSION['carrito'][$numero_productos] = $producto;
                $mensaje = "Producto agregado al carrito";
                header("Location: /proyectotienda/tienda/bengalasPirulines.php?mensaje=" . $mensaje);
            }
            break;
    }
}
