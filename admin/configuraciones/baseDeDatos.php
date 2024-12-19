<!-- Archivo de conexion a la base de datos -->
<?php
$dbname = "bd_tienda";
$dbuser = "root";
$dbhost = "localhost";
$dbpass = "";
define("KEY", "proyectotienda");
define("COD", "AES-128-ECB");
$conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
/*if (!isset($conexion)) {
    echo "No se esta conectando con la bd";
} else {
    echo "Conexion exitosa";
}
 */
?>