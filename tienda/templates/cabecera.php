<?php
$url = "http://localhost/proyectotienda/";
session_start()
    ?>

<!doctype html>
<html lang="en">


<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="http://localhost/proyectotienda/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/proyectotienda/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-success">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Bengalas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav text-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/proyectotienda/">Inicio</a>
                    </li>
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" id="triggerId"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Productos
                        </button>
                        <div class="dropdown-menu" aria-labelledby="triggerId">
                            <a class="dropdown-item" href="/proyectotienda/tienda/bengalasLisas.php">Bengalas
                                Lisas</a>
                            <a class="dropdown-item" href="/proyectotienda/tienda/bengalasPirulines.php">Bengalas
                                Pirulines</a>
                        </div>
                    </div>

                    <li class="nav-item">
                        <a class="nav-link" href="/proyectotienda/tienda/mostrarCarrito.php">Carrito
                            (<?php echo (isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : "0") ?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/proyectotienda/admin/">Administrador</a>
                    </li>
                </ul>

                <ul class="navbar-nav text-center ms-auto">
                    <?php if (!isset($_SESSION['cliente'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/proyectotienda/tienda/loginUsuario.php">Iniciar Sesion</a>
                        </li>
                    <?php } else { ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/proyectotienda/admin/"><?php echo $_SESSION['cliente']; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/proyectotienda/tienda/historialPedidos.php">Ver Pedidos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/proyectotienda/tienda/cerrarSesionUsuario.php">Cerrar Sesion</a>
                        </li>
                    <?php } ?>

                </ul>

            </div>
        </div>
    </nav>


    <main>