<?php
include 'includes/header.php';

// Si el usuario ya ha iniciado sesion, lo redirigimos segun su rol
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../backend/index_admin.php");
    } else {
        header("Location: index.php");
    }
    exit;
}

$mensaje = "";

if (isset($_POST['entrar'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $mensaje = $t['login_campos'];
    } else {
        $sql      = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows == 1) {
            $usuario = $resultado->fetch_assoc();
            if (password_verify($password, $usuario['password'])) {
                $_SESSION['usuario']    = $usuario['nombre'];
                $_SESSION['email']      = $usuario['email'];
                $_SESSION['rol']        = $usuario['rol'];
                $_SESSION['id_usuario'] = $usuario['id_usuario'];

                if ($usuario['rol'] == 'admin') {
                    header("Location: ../backend/index_admin.php");
                } else {
                    header("Location: index.php");
                }
                exit;
            } else {
                $mensaje = $t['login_error'];
            }
        } else {
            $mensaje = $t['login_error'];
        }
    }
}
?>

<main class="container" style="margin-top: 100px;">
    <div style="max-width: 480px; margin: 6rem auto;">

        <h2 style="text-align: center; font-size: 3rem; margin-bottom: 0.5rem;"><?php echo $t['login_titulo']; ?></h2>
        <p style="text-align: center; color: #666; margin-bottom: 4rem;"><?php echo $t['login_subtitulo']; ?></p>

        <div style="background: white; padding: 3.5rem; border-radius: 1.2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">

            <?php if ($mensaje != "") { ?>
                <div style="background: rgba(220,53,69,0.1); border-left: 4px solid #dc3545; color: #dc3545;
                            padding: 1.2rem 1.8rem; border-radius: 0.6rem; font-size: 1.4rem; margin-bottom: 2.5rem;">
                    <?php echo $mensaje; ?>
                </div>
            <?php } ?>

            <form method="POST">
                <div style="margin-bottom: 2rem;">
                    <label style="display: block; font-size: 1.4rem; color: #666; margin-bottom: 0.5rem;"><?php echo $t['login_email']; ?></label>
                    <input type="email" name="email" placeholder="tu@email.com"
                           style="width: 100%; padding: 1rem 1.4rem; font-size: 1.4rem; border: 1px solid #ddd; border-radius: 0.6rem;"
                           value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                </div>
                <div style="margin-bottom: 3rem;">
                    <label style="display: block; font-size: 1.4rem; color: #666; margin-bottom: 0.5rem;"><?php echo $t['login_password']; ?></label>
                    <input type="password" name="password" placeholder="••••••••"
                           style="width: 100%; padding: 1rem 1.4rem; font-size: 1.4rem; border: 1px solid #ddd; border-radius: 0.6rem;"
                           required>
                </div>
                <button type="submit" name="entrar" class="btn btn-principal" style="width: 100%; text-align: center; margin-top: 0;">
                    <?php echo $t['login_boton']; ?>
                </button>
            </form>

            <p style="text-align: center; font-size: 1.4rem; color: #666; margin-top: 2.5rem;">
                <?php echo $t['login_registro']; ?> <a href="registro.php" style="color: #0327f5; font-weight: bold;"><?php echo $t['login_registro_enlace']; ?></a>
            </p>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>