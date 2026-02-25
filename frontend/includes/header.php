<?php 
    // Incluimos la conexión (ajusta la ruta si es necesario)
    include '../../backend/includes/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCBuilder | PCs a medida</title>
    <link rel="stylesheet" href="assets/CSS/estilos.css">
</head>
<body>

    <header>
        <div class="container header-flex">
            <div class="logo-container">
                <img src="assets/images/Logo-web.png" alt="Logo PCBuilder" class="logo-img">
                <h1 class="logo-texto">PC<span>Builder</span></h1>
            </div>
            
            <nav>
                <ul class="nav-list">
                    <li><a href="#servicios">Servicios</a></li>
                    <li><a href="#diferencial">Ventajas</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                    <li><a href="login.php" class="btn btn-login">Mi Cuenta</a></li>
                </ul>
            </nav>
        </div>
    </header>