<?php 
include 'includes/header.php';

// Array con todos los tipos de componentes que recibimos del configurador
// La clave es el nombre del campo POST y el valor es el nombre legible para mostrar
$tipos_componentes = array(
    'id_procesador'     => 'Procesador',
    'id_ram'            => 'Memoria RAM',
    'id_gpu'            => 'Tarjeta Gráfica',
    'id_almacenamiento' => 'Almacenamiento',
    'id_placa_base'     => 'Placa Base',
    'id_fuente'         => 'Fuente de Alimentación',
);

// 1. Recogemos todos los IDs enviados por el formulario del configurador
$ids_seleccionados = array();

foreach ($tipos_componentes as $campo => $nombre) {
    if (isset($_POST[$campo]) && intval($_POST[$campo]) > 0) {
        $ids_seleccionados[] = intval($_POST[$campo]);
    }
}

// Si no se ha seleccionado nada, redirigimos al index
if (empty($ids_seleccionados)) {
    echo "<script>alert('Por favor, completa la selección de componentes.'); window.location.href='index.php';</script>";
    exit;
}

// Convertimos el array de IDs a una cadena para usarla en las consultas SQL
$ids_sql = implode(',', $ids_seleccionados);

// 2. Comprobamos el stock de todos los componentes antes de mostrar el ticket
$resStock = $conexion->query("SELECT id_producto, nombre, stock FROM productos WHERE id_producto IN ($ids_sql)");

$sinStock = array();

while ($s = $resStock->fetch_assoc()) {
    if ($s['stock'] <= 0) {
        $sinStock[] = $s['nombre'];
    }
}

// Si algún componente no tiene stock, avisamos y paramos sin restar nada
if (!empty($sinStock)) {
    $nombres = implode(', ', $sinStock);
    echo "<script>alert('Lo sentimos, no hay stock de: $nombres'); window.location.href='index.php';</script>";
    exit;
}

// 3. Variable para controlar si la compra ya ha sido confirmada
// Empieza en false, se pone a true cuando el usuario pulsa "Confirmar compra"
$compra_confirmada = false;

// Comprobamos si el usuario ha pulsado el boton de confirmar
if (isset($_POST['confirmar_compra'])) {

    // Restamos 1 unidad de stock a cada componente seleccionado
    foreach ($ids_seleccionados as $id) {
        $conexion->query("UPDATE productos SET stock = stock - 1 WHERE id_producto = $id");
    }

    $compra_confirmada = true;
}

// 4. Consultamos los detalles de los productos para mostrar el ticket
$resultado = $conexion->query("SELECT * FROM productos WHERE id_producto IN ($ids_sql)");

$total_presupuesto = 0;
$productos_ticket  = array();

// Guardamos los productos en un array para poder mostrarlos en la tabla
while ($item = $resultado->fetch_assoc()) {
    $total_presupuesto += $item['precio'];
    $productos_ticket[] = $item;
}
?>

<main class="container seccion-padding" style="margin-top: 100px;">

    <h2 class="titulo-seccion">Resumen de tu Configuración</h2>

    <?php if ($compra_confirmada): ?>
        <!-- Mensaje de confirmacion que aparece tras pulsar "Confirmar compra" -->
        <div style="background: rgba(40,167,69,0.12); border-left: 4px solid #28a745; color: #28a745;
                    padding: 2rem 2.5rem; border-radius: 0.8rem; font-size: 1.8rem;
                    font-weight: bold; margin-bottom: 3rem; text-align: center;">
            ✔ ¡Compra confirmada! Tu pedido ha sido registrado correctamente.
        </div>
    <?php endif; ?>

    <div style="background: white; padding: 2rem; border-radius: 1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <table style="width: 100%; border-collapse: collapse; font-size: 1.6rem;">
            <thead>
                <tr style="border-bottom: 2px solid #0327f5; text-align: left;">
                    <th style="padding: 1rem;">Componente</th>
                    <th style="padding: 1rem;">Modelo</th>
                    <th style="padding: 1rem;">Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos_ticket as $item): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 1.5rem; text-transform: capitalize; font-weight: bold;">
                        <?php echo $item['tipo_componente']; ?>
                    </td>
                    <td style="padding: 1.5rem;"><?php echo $item['nombre']; ?></td>
                    <td style="padding: 1.5rem;"><?php echo number_format($item['precio'], 2); ?>€</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr style="font-size: 2.2rem; font-weight: 800; color: #0327f5;">
                    <td colspan="2" style="padding: 2rem; text-align: right;">TOTAL:</td>
                    <td style="padding: 2rem;"><?php echo number_format($total_presupuesto, 2); ?>€</td>
                </tr>
            </tfoot>
        </table>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 4rem; flex-wrap: wrap; gap: 1rem;">

            <a href="index.php" class="btn" style="background: #666; color: white; padding: 1rem 2rem;">
                Volver al inicio
            </a>

            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">

                <button onclick="window.print();" class="btn btn-principal" style="margin-top:0; background:#444;">
                    Imprimir Presupuesto
                </button>

                <?php if (!$compra_confirmada): ?>
                    <!-- Reenviamos los IDs al mismo carrito.php con el flag de confirmar_compra -->
                    <form method="POST" action="carrito.php" style="margin: 0;">
                        <?php foreach ($tipos_componentes as $campo => $nombre):
                            if (isset($_POST[$campo])): ?>
                                <input type="hidden" name="<?php echo $campo; ?>" value="<?php echo intval($_POST[$campo]); ?>">
                        <?php   endif;
                        endforeach; ?>
                        <!-- Este campo oculto le indica al PHP que el usuario ha confirmado -->
                        <input type="hidden" name="confirmar_compra" value="1">
                        <button type="submit" class="btn btn-principal" style="margin-top: 0;">
                            Confirmar compra
                        </button>
                    </form>
                <?php else: ?>
                    <!-- Deshabilitamos el boton para evitar que se confirme dos veces -->
                    <button class="btn btn-principal" style="margin-top:0; opacity:0.5; cursor:not-allowed;" disabled>
                        Compra realizada
                    </button>
                <?php endif; ?>

            </div>
        </div>
    </div>

</main>

<?php include 'includes/footer.php'; ?>