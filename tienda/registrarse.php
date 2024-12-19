<?php
include("templates/cabecera.php");
include("../admin/configuraciones/baseDeDatos.php");
include("../admin/configuraciones/claseValidaciones.php");


if (isset($_POST['registroConfirmado'])) {
    $mensaje = "";
    $resultado = Validador::validar_nombre($_POST['nombreCliente']);
    if ($resultado['error']) {
        $mensaje = $resultado['error'];
    } else {
        $nombreCliente = $resultado['nombre'];
    }
    //validar apellido
    $resApellido = Validador::validar_apellido($_POST['apellidoCliente']);
    if ($resApellido['error']) {
        $mensaje = $resApellido['error'];
    } else {
        $apellidoCliente = $resApellido['apellido'];
    }
    //Validar email
    $resEmail = Validador::validar_email($_POST['emailCliente']);
    if ($resEmail['error']) {
        $mensaje = $resEmail['error'];
    } else {
        $emailCliente = $resEmail['email'];
    }
    //validar direccion
    $resDireccion = Validador::validar_direccion($_POST['direccionEnvio']);
    if ($resDireccion['error']) {
        $mensaje = $resDireccion['error'];
    } else {
        $direccionEnvio = $resDireccion['direccionEnvio'];
    }
    //validar numero de la direccion
    $resNumDireccion = Validador::validar_numero_direccion($_POST['numerodireccionEnvio']);
    if ($resNumDireccion['error']) {
        $mensaje = $resNumDireccion['error'];
    } else {
        $numDireccion = $resNumDireccion['numero_direccion'];
    }

    //Validar telefono
    $resTelefono = Validador::validar_telefono($_POST['telefonoCliente']);
    if ($resTelefono['error']) {
        $mensaje = $resTelefono['error'];
    } else {
        $telefonoCliente = $resTelefono['telefono'];
    }
    //Validar contraseña
    $resContraseña = Validador::validar_contraseña($_POST['contraseñaCliente']);
    if ($resContraseña['error']) {
        $mensaje = $resContraseña['error'];
    } else {
        $contraseñaCliente = $resContraseña['contraseña'];

    }

}
if (isset($nombreCliente) && isset($apellidoCliente) && isset($emailCliente) && isset($telefonoCliente) && isset($contraseñaCliente) && isset($direccionEnvio) && isset($numDireccion)) {
    $sql = "INSERT INTO tabla_clientes(nombre_cliente,correo_cliente,contraseña_cliente,direccion_envio,telefono_cliente)VALUES('$nombreCliente  $apellidoCliente', '$emailCliente', '$contraseñaCliente', '$direccionEnvio $numDireccion', '11$telefonoCliente')";
    $execute = mysqli_query($conexion, $sql);
    $_SESSION['usuario'] = "$nombreCliente $apellidoCliente";
    header("Location: /proyectotienda/");

}

?>
<div class="row">
    <div class="col-4"></div>
    <div class="col-4">
        <div class="card mt-5">
            <div class="card-header">Formulario de registro</div>
            <div class="card-body">
                <?php if (isset($mensaje)) { ?>
                    <div class="alert alert-warning" role="alert">
                        <strong><?php
                        echo $mensaje;
                        ?></strong>
                    </div>
                <?php } ?>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nombreCliente" class="form-label">
                            Nombre/s
                        </label>
                        <input type="text" class="form-control" name="nombreCliente"
                            value="<?php echo isset($_POST['nombreCliente']) ? htmlspecialchars($_POST['nombreCliente']) : ''; ?>"
                            placeholder="Ingrese su nombre" />
                    </div>
                    <div class="mb-3">
                        <label for="apellidoCliente" class="form-label">
                            Apellido/s
                        </label>
                        <input type="text" class="form-control" name="apellidoCliente"
                            value="<?php echo isset($_POST['apellidoCliente']) ? htmlspecialchars($_POST['apellidoCliente']) : ''; ?>"
                            placeholder="Ingrese su apellido" />
                    </div>
                    <div class="mb-3">
                        <label for="emailCliente" class="form-label">
                            Email
                        </label>
                        <input type="email" class="form-control" name="emailCliente"
                            value="<?php echo isset($_POST['emailCliente']) ? htmlspecialchars($_POST['emailCliente']) : ''; ?>"
                            placeholder="Ingrese su email" />
                    </div>
                    <div class="mb-3">
                        <label for="direccionEnvio" class="form-label">
                            Dirección de envío de pedidos
                        </label>
                        <input type="text" class="form-control" name="direccionEnvio"
                            value="<?php echo isset($_POST['direccionEnvio']) ? htmlspecialchars($_POST['direccionEnvio']) : ''; ?>"
                            placeholder="Ingrese una dirección para envío de pedidos" />
                    </div>
                    <div class="mb-3">
                        <label for="numerodireccionEnvio" class="form-label">
                            Numero de la dirección
                        </label>
                        <input type="text" class="form-control" name="numerodireccionEnvio"
                            value="<?php echo isset($_POST['numerodireccionEnvio']) ? htmlspecialchars($_POST['numerodireccionEnvio']) : ''; ?>"
                            placeholder="Ingrese el numero de la dirección" />
                    </div>
                    <div class="mb-3">
                        <label for="telefonoCliente" class="form-label">Teléfono sin cod. de área</label>
                        <input type="text" class="form-control" name="telefonoCliente"
                            value="<?php echo isset($_POST['telefonoCliente']) ? htmlspecialchars($_POST['telefonoCliente']) : ''; ?>"
                            placeholder="Ingrese su teléfono sin 11. Ej: 22709269" />
                    </div>
                    <div class="mb-3">
                        <label for="contraseñaCliente" class="form-label">Ingrese su Contraseña</label>
                        <input type="password" class="form-control" name="contraseñaCliente"
                            value="<?php echo isset($_POST['contraseñaCliente']) ? htmlspecialchars($_POST['contraseñaCliente']) : ''; ?>"
                            placeholder="(Minimo: 8 caracteres, Maximo: 20 caracteres)" />
                    </div>

                    <button type="submit" name="registroConfirmado" class="btn btn-primary">Registrarse</button>
                </form>



            </div>
        </div>
    </div>
    <div class="col-4"></div>
</div>

<?php
include("templates/pie.php");
?>