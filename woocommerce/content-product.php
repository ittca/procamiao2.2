<?php
/*
	apresentação da miniatura do produto em retângulo, modelo para todos os apresentados
*/

defined( 'ABSPATH' ) || exit;
global $product;
if ( empty( $product ) || ! $product->is_visible() ) { return; }
$rp = null;
$sp = 0;
$sku = null;
$n_eval = 0;
$med_eval = 0;
$id = get_the_id();
$sku = get_post_meta($id, '_sku', true);
$rp = get_post_meta($id, '_regular_price', true);
$sp = get_post_meta($id, '_sale_price', true);
$eval = get_post_meta($id, '_wc_rating_count', true);
$cats =  get_the_terms( $id, 'product_cat' );
if ($eval){
	foreach($eval as $ev => $e){
		$n_eval += 1;
		$med_eval += $ev;
	}
	$med_eval /= $n_eval;
} ?>
<div class="tc-categorias">
	<div class="tc-categorias-promo"> <?php
		if ($sp){
			$promo = sprintf('%.0f',((100-($sp * 100 ) / $rp)*-1));
			$siva = sprintf('%.2f', $sp/1.23);                                                         // valor sem iva
			echo '<p>Promoção</p><span></span><promo>'.$promo.'%</promo>';
		}?>
	</div>
	<div class="tc-categorias-thumbnail"><a href="<?php the_permalink(); ?>"><?php	the_post_thumbnail('thumbnail'); ?></a></div>
	<div class="pc-pdt-ref"><a href="<?php the_permalink(); ?>"><?php echo $cats[0]->name; ?> </a><a href="<?php the_permalink(); ?>"><?php echo $product->get_sku(); ?></a></div>	<?php // referência interna do produto?>
	<div class="tc-categorias-titulo"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></div>
	<div class="pc-pdt-desc"><a href="<?php the_permalink(); ?>"><?php echo the_excerpt(); ?></a></div>						<!-- Descrição curta --><?php									   	// preço?>
	<div class="pc-pdt-rvpr">
		<div class="tc-prod-preco">
			<a href="<?php the_permalink(); ?>"><?php
				$siva = sprintf('%.2f', $rp/1.23);
				if ($sp){
					echo '<strike>'.$rp.'€</strike>&nbsp;<price>'.$sp.' €</price>';
				}else{ echo '<price> '.$rp.' €</price>';} ?>
			</a>
		</div>
	</div>
	<div class="tc-prod-estrelas"> <?php
	 $n_aval = $product->get_rating_count();
	 $media  = $product->get_average_rating();
	 tc_rating($media, $n_aval);?>
	</div>
	<!--
	<div class="tc-categorias-adic"><?php /* do_action( 'woocommerce_after_shop_loop_item' );*/ ?></div>
	<div class="#"> -->
		<?php /* echo paginate_comments_links(); echo the_comments_navigation(); echo the_comments_pagination(); echo next_comments_link(); echo previous_comments_link(); */?> <!--
	</div> -->
</div>
