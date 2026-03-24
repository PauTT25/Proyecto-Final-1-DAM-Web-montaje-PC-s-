<?php 
session_start();
include __DIR__ . '/traducciones.php';
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
$pagina_actual = basename($_SERVER['PHP_SELF']); 
if ($pagina_actual == 'index.php') { 
?>
<li><a href="#servicios"><?php echo $t['nav_servicios']; ?></a></li>
<li><a href="#diferencial"><?php echo $t['nav_ventajas']; ?></a></li>
<li><a href="#contacto"><?php echo $t['nav_contacto']; ?></a></li>
<?php } ?>

<!-- Botones de idioma visibles en todas las paginas -->
<li><a href="cambiar_idioma.php?idioma=es" style="padding: 0.5rem 1rem;">🇪🇸 ES</a></li>
<li><a href="cambiar_idioma.php?idioma=en" style="padding: 0.5rem 1rem;">🇬🇧 EN</a></li>

<?php if (isset($_SESSION['usuario'])): ?>
<li style="color: #aaa; font-size: 1.3rem;"><?php echo $t['nav_hola']; ?>, <?php echo $_SESSION['usuario']; ?></li>
<li><a href="logout.php" style="color: #d9534f;"><?php echo $t['nav_cerrar_sesion']; ?></a></li>
<?php else: ?>
<li><a href="login.php" class="btn btn-login"><?php echo $t['nav_mi_cuenta']; ?></a></li>
<?php endif; ?>
</ul>
</nav>
</div>
</header>