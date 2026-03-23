<?php

// Si el usuario ya ha iniciado sesion no tiene sentido que este aqui
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

include 'includes/header.php';

$mensaje = "";
$tipo_mensaje = "";

// Comprobamos si el formulario ha sido enviado
if (isset($_POST['registrar'])) {

    $nombre   = $_POST['nombre'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $repetir  = $_POST['repetir_password'];

    // Validaciones basicas
    if (empty($nombre) || empty($email) || empty($password) || empty($repetir)) {
        $mensaje = "Por favor, rellena todos los campos.";
        $tipo_mensaje = "error";

    } elseif ($password != $repetir) {
        // Las dos contraseñas tienen que coincidir
        $mensaje = "Las contraseñas no coinciden.";
        $tipo_mensaje = "error";

    } elseif (strlen($password) < 6) {
        // La contraseña tiene que tener al menos 6 caracteres
        $mensaje = "La contraseña debe tener al menos 6 caracteres.";
        $tipo_mensaje = "error";

        // Validacion de la checkbox de terminos y servicios
    } elseif (!isset($_POST['acepta_terminos'])) {
        $mensaje = "Debes aceptar la política de privacidad para registrarte.";
        $tipo_mensaje = "error";

    } else {
        // Comprobamos si el email ya esta registrado
        $check = $conexion->query("SELECT id_usuario FROM usuarios WHERE email = '$email'");

        if ($check->num_rows > 0) {
            $mensaje = "Este email ya está registrado. Prueba a iniciar sesión.";
            $tipo_mensaje = "error";

        } else {
            // Todo correcto, ciframos la contraseña y guardamos el usuario
            // password_hash() cifra la contraseña para que no se guarde en texto plano
            $password_cifrada = password_hash($password, PASSWORD_DEFAULT);

            // Los nuevos registros siempre son clientes, nunca admins
            $sql = "INSERT INTO usuarios (nombre, email, password, rol)
                    VALUES ('$nombre', '$email', '$password_cifrada', 'cliente')";

            if ($conexion->query($sql)) {
                $mensaje = "Cuenta creada correctamente. Ya puedes iniciar sesión.";
                $tipo_mensaje = "ok";
            } else {
                $mensaje = "Error al crear la cuenta: " . $conexion->error;
                $tipo_mensaje = "error";
            }
        }
    }
}
?>

<main class="container" style="margin-top: 100px;">

    <div style="max-width: 480px; margin: 6rem auto;">

        <h2 style="text-align: center; font-size: 3rem; margin-bottom: 0.5rem;">Crear Cuenta</h2>
        <p style="text-align: center; color: #666; margin-bottom: 4rem;">Regístrate para configurar tu PC</p>

        <div style="background: white; padding: 3.5rem; border-radius: 1.2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">

            <?php if ($mensaje != "") { 
                $color_borde = ($tipo_mensaje == "ok") ? "#28a745" : "#dc3545";
                $color_fondo = ($tipo_mensaje == "ok") ? "rgba(40,167,69,0.1)" : "rgba(220,53,69,0.1)";
                $color_texto = ($tipo_mensaje == "ok") ? "#28a745" : "#dc3545";
            ?>
                <div style="background: <?php echo $color_fondo; ?>; border-left: 4px solid <?php echo $color_borde; ?>;
                            color: <?php echo $color_texto; ?>; padding: 1.2rem 1.8rem; border-radius: 0.6rem;
                            font-size: 1.4rem; margin-bottom: 2.5rem;">
                    <?php echo $mensaje; ?>
                    <?php if ($tipo_mensaje == "ok") { ?>
                        <br><a href="login.php" style="color: #0327f5; font-weight: bold;">Ir al login →</a>
                    <?php } ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div style="margin-bottom: 2rem;">
                    <label style="display: block; font-size: 1.4rem; color: #666; margin-bottom: 0.5rem;">Nombre</label>
                    <input type="text" name="nombre" placeholder="Tu nombre"
                           style="width: 100%; padding: 1rem 1.4rem; font-size: 1.4rem; border: 1px solid #ddd; border-radius: 0.6rem;"
                           value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>" required>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label style="display: block; font-size: 1.4rem; color: #666; margin-bottom: 0.5rem;">Email</label>
                    <input type="email" name="email" placeholder="tu@email.com"
                           style="width: 100%; padding: 1rem 1.4rem; font-size: 1.4rem; border: 1px solid #ddd; border-radius: 0.6rem;"
                           value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label style="display: block; font-size: 1.4rem; color: #666; margin-bottom: 0.5rem;">Contraseña</label>
                    <input type="password" name="password" placeholder="Mínimo 6 caracteres"
                           style="width: 100%; padding: 1rem 1.4rem; font-size: 1.4rem; border: 1px solid #ddd; border-radius: 0.6rem;"
                           required>
                </div>

                <div style="margin-bottom: 3rem;">
                    <label style="display: block; font-size: 1.4rem; color: #666; margin-bottom: 0.5rem;">Repetir contraseña</label>
                    <input type="password" name="repetir_password" placeholder="Repite la contraseña"
                           style="width: 100%; padding: 1rem 1.4rem; font-size: 1.4rem; border: 1px solid #ddd; border-radius: 0.6rem;"
                           required>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label style="display: flex; align-items: flex-start; gap: 1rem; font-size: 1.4rem; color: #666; cursor: pointer;">
                        <input type="checkbox" name="acepta_terminos" style="width: auto; margin-top: 0.3rem;" required>
                        <span>He leído y acepto la <a href="privacidad.php" target="_blank" style="color: #0327f5;">Política de Privacidad</a> y los <a href="privacidad.php" target="_blank" style="color: #0327f5;">Términos y Condiciones</a></span>
                    </label>
                </div>

                <button type="submit" name="registrar" class="btn btn-principal"
                        style="width: 100%; text-align: center; margin-top: 0;">
                    Crear cuenta
                </button>

            </form>

            <!-- Enlace para volver al login -->
            <p style="text-align: center; font-size: 1.4rem; color: #666; margin-top: 2.5rem;">
                ¿Ya tienes cuenta? <a href="login.php" style="color: #0327f5; font-weight: bold;">Inicia sesión</a>
            </p>

        </div>
    </div>

</main>

<?php include 'includes/footer.php'; ?>