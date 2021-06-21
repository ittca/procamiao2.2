<?php
defined( 'ABSPATH' ) || exit;
global $product, $post;
if (get_post_type( $post->ID ) == 'product' )
    update_post_meta( $post->ID, '_last_viewed', current_time('mysql') ); ?>
<div class="tc-produto-singular">
	<div class="tc-singular-sidebar"> <?php
		sb_novidades(5); ?>
		<div class="tc-recentemente"> <?php
		sb_recentes(6); ?>
		</div>
	</div>
	<div class="tc-singular">
		<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
			<div class="tc-prod-sing">
				<div class="tc-prod-sing-img"> <?php
				  $rp = null;
				  $sp = 0;
				  $sku = null;
					$id = get_the_id();
					$sku = get_post_meta($id, '_sku', true);
					$stock = get_post_meta($id, '_stock', true);
					$rp = get_post_meta($id, '_regular_price', true);
					$sp = get_post_meta($id, '_sale_price', true);
				  if ($sp){
				    $promo = sprintf('%.0f',(100-($sp * 100 ) / $rp));
				    $poupe = $rp - $sp;
				    $siva = sprintf('%.2f', $sp/1.23);
				    echo '<br><div class="tc-prod-sing-promo">Promoção  <promo>'.$promo.'%</promo></div><div class="tc-prod-sing-promo2">Poupe <br>'.$poupe.'€</div>';
				  } ?>
					<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
				</div>
			  <div class="tc-prod-sing-desc">
					<p class="tc-prod-sing-titulo"> <?php	echo get_the_title(); ?></p>
					<p class="tc-prod-sing-pdesc"><?php echo $product->get_short_description(); ?></p><?php
					if ($sp){
				    $promo = sprintf('%.0f',(100-($sp * 100 ) / $rp));
				    $poupe = $rp - $sp;
				    $siva = sprintf('%.2f', $sp/1.23);
				    echo '<div class="tc-prod-promo"><strike>'.$rp.'€</strike> <price>'.$sp.'€ *iva incluído</price><br><siva>('.$siva.'€ s/iva)</siva></div>';
				  }else{
				    $siva = sprintf('%.2f', $rp/1.23);
				    echo '<div class="tc-prod-promo"><price>  '.$rp.'€ c/iva</price><br><siva>('.$siva.'€ s/iva)</siva></div>';
				  }
					if ($stock > 0){
				    echo '<div class="tc-disp">Em stock</div>'; ?>
						<a href="?add-to-cart=<?php echo $id ?>" data-quantity="1" class="button add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $id ?>" data-product_sku="<?php $sku ?>" rel="nofollow">Adicionar</a> <?php
				  } else {
				    echo '<div class="tc-ndisp">Esgotado<br>'?>
				    <button type="button"> Encomendar </button>
						<button type="button">Receber alerta</button>
						</div> <?php

            $image =  get_post(get_post_thumbnail_id());
					} ?>
					<br>
					<div class="tc-singular-cats"> <?php
						echo '<titulo>Ref: '.$sku.'</titulo><br>';
						echo '<titulo>Categorias: </titulo>';
						$tiago =  get_the_terms( $id, 'product_cat' );
						foreach ($tiago as $ti){
							if ($ti->term_id != $tiago[0]->term_id){ echo ', ';}
							echo '<a href="'.home_url().'/categoria-produto/'.$ti->slug.'">'.$ti->name.'</a>';
						} ?>
					</div>
				</div>
			</div>
			<div class="tc-singular-info">
				<?php do_action( 'woocommerce_after_single_product_summary' );		// produtos relacionados ?>
			</div>
		</div>
	</div>
</div>
<?php
