<?php 
    // Hacemos conexion con la base de datos y mostramos el header.
    include 'includes/header.php';
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

                // 2. HACEMOS LA CONSULTA CON LA CONEXIÓN DE PRUEBA
                $sql = "SELECT * FROM productos WHERE id_categoria = 1";
                $resultado = mysqli_query($conexion, $sql);

                if (!$resultado) {
                    die("Error en la consulta: " . mysqli_error($conexion));
                }

                // 3. MOSTRAMOS LOS DATOS
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    ?>
                    <div class="tarjeta-pieza">
                        <img src="assets/images/<?php echo $fila['imagen_url']; ?>" width="100" alt="img">
                        <h4><?php echo $fila['nombre']; ?></h4>
                        <p>Precio: <strong><?php echo $fila['precio']; ?>€</strong></p>
                        <input type="radio" name="id_procesador" value="<?php echo $fila['id']; ?>" required>
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
                // Usamos el ID de categoría 2 para RAM
                $sql_ram = "SELECT * FROM productos WHERE id_categoria = 2";
                $res_ram = mysqli_query($conexion, $sql_ram);

                if (!$res_ram) {
                    die("Error en la consulta RAM: " . mysqli_error($conexion));
                }

                while ($fila = mysqli_fetch_assoc($res_ram)) {
                    ?>
                    <div class="tarjeta-pieza">
                        <img src="assets/images/<?php echo $fila['imagen_url']; ?>" width="100" alt="img">
                        <h4><?php echo $fila['nombre']; ?></h4>
                        <p>Precio: <strong><?php echo $fila['precio']; ?>€</strong></p>
                        <input type="radio" name="id_ram" value="<?php echo $fila['id']; ?>" required>
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