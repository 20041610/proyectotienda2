<?php
class Validador
{

    public static function validar_nombre($nombre)
    {
        if (empty(trim($nombre))) {
            return ["error" => "El nombre no puede estar vacío y debe ser texto.", "nombre" => null];
        }

        if (!preg_match("/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/", $nombre)) {
            return ["error" => "El nombre solo debe contener letras y espacios.", "nombre" => null];
        }

        if (preg_match("/\s{2,}/", $nombre)) {
            return ["error" => "El nombre no puede tener espacios consecutivos.", "nombre" => null];
        }

        if (mb_strlen($nombre) < 2) {
            return ["error" => "El nombre no puede tener menos de 2 caracteres.", "nombre" => null];
        }

        // Si todo es válido, formatear el nombre y devolverlo
        $nombre = trim($nombre);
        $nombre = mb_convert_case($nombre, MB_CASE_TITLE, "UTF-8");

        return ["error" => null, "nombre" => $nombre];
    }

    public static function validar_apellido($apellido)
    {
        if (empty(trim($apellido))) {
            return ["error" => "El apellido no puede estar vacío y debe ser texto.", "apellido" => null];
        }

        if (!preg_match("/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/", $apellido)) {
            return ["error" => "El apellido solo debe contener letras y espacios.", "apellido" => null];
        }

        if (preg_match("/\s{2,}/", $apellido)) {
            return ["error" => "El apellido no puede tener espacios consecutivos.", "apellido" => null];
        }

        if (mb_strlen($apellido) < 2) {
            return ["error" => "El apellido no puede tener menos de 2 caracteres.", "apellido" => null];
        }

        // Si todo es válido, formatear el apellido y devolverlo
        $apellido = trim($apellido);
        $apellido = mb_convert_case($apellido, MB_CASE_TITLE, "UTF-8");

        return ["error" => null, "apellido" => $apellido];
    }
    public static function validar_email($email)
    {
        // Eliminar espacios en blanco al principio y al final
        $email = trim($email);

        // 1. Validar si el email está vacío
        if (empty(trim($email))) {
            return ["error" => "El email no puede estar vacío.", "email" => null];
        }

        // 2. Validar formato general del email usando FILTER_VALIDATE_EMAIL
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ["error" => "El email no tiene un formato válido.", "email" => null];
        }

        // 3. Validar longitud del email (máximo 255 caracteres)
        if (mb_strlen($email) > 255) {
            return ["error" => "El email no puede tener más de 255 caracteres.", "email" => null];
        }

