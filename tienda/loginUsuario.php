<?php
include("../admin/configuraciones/baseDeDatos.php");
session_start();
if ($_POST) {
    $emailCliente = $_POST['emailCliente'];
    $contraseña = $_POST['contraseñaDeUsuario'];
    $sql = "SELECT *,COUNT(*) AS usuario_encontrado FROM tabla_clientes WHERE correo_cliente = '$emailCliente' AND contraseña_cliente = '$contraseña' ";
    $execute = mysqli_query($conexion, $sql);
    foreach ($execute as $usuario_encontrado) {
        if ($usuario_encontrado['usuario_encontrado'] == 1) {
            $_SESSION['cliente'] = $usuario_encontrado['nombre_cliente'];
            header("Location: /proyectotienda");
        } else {
            $mensaje = "Error. Correo o contraseña incorrectos.";
        }
    }
}



?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="/proyectotienda/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <div class="card mt-5">
                        <div class="card-header">Inicio de sesión</div>
                        <div class="card-body">
                            <?php if (isset($mensaje)) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong><?php echo $mensaje; ?></strong>
                                </div>
                            <?php } ?>
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label for="emailCliente" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="emailCliente" id="emailCliente"
                                        placeholder="Ingrese su email de cliente" />
                                </div>
                                <div class="mb-3">
                                    <label for="contraseñaDeUsuario" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" name="contraseñaDeUsuario"
                                        id="contraseñaDeUsuario" placeholder="Ingrese su contraseña" />
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Entrar
                                </button>


                            </form>


                        </div>
                    </div>

                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="/proyectotienda/js/bootstrap.min.css"></script>
</body>

</html>