<?php
include "conexion.php";

// Verificamos que recibimos un ID por la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Usamos una sentencia preparada (más seguro para DAM)
    $stmt = $conexion->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirigir al panel con un parámetro de éxito (opcional)
        header("Location: ../index.php?mensaje=borrado");
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }
    
    $stmt->close();
}
$conexion->close();
?>