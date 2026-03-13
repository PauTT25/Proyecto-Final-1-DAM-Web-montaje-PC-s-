<?php 
    // Incluimos el header que ya tiene la conexión a la base de datos
    include 'includes/header.php'; 

    // 1. Recogemos los IDs enviados por el formulario
    // Usamos intval por seguridad para asegurarnos de que recibimos números
    $id_cpu = isset($_POST['id_procesador']) ? intval($_POST['id_procesador']) : 0;
    $id_ram = isset($_POST['id_ram']) ? intval($_POST['id_ram']) : 0;

    // Si no se ha seleccionado nada, redirigimos al index o damos aviso
    if ($id_cpu === 0 || $id_ram === 0) {
        echo "<script>alert('Por favor, completa la selección de componentes.'); window.location.href='index.php';</script>";
        exit;
    }

    // 2. Consultamos la base de datos para obtener los detalles reales de los productos seleccionados
    // Usamos el operador IN para traer ambos productos en una sola consulta
    $sql = "SELECT * FROM productos WHERE id_producto IN ($id_cpu, $id_ram)";
    $resultado = $conexion->query($sql);

    $total_presupuesto = 0;
?>

<main class="container seccion-padding" style="margin-top: 100px;">
    <h2 class="titulo-seccion">Resumen de tu Configuración</h2>
    
    <div class="tabla-presupuesto" style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <table style="width: 100%; border-collapse: collapse; font-size: 1.6rem;">
            <thead>
                <tr style="border-bottom: 2px solid #0327f5; text-align: left;">
                    <th style="padding: 1rem;">Componente</th>
                    <th style="padding: 1rem;">Modelo</th>
                    <th style="padding: 1rem;">Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // 3. Iteramos sobre los productos encontrados para sumarlos y mostrarlos
                while ($item = $resultado->fetch_assoc()): 
                    $total_presupuesto += $item['precio'];
                ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 1.5rem; text-transform: capitalize; font-weight: bold;">
                        <?php echo $item['tipo_componente']; ?>
                    </td>
                    <td style="padding: 1.5rem;"><?php echo $item['nombre']; ?></td>
                    <td style="padding: 1.5rem;"><?php echo number_format($item['precio'], 2); ?>€</td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr style="font-size: 2.2rem; font-weight: 800; color: #0327f5;">
                    <td colspan="2" style="padding: 2rem; text-align: right;">TOTAL:</td>
                    <td style="padding: 2rem;"><?php echo number_format($total_presupuesto, 2); ?>€</td>
                </tr>
            </tfoot>
        </table>

        <div style="display: flex; justify-content: space-between; margin-top: 4rem;">
            <a href="index.php" class="btn" style="background: #666; color: white; padding: 1rem 2rem;">Descartar y Volver</a>
            <button onclick="window.print();" class="btn btn-principal" style="margin-top: 0;">Imprimir Presupuesto</button>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>