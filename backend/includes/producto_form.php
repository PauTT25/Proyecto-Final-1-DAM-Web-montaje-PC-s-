<!doctype html>
<html lang="es">
<head>
    <title>Producto - PCBuilder</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../frontend/assets/CSS/estilos.css">
    <style>
        body { background:#1a1a1a; color:#fff; padding-top: 8rem; }

        .form-card {
            background: rgba(255,255,255,0.05);
            border-radius: 1.2rem;
            padding: 3.5rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .campo { margin-bottom: 2rem; }

        .campo label {
            display: block;
            font-size: 1.4rem;
            color: #aaa;
            margin-bottom: 0.5rem;
        }

        .campo input,
        .campo select {
            width: 100%;
            padding: 1rem 1.4rem;
            font-size: 1.4rem;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 0.6rem;
            color: #fff;
        }

        .mensaje-error {
            background: rgba(220,53,69,0.15);
            border-left: 4px solid #dc3545;
            color: #f08080;
            padding: 1.2rem 1.8rem;
            border-radius: 0.6rem;
            font-size: 1.4rem;
            margin-bottom: 2.5rem;
        }

        .botones {
            display: flex;
            justify-content: space-between;
            margin-top: 3rem;
        }

        .btn-cancelar {
            background: transparent;
            color: #aaa;
            border: 1px solid #444;
            padding: 1rem 2rem;
            border-radius: 0.6rem;
            text-decoration: none;
            font-size: 1.4rem;
        }
    </style>
</head>
<body>

<?php
// Incluimos la conexion a la base de datos
include "conexion.php";

// Comprobamos si nos llega un ID por la URL para saber si estamos editando o creando
// Si no llega ID, lo ponemos a 0 (modo nuevo)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Variable para guardar los datos del producto si estamos editando
$producto = null;

// Si el ID es mayor que 0, estamos en modo edicion y buscamos el producto
if ($id > 0) {
    $resultado = $conexion->query("SELECT * FROM productos WHERE id_producto = $id");
    $producto = $resultado->fetch_assoc();
}

// Variable para mostrar mensajes de error al usuario
$mensaje = "";

// Comprobamos si el formulario ha sido enviado
if (isset($_POST['guardar'])) {

    // Recogemos los datos del formulario
    $nombre          = $_POST['nombre'];
    $marca           = $_POST['marca'];
    $precio          = $_POST['precio'];
    $stock           = $_POST['stock'];
    $tipo_componente = $_POST['tipo_componente'];
    $id_categoria    = $_POST['id_categoria'];
    $imagen_url      = $_POST['imagen_url'];

    // Validacion basica: comprobamos que los campos obligatorios no esten vacios
    if (empty($nombre) || empty($marca) || empty($precio) || empty($tipo_componente) || empty($id_categoria)) {
        $mensaje = "Por favor, rellena todos los campos obligatorios.";

    } else {
        // Todo correcto, decidimos si hacer INSERT o UPDATE segun el modo
        if ($id == 0) {
            // Modo nuevo: insertamos el producto en la base de datos
            $sql = "INSERT INTO productos (nombre, marca, precio, stock, tipo_componente, id_categoria, imagen_url)
                    VALUES ('$nombre', '$marca', '$precio', '$stock', '$tipo_componente', '$id_categoria', '$imagen_url')";

            if ($conexion->query($sql)) {
                header("Location: ../index_admin.php?msg=creado");
                exit;
            } else {
                $mensaje = "Error al guardar: " . $conexion->error;
            }

        } else {
            // Modo edicion: actualizamos el producto existente
            $sql = "UPDATE productos
                    SET nombre='$nombre', marca='$marca', precio='$precio', stock='$stock',
                        tipo_componente='$tipo_componente', id_categoria='$id_categoria', imagen_url='$imagen_url'
                    WHERE id_producto = $id";

            if ($conexion->query($sql)) {
                header("Location: ../index_admin.php?msg=actualizado");
                exit;
            } else {
                $mensaje = "Error al actualizar: " . $conexion->error;
            }
        }
    }
}

// Traemos las categorias para el desplegable del formulario
$categorias = $conexion->query("SELECT * FROM categorias");
?>

<!-- HEADER -->
<header>
    <div class="header-flex container">
        <div class="logo-container">
            <h1 class="logo-texto">PC<span>ADMIN</span></h1>
        </div>
        <nav>
            <ul class="nav-list">
                <li><a href="../index_admin.php">← Volver al Panel</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="container seccion-padding">

    <h2 class="titulo-seccion">
        <?php
        // Mostramos un titulo diferente segun si estamos editando o creando
        if ($id > 0) {
            echo "Editar Producto";
        } else {
            echo "Nuevo Producto";
        }
        ?>
    </h2>

    <div class="form-card">

        <!-- Mostramos el mensaje de error si existe -->
        <?php if ($mensaje != "") { ?>
            <div class="mensaje-error">
                <?php echo $mensaje; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <div class="campo">
                <label>Nombre *</label>
                <input type="text" name="nombre" placeholder="Ej: AMD Ryzen 5 5600X"
                       value="<?php echo isset($producto['nombre']) ? $producto['nombre'] : ''; ?>" required>
            </div>

            <div class="campo">
                <label>Marca *</label>
                <input type="text" name="marca" placeholder="Ej: AMD, Intel, Corsair..."
                       value="<?php echo isset($producto['marca']) ? $producto['marca'] : ''; ?>" required>
            </div>

            <div class="campo">
                <label>Precio (€) *</label>
                <input type="number" name="precio" step="0.01" min="0" placeholder="0.00"
                       value="<?php echo isset($producto['precio']) ? $producto['precio'] : ''; ?>" required>
            </div>

            <div class="campo">
                <label>Stock (unidades)</label>
                <input type="number" name="stock" min="0" placeholder="0"
                       value="<?php echo isset($producto['stock']) ? $producto['stock'] : '0'; ?>">
            </div>

            <div class="campo">
                <label>Tipo de componente *</label>
                <select name="tipo_componente" required>
                    <option value="">-- Selecciona --</option>
                    <?php
                    // Array con los tipos disponibles para generar las opciones del select
                    $tipos = array('procesador', 'ram', 'gpu', 'almacenamiento', 'placa_base', 'fuente', 'caja');
                    foreach ($tipos as $t) {
                        // Si el tipo coincide con el del producto actual, lo marcamos como seleccionado
                        $seleccionado = (isset($producto['tipo_componente']) && $producto['tipo_componente'] == $t) ? 'selected' : '';
                        echo "<option value='$t' $seleccionado>" . ucfirst($t) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="campo">
                <label>Categoría *</label>
                <select name="id_categoria" required>
                    <option value="">-- Selecciona --</option>
                    <?php
                    // Recorremos las categorias que trajimos de la base de datos
                    while ($cat = $categorias->fetch_assoc()) {
                        $seleccionado = (isset($producto['id_categoria']) && $producto['id_categoria'] == $cat['id_categoria']) ? 'selected' : '';
                        echo "<option value='" . $cat['id_categoria'] . "' $seleccionado>" . $cat['nombre_categoria'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="campo">
                <label>Nombre de imagen</label>
                <input type="text" name="imagen_url" placeholder="Ej: cpu-r5.jpg"
                       value="<?php echo isset($producto['imagen_url']) ? $producto['imagen_url'] : ''; ?>">
            </div>

            <div class="botones">
                <a href="../index_admin.php" class="btn-cancelar">Cancelar</a>
                <button type="submit" name="guardar" class="btn btn-principal" style="margin-top:0;">
                    <?php echo ($id > 0) ? 'Guardar cambios' : 'Crear producto'; ?>
                </button>
            </div>

        </form>
    </div>

</main>
</body>
</html>