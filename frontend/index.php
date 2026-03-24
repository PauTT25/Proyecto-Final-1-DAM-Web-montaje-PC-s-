<?php 
include 'includes/header.php'; 
?>
<main>
<section class="hero">
<div class="container">
<h1><?php echo $t['hero_titulo']; ?></h1>
<h3><?php echo $t['hero_subtitulo']; ?></h3>
<a href="#servicios" class="btn btn-principal btn-hero-animate"><?php echo $t['hero_boton']; ?></a>
</div>
</section>

<section id="servicios" class="seccion-padding">
<div class="container">
<h3 class="titulo-seccion"><?php echo $t['servicios_titulo']; ?></h3>
<div class="grid-servicios">
<a href="configurador.php?id_cat=1" style="text-decoration: none; color: inherit;">
<article class="tarjeta">
<img src="assets/images/gaming-icon.png" alt="Gaming" style="width: 60px; margin-bottom: 15px;">
<h4><?php echo $t['gaming_titulo']; ?></h4>
<p><?php echo $t['gaming_desc']; ?></p>
</article>
</a>
<a href="configurador.php?id_cat=2" style="text-decoration: none; color: inherit;">
<article class="tarjeta">
<img src="assets/images/oficina-icon.png" alt="Oficina" style="width: 60px; margin-bottom: 15px;">
<h4><?php echo $t['oficina_titulo']; ?></h4>
<p><?php echo $t['oficina_desc']; ?></p>
</article>
</a>
</div>
</div>
</section>

<section id="diferencial" class="seccion-oscura">
<div class="container">
<h3 class="titulo-seccion"><?php echo $t['ventajas_titulo']; ?></h3>
<div class="grid-valores">
<div class="valor-item">
<h5><?php echo $t['ventaja1_titulo']; ?></h5>
<p><?php echo $t['ventaja1_desc']; ?></p>
</div>
<div class="valor-item">
<h5><?php echo $t['ventaja2_titulo']; ?></h5>
<p><?php echo $t['ventaja2_desc']; ?></p>
</div>
<div class="valor-item">
<h5><?php echo $t['ventaja3_titulo']; ?></h5>
<p><?php echo $t['ventaja3_desc']; ?></p>
</div>
</div>
</div>
</section>

<section class="cta-final">
<div class="container cta-contenido">
<h2 class="titulo-cta"><?php echo $t['cta_titulo']; ?></h2>
<p class="subtitulo-cta"><?php echo $t['cta_subtitulo']; ?></p>
<a href="#servicios" class="btn btn-principal btn-hero-animate"><?php echo $t['cta_boton']; ?></a>
</div>
</section>
</main>
<?php include 'includes/footer.php'; ?>