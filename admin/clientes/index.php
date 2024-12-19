<?php
include("../templates_admin/cabecera.php");
include("../configuraciones/baseDeDatos.php");
$selectclientes = "SELECT * FROM tabla_clientes";
$execute = mysqli_query($conexion, $selectclientes);
?>




<h1>Clientes disponibles</h1>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-primary table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Id cliente</th>
                            <th scope="col" class="text-center">Nombre</th>
                            <th scope="col" class="text-center">Contraseña</th>
                            <th scope="col" class="text-center">Correo</th>
                            <th scope="col" class="text-center">Dirección de envío</th>
                            <th scope="col" class="text-center">Telefono</th>
                            <th scope="col" class="text-center">Fecha de registro</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($execute as $cliente) { ?>
                            <tr class="">
                                <td width="5%" class="text-center"><?php echo $cliente['id_cliente']; ?></td>
                                <td width="15%" class="text-center"><?php echo $cliente['nombre_cliente']; ?></td>
                                <td width="10%" class="text-center"><?php echo $cliente['contraseña_cliente']; ?></td>
                                <td width="10%" class="text-center"><?php echo $cliente['correo_cliente']; ?></td>
                                <td width="20%" class="text-center"><?php echo $cliente['direccion_envio']; ?></td>
                                <td width="10%" class="text-center"><?php echo $cliente['telefono_cliente']; ?></td>
                                <td width="20%" class="text-center"><?php echo $cliente['fecha_registro']; ?></td>
                                <td class="text-center">
                                    <a name="" id="" class="btn btn-primary"
                                        href="historialCliente.php?txtID=<?php echo $cliente['id_cliente']; ?>"
                                        role="button">Ver
                                        historial</a>
                                    <a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar cliente</a>


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