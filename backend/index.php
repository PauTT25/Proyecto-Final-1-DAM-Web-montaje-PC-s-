<!doctype html>
<html lang="es">
<head>
    <title>Panel Admin - PCBuilder</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../frontend/assets/CSS/estilos.css">
    <style>
        .admin-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-bottom: 4rem; }
        .stat-card { background: rgba(255, 255, 255, 0.05); padding: 2rem; border-radius: 1rem; border-left: 4px solid #0327f5; }
        .stat-card h3 { color: #aaa; font-size: 1.2rem; text-transform: uppercase; margin-bottom: 1rem; }
        .stat-card p { color: #fff; font-size: 2.8rem; font-weight: bold; margin: 0; }
        .header-admin-title { border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 2rem; margin-bottom: 4rem; }
    </style>
</head>
<body class="seccion-oscura">
    <?php
        include "includes/conexion.php";

        // 1. Total Productos
        $resProductos = $conexion->query("SELECT COUNT(*) as total FROM productos");
        $totalProductos = $resProductos->fetch_assoc()['total'];

        // 2. Alertas de Stock Bajo (Stock < 5)
        $resStockBajo = $conexion->query("SELECT COUNT(*) as total FROM productos WHERE stock < 5");
        $stockBajo = $resStockBajo->fetch_assoc()['total'];
    ?> 

    <header>
        <div class="header-flex container">
            <div class="logo-container">
                <h1 class="logo-texto">PC<span>ADMIN</span></h1>
                <p style="color: #aaa; font-size: 1.2rem; margin-top: -5px;">Terminal de Control v1.0</p>
            </div>
            <nav>
                <ul class="nav-list">
                    <li><a href="../frontend/index.php">Ver Tienda</a></li>
                    <li><a href="logout.php" style="color: #d9534f;">Salir</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container seccion-padding">
        <div class="header-admin-title">
            <h2 class="titulo-seccion" style="font-size: 4rem;">Gestión de Inventario</h2>
        </div>

        <div class="admin-stats">
            <div class="stat-card">
                <h3>Total Productos</h3>
                <p><?php echo $totalProductos; ?></p> 
            </div>
            <div class="stat-card" style="border-left-color: #ffc107;">
                <h3>Stock Bajo (<5)</h3>
                <p><?php echo $stockBajo; ?></p>
            </div>
        </div>

        <header style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end;">
            <h3 style="color: #fff; font-size: 2.2rem; border-left: 5px solid #0327f5; padding-left: 1.5rem;">Catálogo de Componentes</h3>
            <a href="producto_nuevo.php" class="btn btn-principal">+ Añadir Producto</a>
        </header>

        <div class="contenedor-grid">
            <?php 
                // Adaptamos el listar_articulos a tu estructura REAL
                $resultado = $conexion->query("SELECT * FROM productos");
                while ($p = $resultado->fetch_assoc()) {
                    echo '
                    <div style="background: rgba(255,255,255,0.05); padding: 2rem; border-radius: 10px;">
                        <h4 style="color: white;">'.$p['nombre'].'</h4>
                        <p style="color: #666;">'.$p['marca'].' | Stock: '.$p['stock'].'</p>
                        <p style="color: #0327f5; font-size: 2rem; font-weight: bold;">'.$p['precio'].'€</p>
                    </div>';
                }
            ?>
        </div>
    </main>
</body>
</html>