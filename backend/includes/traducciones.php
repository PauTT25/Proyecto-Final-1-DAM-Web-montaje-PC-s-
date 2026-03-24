<?php
// Comprobamos el idioma guardado en la sesion
// Si no hay idioma guardado, usamos español por defecto
$idioma = isset($_SESSION['idioma']) ? $_SESSION['idioma'] : 'es';

// Array con todas las traducciones de la web
// Para usar un texto: echo $t['clave'];
$t = array();

if ($idioma == 'es') {

    // ── HEADER Y NAVEGACION ──────────────────────────────
    $t['nav_servicios']     = 'Servicios';
    $t['nav_ventajas']      = 'Ventajas';
    $t['nav_contacto']      = 'Contacto';
    $t['nav_mi_cuenta']     = 'Mi Cuenta';
    $t['nav_cerrar_sesion'] = 'Cerrar sesión';
    $t['nav_hola']          = 'Hola';

    // ── INDEX ────────────────────────────────────────────
    $t['hero_titulo']       = 'PCs a medida, <span>como tú los imaginas</span>';
    $t['hero_subtitulo']    = 'Diseña y personaliza tu PC gaming o de oficina con nuestro configurador visual en tiempo real.';
    $t['hero_boton']        = 'Crear mi PC';
    $t['servicios_titulo']  = 'Nuestros Servicios';
    $t['gaming_titulo']     = 'PC Gaming';
    $t['gaming_desc']       = 'Equipos optimizados para alto rendimiento y estética gaming.';
    $t['oficina_titulo']    = 'PC Oficina';
    $t['oficina_desc']      = 'Soluciones fiables y silenciosas para el trabajo diario.';
    $t['ventajas_titulo']   = '¿Por qué PCBuilder?';
    $t['ventaja1_titulo']   = 'Configuración Visual';
    $t['ventaja1_desc']     = 'Ves el PC antes de comprarlo.';
    $t['ventaja2_titulo']   = 'Compatibilidad';
    $t['ventaja2_desc']     = 'Filtros automáticos para piezas.';
    $t['ventaja3_titulo']   = 'Venta Directa';
    $t['ventaja3_desc']     = 'Sin intermediarios, mejores precios.';
    $t['cta_titulo']        = '¿Listo para empezar?';
    $t['cta_subtitulo']     = 'Montado por profesionales con garantía total.';
    $t['cta_boton']         = 'Ir al configurador';

    // ── CONFIGURADOR ─────────────────────────────────────
    $t['conf_titulo']       = 'Configurador de PC';
    $t['conf_subtitulo']    = 'Selecciona los componentes para tu nuevo equipo';
    $t['conf_paso']         = 'Paso';
    $t['conf_boton']        = 'Ver resumen del presupuesto';
    $t['conf_sin_stock']    = 'Sin stock';
    $t['conf_stock']        = 'Stock';
    $t['conf_precio']       = 'Precio';
    $t['conf_seleccionar']  = 'Seleccionar';
    $t['conf_sin_comp']     = 'No hay componentes disponibles para esta categoría todavía.';
    $t['conf_pasos'] = array(
        1 => array('titulo' => 'Procesador',            'tipo' => 'procesador'),
        2 => array('titulo' => 'Memoria RAM',            'tipo' => 'ram'),
        3 => array('titulo' => 'Tarjeta Gráfica (GPU)',  'tipo' => 'gpu'),
        4 => array('titulo' => 'Almacenamiento',         'tipo' => 'almacenamiento'),
        5 => array('titulo' => 'Placa Base',             'tipo' => 'placa_base'),
        6 => array('titulo' => 'Fuente de Alimentación', 'tipo' => 'fuente'),
    );

    // ── CARRITO ──────────────────────────────────────────
    $t['carrito_titulo']    = 'Resumen de tu Configuración';
    $t['carrito_comp']      = 'Componente';
    $t['carrito_modelo']    = 'Modelo';
    $t['carrito_precio']    = 'Precio';
    $t['carrito_total']     = 'TOTAL';
    $t['carrito_volver']    = 'Volver al inicio';
    $t['carrito_imprimir']  = 'Imprimir Presupuesto';
    $t['carrito_confirmar'] = 'Confirmar compra';
    $t['carrito_realizada'] = 'Compra realizada';
    $t['carrito_ok']        = '✔ ¡Compra confirmada! Tu pedido ha sido registrado correctamente.';

    // ── LOGIN ────────────────────────────────────────────
    $t['login_titulo']      = 'Iniciar Sesión';
    $t['login_subtitulo']   = 'Accede a tu cuenta de PCBuilder';
    $t['login_email']       = 'Email';
    $t['login_password']    = 'Contraseña';
    $t['login_boton']       = 'Entrar';
    $t['login_registro']    = '¿No tienes cuenta?';
    $t['login_registro_enlace'] = 'Regístrate aquí';
    $t['login_error']       = 'Email o contraseña incorrectos.';
    $t['login_campos']      = 'Por favor, rellena todos los campos.';

    // ── REGISTRO ─────────────────────────────────────────
    $t['reg_titulo']        = 'Crear Cuenta';
    $t['reg_subtitulo']     = 'Regístrate para configurar tu PC';
    $t['reg_nombre']        = 'Nombre';
    $t['reg_email']         = 'Email';
    $t['reg_password']      = 'Contraseña';
    $t['reg_repetir']       = 'Repetir contraseña';
    $t['reg_boton']         = 'Crear cuenta';
    $t['reg_login']         = '¿Ya tienes cuenta?';
    $t['reg_login_enlace']  = 'Inicia sesión';
    $t['reg_terminos']      = 'He leído y acepto la';
    $t['reg_privacidad']    = 'Política de Privacidad';
    $t['reg_y']             = 'y los';
    $t['reg_terminos2']     = 'Términos y Condiciones';

    // ── FOOTER ───────────────────────────────────────────
    $t['footer_copy']       = '© 2026 PCBuilder - Proyecto Programación DAM';
    $t['footer_contacto']   = 'Contacto';

    // ── ADMIN ────────────────────────────────────────────
    $t['admin_titulo']      = 'Gestión de Inventario';
    $t['admin_productos']   = 'Total Productos';
    $t['admin_stock_bajo']  = 'Stock Bajo';
    $t['admin_catalogo']    = 'Catálogo de Componentes';
    $t['admin_añadir']      = '+ Añadir Producto';
    $t['admin_gaming']      = '🎮 Componentes Gaming';
    $t['admin_oficina']     = '🖥️ Componentes Oficina';
    $t['admin_usuarios']    = '👤 Usuarios Registrados';
    $t['admin_ver_tienda']  = 'Ver Tienda';
    $t['admin_salir']       = 'Salir';

} else {

    // ── HEADER Y NAVEGACION ──────────────────────────────
    $t['nav_servicios']     = 'Services';
    $t['nav_ventajas']      = 'Advantages';
    $t['nav_contacto']      = 'Contact';
    $t['nav_mi_cuenta']     = 'My Account';
    $t['nav_cerrar_sesion'] = 'Log out';
    $t['nav_hola']          = 'Hello';

    // ── INDEX ────────────────────────────────────────────
    $t['hero_titulo']       = 'Custom PCs, <span>just as you imagine them</span>';
    $t['hero_subtitulo']    = 'Design and customize your gaming or office PC with our real-time visual configurator.';
    $t['hero_boton']        = 'Build my PC';
    $t['servicios_titulo']  = 'Our Services';
    $t['gaming_titulo']     = 'Gaming PC';
    $t['gaming_desc']       = 'High-performance equipment optimized for gaming aesthetics.';
    $t['oficina_titulo']    = 'Office PC';
    $t['oficina_desc']      = 'Reliable and silent solutions for daily work.';
    $t['ventajas_titulo']   = 'Why PCBuilder?';
    $t['ventaja1_titulo']   = 'Visual Configuration';
    $t['ventaja1_desc']     = 'See the PC before you buy it.';
    $t['ventaja2_titulo']   = 'Compatibility';
    $t['ventaja2_desc']     = 'Automatic filters for parts.';
    $t['ventaja3_titulo']   = 'Direct Sales';
    $t['ventaja3_desc']     = 'No middlemen, better prices.';
    $t['cta_titulo']        = 'Ready to start?';
    $t['cta_subtitulo']     = 'Assembled by professionals with full warranty.';
    $t['cta_boton']         = 'Go to configurator';

    // ── CONFIGURADOR ─────────────────────────────────────
    $t['conf_titulo']       = 'PC Configurator';
    $t['conf_subtitulo']    = 'Select the components for your new equipment';
    $t['conf_paso']         = 'Step';
    $t['conf_boton']        = 'See budget summary';
    $t['conf_sin_stock']    = 'Out of stock';
    $t['conf_stock']        = 'Stock';
    $t['conf_precio']       = 'Price';
    $t['conf_seleccionar']  = 'Select';
    $t['conf_sin_comp']     = 'No components available for this category yet.';
    $t['conf_pasos'] = array(
        1 => array('titulo' => 'Processor',          'tipo' => 'procesador'),
        2 => array('titulo' => 'RAM Memory',          'tipo' => 'ram'),
        3 => array('titulo' => 'Graphics Card (GPU)', 'tipo' => 'gpu'),
        4 => array('titulo' => 'Storage',             'tipo' => 'almacenamiento'),
        5 => array('titulo' => 'Motherboard',         'tipo' => 'placa_base'),
        6 => array('titulo' => 'Power Supply',        'tipo' => 'fuente'),
    );

    // ── CARRITO ──────────────────────────────────────────
    $t['carrito_titulo']    = 'Your Configuration Summary';
    $t['carrito_comp']      = 'Component';
    $t['carrito_modelo']    = 'Model';
    $t['carrito_precio']    = 'Price';
    $t['carrito_total']     = 'TOTAL';
    $t['carrito_volver']    = 'Back to home';
    $t['carrito_imprimir']  = 'Print Budget';
    $t['carrito_confirmar'] = 'Confirm purchase';
    $t['carrito_realizada'] = 'Purchase completed';
    $t['carrito_ok']        = '✔ Purchase confirmed! Your order has been registered correctly.';

    // ── LOGIN ────────────────────────────────────────────
    $t['login_titulo']      = 'Log In';
    $t['login_subtitulo']   = 'Access your PCBuilder account';
    $t['login_email']       = 'Email';
    $t['login_password']    = 'Password';
    $t['login_boton']       = 'Enter';
    $t['login_registro']    = "Don't have an account?";
    $t['login_registro_enlace'] = 'Register here';
    $t['login_error']       = 'Incorrect email or password.';
    $t['login_campos']      = 'Please fill in all fields.';

    // ── REGISTRO ─────────────────────────────────────────
    $t['reg_titulo']        = 'Create Account';
    $t['reg_subtitulo']     = 'Register to configure your PC';
    $t['reg_nombre']        = 'Name';
    $t['reg_email']         = 'Email';
    $t['reg_password']      = 'Password';
    $t['reg_repetir']       = 'Repeat password';
    $t['reg_boton']         = 'Create account';
    $t['reg_login']         = 'Already have an account?';
    $t['reg_login_enlace']  = 'Log in';
    $t['reg_terminos']      = 'I have read and accept the';
    $t['reg_privacidad']    = 'Privacy Policy';
    $t['reg_y']             = 'and the';
    $t['reg_terminos2']     = 'Terms and Conditions';

    // ── FOOTER ───────────────────────────────────────────
    $t['footer_copy']       = '© 2026 PCBuilder - DAM Programming Project';
    $t['footer_contacto']   = 'Contact';

    // ── ADMIN ────────────────────────────────────────────
    $t['admin_titulo']      = 'Inventory Management';
    $t['admin_productos']   = 'Total Products';
    $t['admin_stock_bajo']  = 'Low Stock';
    $t['admin_catalogo']    = 'Component Catalogue';
    $t['admin_añadir']      = '+ Add Product';
    $t['admin_gaming']      = '🎮 Gaming Components';
    $t['admin_oficina']     = '🖥️ Office Components';
    $t['admin_usuarios']    = '👤 Registered Users';
    $t['admin_ver_tienda']  = 'View Store';
    $t['admin_salir']       = 'Log out';
}
?>