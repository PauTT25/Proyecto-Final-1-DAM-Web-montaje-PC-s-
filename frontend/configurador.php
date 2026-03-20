<?php 
include 'includes/header.php';

// Recogemos el id_cat que viene del index.php (1 = Gaming, 2 = Oficina)
// Si alguien entra sin elegir, por defecto le ponemos ID1 (Gaming)
$id_cat_usuario = isset($_GET['id_cat']) ? intval($_GET['id_cat']) : 1;

// Array con todos los pasos del configurador
// Cada paso tiene el nombre que se muestra y el tipo_componente que buscamos en la BD
$pasos = array(
    1 => array('titulo' => 'Procesador',           'tipo' => 'procesador'),
    2 => array('titulo' => 'Memoria RAM',           'tipo' => 'ram'),
    3 => array('titulo' => 'Tarjeta Gráfica (GPU)', 'tipo' => 'gpu'),
    4 => array('titulo' => 'Almacenamiento',        'tipo' => 'almacenamiento'),
    5 => array('titulo' => 'Placa Base',            'tipo' => 'placa_base'),
    6 => array('titulo' => 'Fuente de Alimentación','tipo' => 'fuente'),
);
?>

<main class="container" style="margin-top: 100px;">

    <h2 style="text-align:center; font-size: 3rem; margin-bottom: 1rem;">Configurador de PC</h2>
    <p style="text-align:center; color: #666; margin-bottom: 4rem;">Selecciona los componentes para tu nuevo equipo</p>

    <form action="carrito.php" method="POST">

        <?php
        // Recorremos el array de pasos para generar cada seccion automaticamente
        foreach ($pasos as $numero => $paso) {
            
            // Consultamos los productos de esta categoria y tipo de componente
            $sql = "SELECT * FROM productos WHERE id_categoria = $id_cat_usuario AND tipo_componente = '" . $paso['tipo'] . "'";
            $resultado = $conexion->query($sql);

            if (!$resultado) {
                die("Error en la consulta: " . $conexion->error);
            }
        ?>

        <section class="paso-configuracion" style="margin-bottom: 4rem;">
            <h3 style="font-size: 2rem; margin-bottom: 2rem; border-left: 4px solid #0327f5; padding-left: 1.2rem;">
                Paso <?php echo $numero; ?>: <?php echo $paso['titulo']; ?>
            </h3>

            <div class="contenedor-piezas">
                <?php
                // Comprobamos si hay productos disponibles para este paso
                if ($resultado->num_rows == 0) {
                    echo '<p style="color: #aaa; font-size: 1.4rem;">No hay componentes disponibles para esta categoría todavía.</p>';
                }

                // Mostramos las tarjetas de cada componente
                while ($fila = $resultado->fetch_assoc()) {
                ?>
                    <label class="tarjeta-pieza" style="cursor: pointer;">
                        <img src="assets/images/<?php echo $fila['imagen_url']; ?>" width="100" alt="img">
                        <h4><?php echo $fila['nombre']; ?></h4>
                        <p style="color: #666; font-size: 1.2rem;"><?php echo $fila['marca']; ?></p>
                        <p>Precio: <strong><?php echo $fila['precio']; ?>€</strong></p>
                        <?php
                        if ($fila['stock'] <= 0) {
                            echo '<p style="color: #dc3545; font-size: 1.2rem; font-weight: bold;">Sin stock</p>';
                        } elseif ($fila['stock'] < 5) {
                            echo '<p style="color: #ffc107; font-size: 1.2rem;">Stock: ' . $fila['stock'] . ' ud.</p>';
                        }
                        ?>
                        <input type="radio" name="id_<?php echo $paso['tipo']; ?>" value="<?php echo $fila['id_producto']; ?>" required
                                <?php echo ($fila['stock'] <= 0) ? 'disabled' : ''; ?>>
                        <span>Seleccionar</span>
                    </label>
                <?php
                }
                ?>
            </div>
        </section>

        <?php
        } // Fin del foreach de pasos
        ?>

        <div style="text-align:center; margin: 40px 0;">
            <button type="submit" class="btn btn-principal">Ver resumen del presupuesto</button>
        </div>

    </form>
</main>

<?php include 'includes/footer.php'; ?>