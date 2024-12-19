function modificarCantidad(id, unidades) {
    // Obtenemos el campo de entrada por su ID
    const cantidadIngresada = document.getElementById(id);

    if (!cantidadIngresada) {
        console.error("No se encontró un elemento con el ID:", id);
        return;
    }

    // Obtenemos el valor actual del campo y lo convertimos a número
    let cantidad = parseInt(cantidadIngresada.value, 10) || 0;

    // Incrementamos o decrementamos la cantidad
    cantidad += unidades;

    // Evitamos valores negativos
    if (cantidad < 0) {
        cantidad = 0;
    }

    // Actualizamos el valor en el campo de entrada
    cantidadIngresada.value = cantidad;
}