        // 4. Validar si contiene caracteres no permitidos usando una expresión regular
        // Este paso es opcional ya que FILTER_VALIDATE_EMAIL ya hace una buena validación.
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[.a-zA-Z]{2,}$/", $email)) {
            return ["error" => "El email contiene caracteres no permitidos.", "email" => null];
        }

        // 5. Validar dominios comunes (opcional, dependiendo de tus necesidades)
        $dominios_permitidos = ['gmail.com', 'yahoo.com', 'hotmail.com']; // Ejemplo
        $dominio = substr(strrchr($email, "@"), 1); // Extraer el dominio
        if (!in_array($dominio, $dominios_permitidos)) {
            return ["error" => "El dominio del email no es válido o permitido.", "email" => null];
        }

        // Si todas las validaciones pasan, devolver el email validado
        return ["error" => null, "email" => $email];
    }

    public static function validar_telefono($telefono)
    {
        // Eliminar espacios, guiones y paréntesis para normalizar el número
        $telefono = preg_replace('/[ \-\(\)]/', '', trim($telefono));

        // Verificar si el número está vacío
        if (empty($telefono)) {
            return ["error" => "El número de teléfono no puede estar vacío.", "telefono" => null];
        }

        // Expresión regular para validar teléfonos de Argentina
        $regex = "/^\d{8}$/";

        // Validar el número con la expresión regular
        if (!preg_match($regex, $telefono)) {
            return ["error" => "Error. Ingrese su numero de telefono sin codigo de area.", "telefono" => null];
        }

        // Si pasa la validación, devolver el número normalizado
        return ["error" => null, "telefono" => $telefono];
    }

    public static function validar_contraseña($contraseña)
    {
        // 1. Verificar si la contraseña está vacía
        if (empty($contraseña)) {
            return ["error" => "La contraseña no puede estar vacía.", "contraseña" => null];
        }

        // 2. Validar longitud mínima y máxima
        if (mb_strlen($contraseña) < 8) {
            return ["error" => "La contraseña debe tener al menos 8 caracteres.", "contraseña" => null];
        }
        if (mb_strlen($contraseña) > 64) {
            return ["error" => "La contraseña no puede tener más de 64 caracteres.", "contraseña" => null];
        }

        // 3. Verificar si contiene al menos una letra mayúscula
        if (!preg_match('/[A-Z]/', $contraseña)) {
            return ["error" => "La contraseña debe incluir al menos una letra mayúscula.", "contraseña" => null];
        }

        // 4. Verificar si contiene al menos una letra minúscula
        if (!preg_match('/[a-z]/', $contraseña)) {
            return ["error" => "La contraseña debe incluir al menos una letra minúscula.", "contraseña" => null];
        }

        // 5. Verificar si contiene al menos un número
        if (!preg_match('/[0-9]/', $contraseña)) {
            return ["error" => "La contraseña debe incluir al menos un número.", "contraseña" => null];
        }

        // 6. Verificar si contiene al menos un carácter especial
        if (!preg_match('/[\@\#\$\%\^\&\*\!\_\-\+\=\?]/', $contraseña)) {
            return ["error" => "La contraseña debe incluir al menos un carácter especial (@#$%^&*!_-+=?).", "contraseña" => null];
        }

        // 7. Verificar si contiene espacios
        if (preg_match('/\s/', $contraseña)) {
            return ["error" => "La contraseña no puede contener espacios.", "contraseña" => null];
        }

        // 8. Validar contraseñas débiles (opcional)
        $contraseñas_débiles = ['123456', 'password', 'admin', 'qwerty'];
        if (in_array(strtolower($contraseña), $contraseñas_débiles)) {
            return ["error" => "La contraseña es demasiado débil.", "contraseña" => null];
        }

        // Si todas las validaciones pasan, devolver la contraseña
        return ["error" => null, "contraseña" => $contraseña];
    }
    public static function validar_direccion($direccionEnvio)
    {
        if (empty($direccionEnvio)) {
            return ["error" => "El domicilio no puede estar vacio.", "domicilio" => null];

        }
        if (!preg_match("/^[-.a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/", $direccionEnvio)) {
            return ["error" => "La direccion tiene caracteres no permitidos.", "direccionEnvio" => null];
        }

        if (preg_match("/\s{2,}/", $direccionEnvio)) {
            return ["error" => "La direccion no puede tener espacios consecutivos.", "direccionEnvio" => null];
        }

        if (mb_strlen($direccionEnvio) < 2) {
            return ["error" => "La direccion no puede tener menos de 2 caracteres.", "direccionEnvio" => null];
        }
        if (mb_strlen($direccionEnvio) > 50) {
            return ["error" => "Error. La direccion de envio es muy larga", "direccionEnvio" => null];
        }

        // Si todo es válido, formatear la direccion y devolverla
        $direccionEnvio = trim($direccionEnvio);
        $direccionEnvio = mb_convert_case($direccionEnvio, MB_CASE_TITLE, "UTF-8");

        return ["error" => null, "direccionEnvio" => $direccionEnvio];
    }
    public static function validar_numero_direccion($numero_direccion)
    {
        $numero_direccion = trim($numero_direccion);
        if (empty(trim($numero_direccion))) {
            return ["error" => "Error. Debe ingresar una altura para la dirección.", "numero_direccion" => null];
        }
        if (!ctype_digit($numero_direccion)) {
            return ["error" => "Error. El numero de la direccion debe contener solo numeros.", "numero_direccion" => null];
        }
        if (strlen($numero_direccion) > 5) {
            return ["error" => "Error. La longitud del número de la direccion es errónea.", "numero_direccion" => null];
        }

        return ["error" => null, "numero_direccion" => $numero_direccion];

    }



    public static function validar_rango($numero, $min, $max)
    {
        return filter_var($numero, FILTER_VALIDATE_INT, [
            "options" => ["min_range" => $min, "max_range" => $max]
        ]);
    }
}
?>