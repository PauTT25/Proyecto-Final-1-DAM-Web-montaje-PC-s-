<?php 
include 'includes/header.php';

// Recogemos el id_cat que viene del index.php (1 = Gaming, 2 = Oficina)
$id_cat_usuario = isset($_GET['id_cat']) ? intval($_GET['id_cat']) : 1;

// Usamos el array de pasos del archivo de traducciones segun el idioma
$pasos = $t['conf_pasos'];
?>

<main class="container" style="margin-top: 100px;">

    <h2 style="text-align:center; font-size: 3rem; margin-bottom: 1rem;"><?php echo $t['conf_titulo']; ?></h2>
    <p style="text-align:center; color: #666; margin-bottom: 4rem;"><?php echo $t['conf_subtitulo']; ?></p>

    <form action="carrito.php" method="POST">
        <?php
        foreach ($pasos as $numero => $paso) {
            $sql = "SELECT * FROM productos WHERE id_categoria = $id_cat_usuario AND tipo_componente = '" . $paso['tipo'] . "'";
            $resultado = $conexion->query($sql);
            if (!$resultado) {
                die("Error en la consulta: " . $conexion->error);
            }
        ?>
        <section class="paso-configuracion" style="margin-bottom: 4rem;">
            <h3 style="font-size: 2rem; margin-bottom: 2rem; border-left: 4px solid #0327f5; padding-left: 1.2rem;">
                <?php echo $t['conf_paso'] . ' ' . $numero . ': ' . $paso['titulo']; ?>
            </h3>
            <div class="contenedor-piezas">
                <?php
                if ($resultado->num_rows == 0) {
                    echo '<p style="color: #aaa; font-size: 1.4rem;">' . $t['conf_sin_comp'] . '</p>';
                }
                while ($fila = $resultado->fetch_assoc()) {
                ?>
                    <label class="tarjeta-pieza" style="cursor: pointer;">
                        <img src="assets/images/<?php echo $fila['imagen_url']; ?>" width="100" alt="img">
                        <h4><?php echo $fila['nombre']; ?></h4>
                        <p style="color: #666; font-size: 1.2rem;"><?php echo $fila['marca']; ?></p>
                        <p><?php echo $t['conf_precio']; ?>: <strong><?php echo $fila['precio']; ?>€</strong></p>
                        <?php
                        if ($fila['stock'] <= 0) {
                            echo '<p style="color: #dc3545; font-size: 1.2rem; font-weight: bold;">' . $t['conf_sin_stock'] . '</p>';
                        } elseif ($fila['stock'] < 5) {
                            echo '<p style="color: #ffc107; font-size: 1.2rem;">' . $t['conf_stock'] . ': ' . $fila['stock'] . ' ud.</p>';
                        }
                        ?>
                        <input type="radio" name="id_<?php echo $paso['tipo']; ?>" value="<?php echo $fila['id_producto']; ?>" required
                               <?php echo ($fila['stock'] <= 0) ? 'disabled' : ''; ?>>
                        <span><?php echo $t['conf_seleccionar']; ?></span>
                    </label>
                <?php
                }
                ?>
            </div>
        </section>
        <?php
        }
        ?>
        <div style="text-align:center; margin: 40px 0;">
            <button type="submit" class="btn btn-principal"><?php echo $t['conf_boton']; ?></button>
        </div>
    </form>
</main>

<?php include 'includes/footer.php'; ?>