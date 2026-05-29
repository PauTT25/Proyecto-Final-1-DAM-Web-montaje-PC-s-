<?php 
include 'includes/header.php';

// Recogemos el id_cat que viene del index.php (1 = Gaming, 2 = Oficina)
$id_cat_usuario = isset($_GET['id_cat']) ? intval($_GET['id_cat']) : 1;

// Usamos el array de pasos del archivo de traducciones segun el idioma
$pasos = $t['conf_pasos'];
?>

<main class="container" style="margin-top: 100px;">
    <button onclick="history.back()" class="btn" style="background: #666; color: white; padding: 1rem 2rem; margin-bottom: 2rem;">
    ← Volver
    </button>

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
                                data-precio="<?php echo $fila['precio']; ?>"
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
        <!-- Contador de precio acumulado -->
<div style="text-align:center; margin: 40px 0;">
    <div style="background: white; display: inline-block; padding: 2rem 4rem; border-radius: 1.2rem;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-bottom: 2rem; border-left: 5px solid #0327f5;">
        <p style="font-size: 1.4rem; color: #666; margin-bottom: 0.5rem;">Precio estimado de tu configuración</p>
        <p style="font-size: 3rem; font-weight: 800; color: #0327f5;">
            Total: <span id="precio-total">0.00</span>€
        </p>
    </div>
    <br>
    <button type="submit" class="btn btn-principal"><?php echo $t['conf_boton']; ?></button>
</div>

<!-- Script que suma los precios en tiempo real -->
<script>
    // Seleccionamos todos los radio buttons que tienen un precio
    var radios = document.querySelectorAll('input[type="radio"][data-precio]');

    // Funcion que recorre todos los radios seleccionados y suma sus precios
    function actualizarTotal() {
        var total = 0;

        radios.forEach(function(radio) {
            if (radio.checked) {
                total += parseFloat(radio.dataset.precio);
            }
        });

        // Mostramos el total con dos decimales en el span
        document.getElementById('precio-total').textContent = total.toFixed(2);
    }

    // Añadimos el evento a cada radio para que se ejecute al seleccionar
    radios.forEach(function(radio) {
        radio.addEventListener('change', actualizarTotal);
    });
</script>
    </form>
</main>

<?php include 'includes/footer.php'; ?>