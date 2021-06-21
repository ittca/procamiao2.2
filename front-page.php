<?php
get_header();?>
<link rel="stylesheet" href="css/slider.css">
<div id="pro_hom_sld">
  <?php get_template_part('inc/slider') ?>
</div>
<div class="interior">
  <div class="tc-inicio-novidades">
    <div class="setas">
      <span class="seta-esq" onclick="top_seg(-1)">&#10094;</span>
      <h1>Novidades</h1>
      <span class="seta-dir" onclick="top_seg(1)">&#10095;</span>
    </div>
    <div class="tc-ini-prod"> <?php
      novidades(24); ?>
    </div>
  </div>
  <div class="banner-ini-central">
    <img src='<?php echo wp_get_attachment_url( get_option( 'media_banner_central' ) ); ?>'>
  </div>
  <div class="tc-inicio-promos">
    <div class="setas">
      <span class="seta-esq" onclick="top_seg(-1)">&#10094;</span>
      <h1>Promoções</h1>
      <span class="seta-dir" onclick="top_seg(1)">&#10095;</span>
    </div>
    <div class="tc-ini-prod">  <?php
      promos(24); ?>
    </div>
  </div>
  <div class="tc-ini-dois">
    <div class="">
      <img src='<?php echo wp_get_attachment_url( get_option( 'media_ini_esq' ) ); ?>'>
    </div>
    <div class="tc-ini-dois2">
      <img src='<?php echo wp_get_attachment_url( get_option( 'media_ini_dir' ) ); ?>'>
    </div>
  </div>
  <div class="tc-inicio-topvendas">
    <div class="setas">
      <span class="seta-esq" onclick="top_seg(-1)">&#10094;</span>
      <h1>Top Vendas</h1>
      <span class="seta-dir" onclick="top_seg(1)">&#10095;</span>
    </div>
    <div class="tc-ini-prod"> <?php
      topvendas(24); ?>
    </div>
  </div>
</div> <?php
get_footer();
