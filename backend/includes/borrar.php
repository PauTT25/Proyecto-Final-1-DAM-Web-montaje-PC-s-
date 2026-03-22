<?php
session_start();
include "conexion.php";

// Si no hay sesion iniciada o el usuario no es admin, redirigimos al login
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: /a/Proyecto-Final-1-DAM-Web-montaje-PC-s-/frontend/login.php");
    exit;
}

// Verificamos que nos ha llegado un ID por la URL
if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    // Borramos el producto de la tabla productos usando el id_producto
    if ($conexion->query("DELETE FROM productos WHERE id_producto = $id")) {
        header("Location: ../index_admin.php?msg=borrado");
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }

} else {
    // Si no llega ID redirigimos al panel
    header("Location: ../index_admin.php");
}

$conexion->close();
?>