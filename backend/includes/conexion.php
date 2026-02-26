<?php 

    $host = "localhost";      // Servidor de la base de datos.
    $user = "U_PCBuilder";    // Usuario con privilegios limitados.
    $pass = "PCBuilder2026$"; // Contraseña segura asignada al usuario.
    $db   = "PCBuilder";   // Nombre de la base de datos.

    // Creamos la instancia de la clase mysqli para establecer la conexion
    $conexion = new mysqli($host, $user, $pass, $db);

    // Verificacion de la conexion, si existe un error se dentiene la carga de la web.
    if ($conexion->connect_error) {
        // La funcion die() imprime el mensaje de aviso y termina el script inmediatamente.
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Conjunto de caracteres cambiado a UTF-8 para evitar errores con tildes y ñ.
    $conexion->set_charset("utf8");
?>