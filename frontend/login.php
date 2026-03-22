<?php

// Si el usuario ya ha iniciado sesion, lo redirigimos segun su rol
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../backend/index_admin.php");
    } else {
        header("Location: index.php");
    }
    exit;
}

// Incluimos la conexion a la base de datos
include 'includes/header.php';

// Variable para mostrar mensajes de error
$mensaje = "";

// Comprobamos si el formulario ha sido enviado
if (isset($_POST['entrar'])) {

    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Comprobamos que los campos no esten vacios
    if (empty($email) || empty($password)) {
        $mensaje = "Por favor, rellena todos los campos.";

    } else {
        // Buscamos el usuario en la base de datos por su email
        $sql      = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows == 1) {
            // El email existe, comprobamos la contraseña
            $usuario = $resultado->fetch_assoc();

            // password_verify compara la contraseña introducida con el hash guardado en la BD
            if (password_verify($password, $usuario['password'])) {

                // Contraseña correcta, guardamos los datos en la sesion
                $_SESSION['usuario']    = $usuario['nombre'];
                $_SESSION['email']      = $usuario['email'];
                $_SESSION['rol']        = $usuario['rol'];
                $_SESSION['id_usuario'] = $usuario['id_usuario'];

                // Redirigimos segun el rol del usuario
                if ($usuario['rol'] == 'admin') {
                    header("Location: ../backend/index_admin.php");
                } else {
                    header("Location: index.php");
                }
                exit;

            } else {
                // Contraseña incorrecta
                $mensaje = "Email o contraseña incorrectos.";
            }

        } else {
            // El email no existe en la BD
            $mensaje = "Email o contraseña incorrectos.";
        }
    }
}
?>

<main class="container" style="margin-top: 100px;">

    <div style="max-width: 480px; margin: 6rem auto;">

        <h2 style="text-align: center; font-size: 3rem; margin-bottom: 0.5rem;">Iniciar Sesión</h2>
        <p style="text-align: center; color: #666; margin-bottom: 4rem;">Accede a tu cuenta de PCBuilder</p>

        <div style="background: white; padding: 3.5rem; border-radius: 1.2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">

            <!-- Mensaje de error si las credenciales son incorrectas -->
            <?php if ($mensaje != "") { ?>
                <div style="background: rgba(220,53,69,0.1); border-left: 4px solid #dc3545; color: #dc3545;
                            padding: 1.2rem 1.8rem; border-radius: 0.6rem; font-size: 1.4rem; margin-bottom: 2.5rem;">
                    <?php echo $mensaje; ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div style="margin-bottom: 2rem;">
                    <label style="display: block; font-size: 1.4rem; color: #666; margin-bottom: 0.5rem;">Email</label>
                    <input type="email" name="email" placeholder="tu@email.com"
                           style="width: 100%; padding: 1rem 1.4rem; font-size: 1.4rem; border: 1px solid #ddd; border-radius: 0.6rem;"
                           value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                </div>

                <div style="margin-bottom: 3rem;">
                    <label style="display: block; font-size: 1.4rem; color: #666; margin-bottom: 0.5rem;">Contraseña</label>
                    <input type="password" name="password" placeholder="••••••••"
                           style="width: 100%; padding: 1rem 1.4rem; font-size: 1.4rem; border: 1px solid #ddd; border-radius: 0.6rem;"
                           required>
                </div>

                <button type="submit" name="entrar" class="btn btn-principal"
                        style="width: 100%; text-align: center; margin-top: 0;">
                    Entrar
                </button>

            </form>

            <!-- Enlace para ir al registro -->
            <p style="text-align: center; font-size: 1.4rem; color: #666; margin-top: 2.5rem;">
                ¿No tienes cuenta? <a href="registro.php" style="color: #0327f5; font-weight: bold;">Regístrate aquí</a>
            </p>

        </div>
    </div>

</main>

<?php include 'includes/footer.php'; ?>