<?php 
// Utilizo el include para reutilizar el código del header y footer en todas las páginas.
include 'includes/header.php'; 
?>

    <main>
        <section class="hero">
            <div class="container">
                <h1>PCs a medida, <span>como tú los imaginas</span></h1>
                <h3>Diseña y personaliza tu PC gaming o de oficina con nuestro configurador visual en tiempo real.</h3>
                <a href="#servicios" class="btn btn-principal btn-hero-animate">Crear mi PC</a>
            </div>
        </section>

        <section id="servicios" class="seccion-padding">
            <div class="container">
                <h3 class="titulo-seccion">Nuestros Servicios</h3>
                <div class="grid-servicios">
                    <a href="configurador.php?id_cat=1" style="text-decoration: none; color: inherit;">
                        <article class="tarjeta">
                            <img src="assets/images/gaming-icon.png" alt="Gaming" style="width: 60px; margin-bottom: 15px;">
                            <h4>PC Gaming</h4>
                            <p>Equipos optimizados para alto rendimiento y estética gaming.</p>
                        </article>
                    </a>

                    <a href="configurador.php?id_cat=2" style="text-decoration: none; color: inherit;">
                        <article class="tarjeta">
                            <img src="assets/images/oficina-icon.png" alt="Oficina" style="width: 60px; margin-bottom: 15px;">
                            <h4>PC Oficina</h4>
                            <p>Soluciones fiables y silenciosas para el trabajo diario.</p>
                        </article>
                    </a>

                </div>
            </div>
        </section>

        <section id="diferencial" class="seccion-oscura">
            <div class="container">
                <h3 class="titulo-seccion">¿Por qué PCBuilder?</h3>
                <div class="grid-valores">
                    <div class="valor-item">
                        <h5>Configuración Visual</h5>
                        <p>Ves el PC antes de comprarlo.</p>
                    </div>
                    <div class="valor-item">
                        <h5>Compatibilidad</h5>
                        <p>Filtros automáticos para piezas.</p>
                    </div>
                    <div class="valor-item">
                        <h5>Venta Directa</h5>
                        <p>Sin intermediarios, mejores precios.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-final">
            <div class="container cta-contenido">
                <h2 class="titulo-cta">¿Listo para empezar?</h2>
                <p class="subtitulo-cta">Montado por profesionales con garantía total.</p>
                <a href="#servicios" class="btn btn-principal btn-hero-animate">Ir al configurador</a>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>