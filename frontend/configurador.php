<?php 
    // Hacemos conexion con la base de datos y mostramos el header.
    include 'includes/header.php';

    // Recogemos el id_cat que viene del index.php o ID1 o ID2.
    // Si alguien entra sin elegir, por defecto le ponemos ID1 (Gaming)
    $id_cat_usuario = isset($_GET['id_cat']) ? intval($_GET['id_cat']) : 1;
?>

<main class="container" style="margin-top: 100px;"> 
    <h2 style="text-align:center;">Configurador de PC</h2>
    <p style="text-align:center;">Selecciona los componentes para tu nuevo equipo</p>

    <form action="carrito.php" method="POST">
        <!-- Paso 1 - Seleccionar el procesador -->    
        <section class="paso-configuracion">
            <h3>Paso 1: Procesador</h3>
            <div class="contenedor-piezas">
                <?php

                // Uso id_cat_usuario para mostrar los componentes segun la categoria.
                $sql = "SELECT * FROM productos WHERE id_categoria = $id_cat_usuario AND tipo_componente = 'procesador'";
                $resultado = $conexion->query($sql);

                if (!$resultado) {
                    die("Error en la consulta: " . $conexion->error);
                }

               // Muestro los procesadores disponibles dependiendo de la categoria.
                while ($fila = $resultado->fetch_assoc()) {
                    ?>
                    <div class="tarjeta-pieza">
                        <img src="assets/images/<?php echo $fila['imagen_url']; ?>" width="100" alt="img">
                        <h4><?php echo $fila['nombre']; ?></h4>
                        <p>Precio: <strong><?php echo $fila['precio']; ?>€</strong></p>
                        <input type="radio" name="id_procesador" value="<?php echo $fila['id_producto']; ?>" required>
                        <span>Seleccionar</span>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>

            <!-- Paso 2 - Seleccionar la memoria RAM -->
        <section class="paso-configuracion" style="margin-top: 40px;">
            <h3>Paso 2: Memoria RAM</h3>
            <div class="contenedor-piezas">
                <?php
                // Uso id_cat_usuario para mostrar los componentes segun la categoria.
                $sql = "SELECT * FROM productos WHERE id_categoria = $id_cat_usuario AND tipo_componente = 'ram'";
                $resultado = $conexion->query($sql);

                if (!$resultado) {
                    die("Error en la consulta RAM: " . $conexion->error);
                }

                // Muestro los procesadores disponibles dependiendo de la categoria.
                while ($fila = $resultado->fetch_assoc()) {
                    ?>
                    <div class="tarjeta-pieza">
                        <img src="assets/images/<?php echo $fila['imagen_url']; ?>" width="100" alt="img">
                        <h4><?php echo $fila['nombre']; ?></h4>
                        <p>Precio: <strong><?php echo $fila['precio']; ?>€</strong></p>
                        <input type="radio" name="id_ram" value="<?php echo $fila['id_producto']; ?>" required>
                        <span>Seleccionar</span>
                    </div>
                    <?php
                }
                ?>
            </div>                        
        </section>

        <div style="text-align:center; margin: 40px 0;">
            <button type="submit" class="btn btn-principal">Añadir selección al carrito</button>
        </div>

    </form>
</main>

<?php 
    include 'includes/footer.php'; 
?>