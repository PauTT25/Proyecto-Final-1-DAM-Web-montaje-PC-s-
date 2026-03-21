<!doctype html>
<html lang="es">
<head>
    <title>Panel Admin - PCBuilder</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../frontend/assets/CSS/estilos.css">
    <style>
        .admin-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .stat-card {
            background: rgba(255,255,255,0.05);
            padding: 2rem;
            border-radius: 1rem;
            border-left: 4px solid #0327f5;
        }

        .stat-card.alerta { border-left-color: #ffc107; }

        .stat-card h3 { color: #aaa; font-size: 1.2rem; text-transform: uppercase; margin-bottom: 1rem; }
        .stat-card p  { color: #fff; font-size: 2.8rem; font-weight: bold; margin: 0; }

        /* Tabla de productos */
        .tabla-productos {
            width: 100%;
            border-collapse: collapse;
            font-size: 1.4rem;
            margin-bottom: 6rem;
        }

        .tabla-productos th {
            text-align: left;
            padding: 1.2rem 1.5rem;
            color: #aaa;
            font-size: 1.2rem;
            text-transform: uppercase;
            border-bottom: 2px solid rgba(255,255,255,0.1);
        }

        .tabla-productos td {
            padding: 1.4rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            color: #fff;
        }

        .tabla-productos tr:hover td { background: rgba(255,255,255,0.03); }

        /* Botones de accion en la tabla */
        .btn-editar {
            background: transparent;
            color: #0327f5;
            border: 1px solid #0327f5;
            padding: 0.5rem 1.2rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .btn-borrar {
            background: transparent;
            color: #dc3545;
            border: 1px solid #dc3545;
            padding: 0.5rem 1.2rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: bold;
            margin-left: 0.5rem;
        }

        /* Aviso de stock bajo */
        .stock-bajo { color: #ffc107; font-weight: bold; }

        /* Mensajes de feedback */
        .mensaje-ok {
            background: rgba(40,167,69,0.15);
            border-left: 4px solid #28a745;
            color: #80f0a0;
            padding: 1.2rem 1.8rem;
            border-radius: 0.6rem;
            font-size: 1.4rem;
            margin-bottom: 3rem;
        }

        .cabecera-seccion {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
        }

        /* Titulo de cada categoria */
        .titulo-categoria {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            padding-left: 1.5rem;
            margin-bottom: 2rem;
        }

        .titulo-categoria.gaming  { border-left: 5px solid #0327f5; }
        .titulo-categoria.oficina { border-left: 5px solid #28a745; }
    </style>
</head>
<body class="seccion-oscura">

<?php
include "includes/conexion.php";

// Contamos el total de productos
$resProductos   = $conexion->query("SELECT COUNT(*) as total FROM productos");
$totalProductos = $resProductos->fetch_assoc()['total'];

// Contamos los productos con stock bajo (menos de 5 unidades)
$resStockBajo = $conexion->query("SELECT COUNT(*) as total FROM productos WHERE stock < 5");
$stockBajo    = $resStockBajo->fetch_assoc()['total'];
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

    <h2 class="titulo-seccion" style="font-size: 4rem;">Gestión de Inventario</h2>

    <!-- Mensaje de confirmacion tras crear, editar o borrar un producto -->
    <?php
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == 'creado')      echo '<div class="mensaje-ok">✔ Producto creado correctamente.</div>';
        if ($_GET['msg'] == 'actualizado') echo '<div class="mensaje-ok">✔ Producto actualizado correctamente.</div>';
        if ($_GET['msg'] == 'borrado')     echo '<div class="mensaje-ok">✔ Producto eliminado del inventario.</div>';
    }
    ?>

    <!-- Tarjetas de estadisticas -->
    <div class="admin-stats">
        <div class="stat-card">
            <h3>Total Productos</h3>
            <p><?php echo $totalProductos; ?></p>
        </div>
        <div class="stat-card alerta">
            <h3>Stock Bajo (&lt;5)</h3>
            <p><?php echo $stockBajo; ?></p>
        </div>
    </div>

    <!-- Cabecera con boton de añadir -->
    <div class="cabecera-seccion">
        <h3 style="color: #fff; font-size: 2.2rem; border-left: 5px solid #0327f5; padding-left: 1.5rem;">
            Catálogo de Componentes
        </h3>
        <a href="includes/producto_form.php" class="btn btn-principal">+ Añadir Producto</a>
    </div>

    <!-- ── TABLA GAMING (id_categoria = 1) ───────────────── -->
    <h3 class="titulo-categoria gaming">🎮 Componentes Gaming</h3>
    <table class="tabla-productos">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $gaming = $conexion->query("SELECT * FROM productos WHERE id_categoria = 1 ORDER BY tipo_componente");

        if ($gaming->num_rows == 0) {
            echo '<tr><td colspan="7" style="color:#666; text-align:center; padding:2rem;">No hay productos en esta categoría.</td></tr>';
        }

        // Contador propio para la tabla Gaming, empieza en 1
        $contador_gaming = 1;

        while ($p = $gaming->fetch_assoc()) {
            $claseStock = ($p['stock'] < 5) ? 'stock-bajo' : '';
            echo '
            <tr>
                <td style="color:#666;">' . $contador_gaming . '</td>
                <td><strong>' . $p['nombre'] . '</strong></td>
                <td style="color:#aaa;">' . $p['marca'] . '</td>
                <td>' . $p['tipo_componente'] . '</td>
                <td style="color:#0327f5; font-weight:bold;">' . number_format($p['precio'], 2) . '€</td>
                <td class="' . $claseStock . '">' . $p['stock'] . ' ud.</td>
                <td>
                    <a href="includes/producto_form.php?id=' . $p['id_producto'] . '" class="btn-editar">Editar</a>
                    <a href="includes/borrar.php?id=' . $p['id_producto'] . '"
                       class="btn-borrar"
                       onclick="return confirm(\'¿Seguro que quieres eliminar este producto?\')">
                       Borrar
                    </a>
                </td>
            </tr>';

            // Sumamos 1 al contador en cada vuelta del bucle
            $contador_gaming++;
        }
        ?>
        </tbody>
    </table>

    <!-- ── TABLA OFICINA (id_categoria = 2) ──────────────── -->
    <h3 class="titulo-categoria oficina">🖥️ Componentes Oficina</h3>
    <table class="tabla-productos">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $oficina = $conexion->query("SELECT * FROM productos WHERE id_categoria = 2 ORDER BY tipo_componente");

        if ($oficina->num_rows == 0) {
            echo '<tr><td colspan="7" style="color:#666; text-align:center; padding:2rem;">No hay productos en esta categoría.</td></tr>';
        }

        // Contador propio para la tabla Oficina, empieza en 1 independientemente de Gaming
        $contador_oficina = 1;

        while ($p = $oficina->fetch_assoc()) {
            $claseStock = ($p['stock'] < 5) ? 'stock-bajo' : '';
            echo '
            <tr>
                <td style="color:#666;">' . $contador_oficina . '</td>
                <td><strong>' . $p['nombre'] . '</strong></td>
                <td style="color:#aaa;">' . $p['marca'] . '</td>
                <td>' . $p['tipo_componente'] . '</td>
                <td style="color:#0327f5; font-weight:bold;">' . number_format($p['precio'], 2) . '€</td>
                <td class="' . $claseStock . '">' . $p['stock'] . ' ud.</td>
                <td>
                    <a href="includes/producto_form.php?id=' . $p['id_producto'] . '" class="btn-editar">Editar</a>
                    <a href="includes/borrar.php?id=' . $p['id_producto'] . '"
                       class="btn-borrar"
                       onclick="return confirm(\'¿Seguro que quieres eliminar este producto?\')">
                       Borrar
                    </a>
                </td>
            </tr>';

            // Sumamos 1 al contador en cada vuelta del bucle
            $contador_oficina++;
        }
        ?>
        </tbody>
    </table>

</main>
</body>
</html>