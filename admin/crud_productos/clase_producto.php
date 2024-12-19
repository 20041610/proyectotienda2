<?php
include("../configuraciones/baseDeDatos.php");

if (isset($_POST['insertar'])) {
    $nombreDelProducto = $_POST['nombreDelProducto'];
    $precioDelProducto = $_POST['precioDelProducto'];
    $categoriaProducto = $_POST['categoriaProducto'];
    $imagenDelProducto = (isset($_FILES['imagenDelProducto']['name'])) ? $_FILES['imagenDelProducto']['name'] : ""; //Imagen del producto

    $query = "INSERT INTO tabla_productos (nombre_producto, precio_producto,categoria_producto,imagen_producto,fecha_creacion)
    VALUES ('$nombreDelProducto', '$precioDelProducto','$categoriaProducto', '$imagenDelProducto', NULL)";/* Realizamos la insercion de los datos
ingresados en el formulario, con la instruccion INSERT INTO, a la base de datos */
    mysqli_query($conexion, $query); //Ejecutamos la instruccion INSERT INTO
    header("Location: index.php"); //Volvemos al index.php
}

if (isset($_GET['idABorrar'])) {
    $delete = "DELETE FROM tabla_productos WHERE id_producto = '$_GET[idABorrar]'";
    mysqli_query($conexion, $delete);
    header("Location: /proyectotienda/admin/crud_productos/");
}

if (isset($_POST['modificar'])) {
    $nombreDelProducto = $_POST['nombreDelProducto'];
    $precioDelProducto = $_POST['precioDelProducto'];
    $categoriaProducto = $_POST['categoriaProducto'];
    $update = "UPDATE tabla_productos 
    SET nombre_producto = '$nombreDelProducto', precio_producto ='$precioDelProducto' , categoria_producto ='$categoriaProducto', fecha_creacion = NULL
    WHERE id_producto = '$_POST[idAModif]'";
    mysqli_query($conexion, $update);

    $nuevaImagenDelProducto = $_FILES['imagenDelProducto']['name']; //Guardamos la nueva imagen que seleccionamos
    if ($nuevaImagenDelProducto != "") { //Si la variable donde se guardo la nueva imagen recibe una nueva imagen
        $UpdateImagen = "UPDATE tabla_productos SET
        imagen_producto = '$nuevaImagenDelProducto'
        WHERE id_producto = '$_POST[idAModif]'"; //Efectuamos la modificacion de la columna imagen_producto
        mysqli_query($conexion, $UpdateImagen); //Ejecutamos el UPDATE para la imagen
    }
    header("Location: /proyectotienda/admin/crud_productos/");
}