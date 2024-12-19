
<?php
include("../tienda/templates/cabecera.php"); //Cabecera del admin

?>
<?php
session_start(); //Abrimos sesion
session_destroy(); //Cerramos la sesion
header("Location:/proyectotienda/"); //Redireccion a la pagina de logueo
?>

<?php include("../tienda/templates/pie.php"); //Pie del admin 
?>