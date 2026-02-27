<?php 
    // Hago la conexion a la base de datos u utilizando __DIR__ me aseguro de tener la variable $conexion en todas las paginas que utilize el header.
    include __DIR__ . '/../../backend/includes/conexion.php';
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
                <a href="index.php" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
                <img src="assets/images/Logo-web.png" alt="Logo PCBuilder" class="logo-img">
                <h1 class="logo-texto">PC<span>Builder</span></h1>
                </a>
            </div>
            
<nav>
    <ul class="nav-list">
        <?php 
            // Segun en que pagina estemos, el header se comportara difernte mostrandono los enlaces de navegacion o no gracias a la variable $pagina_actual y con la ayuda de basename($_SERVER['PHP_SELF']) nos da el nombre del archvio actual.
            $pagina_actual = basename($_SERVER['PHP_SELF']); 

            if ($pagina_actual == 'index.php') { 
                // En el index se mantienen las tarjetas para poder moverse por la misma pagina.
                ?>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#diferencial">Ventajas</a></li>
                <li><a href="#contacto">Contacto</a></li>
                <?php 
            } 
            // Cuando no estemos en el index, en el header solo se mantendra el enlace que hemos hecho con el logo y la tarjeta de mi cuenta.
        ?>
        
        <li><a href="login.php" class="btn btn-login">Mi Cuenta</a></li>
    </ul>
</nav>
        </div>
    </header>