<?php
session_start();

// Recogemos el idioma que nos llega por GET
// Si no es 'es' o 'en' usamos español por defecto
if (isset($_GET['idioma']) && ($_GET['idioma'] == 'es' || $_GET['idioma'] == 'en')) {
    $_SESSION['idioma'] = $_GET['idioma'];
}

// Volvemos a la pagina desde la que se cambio el idioma
// Si no hay pagina de referencia, vamos al index
if (isset($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: index.php");
}
exit;
?>