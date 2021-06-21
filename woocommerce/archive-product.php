<?php

defined( 'ABSPATH' ) || exit;

get_header();
  woocommerce_breadcrumb();?>
<div class="tc-cat-prod">
	<div class="tc-cat-prod-sb"> <?php
		 menu_int();?>
		<div class="tc-recentemente"> <?php
		 dynamic_sidebar( 'sb-produto' )?>
		</div>
	</div>
	<div class="tc-cat-prod-cat">
		<div class="tc-cat-ordenar"> <?php
		$n_res = numero_resultados();
		ordenar_por(); ?>
	</div>
	<div class="tc-cat-produto">	<?php
		if ($n_res){
			while (have_posts()): the_post();
				wc_get_template_part( 'content', 'product' );
			endwhile;
		} else {
			do_action( 'woocommerce_no_products_found' );
		} ?>
  </div>
	<div class="tc-pagination"> <?php
		the_posts_pagination() ; ?>
	</div>
</div> <?php
get_footer();
