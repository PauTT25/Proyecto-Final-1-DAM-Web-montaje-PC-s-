<?php
include "conexion.php";

// Verificamos que nos ha llegado un ID por la URL
if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    // Borramos el producto de la tabla productos usando el id_producto
    if ($conexion->query("DELETE FROM productos WHERE id_producto = $id")) {
        header("Location: ../index.php?msg=borrado");
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }

} else {
    // Si no llega ID redirigimos al panel
    header("Location: ../index.php");
}

$conexion->close();
?>