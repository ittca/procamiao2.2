<!DOCTYPE html>
<html <?php // TODO: language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <?php   wp_head(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url(home_url());?>/wp-includes/css/dashicons.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  </head>
  <body <?php body_class(); ?>>
    <div class="cabeca-geral ">
      <header class="cabeca">
        <div class="cabeca-logo"><?php the_custom_logo(); ?> </div>
      </header>
    </div>
    <div class="cabeca-linha-geral sticky">
      <div class="cabeca-linha">

      </div>
    </div>
    <div class="corpo-geral">
