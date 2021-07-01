<?php
function imp($a){
	echo '<pre>';
	print_r($a);
	echo '</pre>';
	die();
}
/*#################   funções do tema raíz   #################*/
add_theme_support('custom-background');
add_theme_support('custom-logo');
add_theme_support('menus');
add_theme_support( 'title-tag' );
add_theme_support( 'woocommerce' );
add_theme_support('post-thumbnails');
add_theme_support('html5',array('search-form'));

if (! function_exists('ad_ficheiros')) {
	function ad_ficheiros(){
		wp_enqueue_style('stylecss', get_template_directory_uri().'/style.css', false, '20210531');
	  wp_enqueue_style('tiagoscss', get_template_directory_uri().'/css/frontpage.css', array(), '0.0.1', 'all');
		wp_enqueue_style('slidercss', get_template_directory_uri().'/css/slider.css', array(), '0.0.1', 'all');
	  wp_enqueue_script('tiagosjs', get_template_directory_uri().'/js/procamiao.js', array(), '0.0.1', true);
	}
	add_action('wp_enqueue_scripts', 'ad_ficheiros');
}
if (! function_exists('tc_editor')) {
  function tc_editor(){
    add_menu_page('tiago\'s', 'Procamiao', 'manage_options', 'editor_tiagos', 'tc_banners', home_url().'/wp-content/themes/procamiao/inc/mini_logo.png', 4);
    add_submenu_page('editor_tiagos', 'separador_banners', 'Banners', 'manage_options','editor_tiagos');
    add_submenu_page('editor_tiagos', 'separador_default', 'Default', 'manage_options','editor_tabelas', 'tc_default');
  }
  add_action('admin_menu', 'tc_editor');
  function tc_banners(){require_once plugin_dir_path(__FILE__).'inc/banners.php';}
  function tc_default(){require_once plugin_dir_path(__FILE__).'inc/default.php';}
}
if (! function_exists('novidades')) {
	function novidades($n){
		  $args = array(
		    'post_type' => 'product',
		    'posts_per_page' => $n,
		    'orderby' => 'date',
		    'order' => 'desc',
		  );
		  query_posts( $args );
		  if( have_posts() ) :
        while (have_posts()): the_post();
  				wc_get_template_part( 'content', 'product' );
  			endwhile;
		  endif;
		  wp_reset_query();
	}
}
if (! function_exists('promos')) {
	function promos($n){
		  $args = array(
		    'post_type' => 'product',
		    'posts_per_page' => $n,
  			'orderby'   => 'date',
  			'meta_key'  => 'total_sales',
  			'order' => 'desc',
		  );
		  query_posts( $args );
		  if( have_posts() ) :
        while (have_posts()): the_post();
  				wc_get_template_part( 'content', 'product' );
  			endwhile;
		  endif;
		  wp_reset_query();
	}
}
if (! function_exists('topvendas')) {
	function topvendas($n){
		  $args = array(
		    'posts_per_page' => $n,
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'meta_key' => 'total_sales',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
		  );
		  query_posts( $args );
		  if( have_posts() ) :
        while (have_posts()): the_post();
  				wc_get_template_part( 'content', 'product' );
  			endwhile;
		  endif;
		  wp_reset_query();
	}
}

if (! function_exists('criar_pag')) {
	function criar_pag($titulo, $template){
		$a = get_page_by_title( $titulo, 'post' );
		if ($a == null || $a->post_status == 'trash') {
			$pagina = array(
			   'post_type'     => 'page',
			   'post_title'    => $titulo,
			   'post_status'   => 'publish',
				 'comment_status'=> 'open'
			 );
			$post_id = wp_insert_post( $pagina );
			update_post_meta($post_id, '_wp_page_template', $template);
			echo 'página '.$titulo.' criada.<br>';
		} else {
			echo 'página '.$titulo.' já existe.<br>';
		}
	}
}
if (! function_exists('tc_criar_bd')) {
  function tc_criar_bd($table, $columns){
    global $wpdb;
    $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table) );
    if ( $wpdb->get_var( $query ) == $table ) {
      echo '<br>Tabela '.$table.' já existe!';
      return;
    } else {
      $resultado = $wpdb->query( "CREATE TABLE {$table} ({$columns});");
      if ( $wpdb->get_var( $query ) == $table ) {
        echo '<br>Tabela '.$table.' criada';
      } else {
        echo '<br>Foram encontrado erros ao criar a tabela';
      }
    }
  }
}


if (! function_exists('adc_ban2')) {
	function adc_ban2($id_nome){
		$picture = '';
		wp_enqueue_media(); ?>
		<input type="hidden" name="pct_<?php echo $id_nome ?>" value="<?php $picture ?>" id="upl_<?php echo $id_nome ?>">
		<script type="text/javascript">
			jQuery(document).ready(function($){
				var mediaUploader;
				if(mediaUploader){
					mediaUploader.open();
					return;
				}
				mediaUploader = wp.media.frames.file_frame = wp.media({
						title: 'Procamiao - escolher uma imagem',          // titulo que vai aparecer em cima no wp mediaUploader
						button: {
							text: 'Salvar'                    //texto que vai aparecer no botão que normalmente é salvar
						},
						multiple: false    // true or false to choose one or multiple images
				});
				mediaUploader.on('select',function(){
						attachment = mediaUploader.state().get('selection').first().toJSON();
						$('#upl_<?php echo $id_nome ?>').val(attachment.url);
				});
				mediaUploader.open();
			});
		</script> <?php
	}
}


if (! function_exists('adc_ban')) {
	function adc_ban($id_nome, $ins = 'inserir', $class = 'primary'){
		$picture = '';
		wp_enqueue_media(); ?>
		<form id="frm_<?php $id_nome ?>" method="post">
			<input type="button" value="<?php echo $ins ?>" id="btn_<?php echo $id_nome ?>" class="button-<?php echo $class ?>">
			<input type="hidden" name="pct_<?php echo $id_nome ?>" value="<?php $picture ?>" id="upl_<?php echo $id_nome ?>">
		</form>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				var mediaUploader;
				$('#btn_<?php echo $id_nome ?>').on('click',function(e){
					e.preventDefault();
					if(mediaUploader){ mediaUploader.open(); return; }
					mediaUploader = wp.media.frames.file_frame = wp.media({
						title: 'Procamiao - escolher uma imagem',          // titulo que vai aparecer em cima no wp mediaUploader
						button: { text: 'Salvar'},                    //texto que vai aparecer no botão que normalmente é salvar
						multiple: false    // true or false to choose one or multiple images
					});
					mediaUploader.on('select',function(){
						attachment = mediaUploader.state().get('selection').first().toJSON();
						$('#upl_<?php echo $id_nome ?>').val(attachment.url);
						document.getElementById("upl_<?php echo $id_nome ?>").submit();
					});
					mediaUploader.open();

				});
			});
		</script> <?php

	}
}




if (! function_exists('adc_banner')) {
	function adc_banner($id_nome){
	  if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['image_'.$id_nome] ) ) :
	    update_option( 'media_'.$id_nome, absint( $_POST['image_'.$id_nome] ) );
	  endif;
	  wp_enqueue_media(); ?>
	  <form method='post'>
	    <div class='image-preview-wrapper'>
	      <img id='image-<?php echo $id_nome ?>' src='<?php echo wp_get_attachment_url( get_option( 'media_'.$id_nome ) ); ?>' width="50%">
	    </div>
	    <input id="banner_<?php echo $id_nome ?>" type="button" class="button" value="<?php _e( 'alterar' ); ?>" />
	    <input type='hidden' name='image_<?php echo $id_nome ?>' id='image_<?php echo $id_nome ?>' value='<?php echo get_option( 'media_'.$id_nome ); ?>'>
	    <input type="submit" name="submit_image_selector" value="Salvar" class="button-primary">
	  </form> <?php
	  $my_saved_attachment_post_id = get_option( 'media_'.$id_nome, 0 );?>
	  <script type='text/javascript'>
	    jQuery( document ).ready( function( $ ) {
	      var file_frame;
	      var wp_media_<?php echo $id_nome ?>  = wp.media.model.settings.post.id;
	      var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>;
	      jQuery('#banner_<?php echo $id_nome ?>').on('click', function( event ){
	        event.preventDefault();
	        if ( file_frame ) {
	          file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
	          file_frame.open();
	          return;
	        } else {
	          wp.media.model.settings.post.id = set_to_post_id;
	        }
	        file_frame = wp.media.frames.file_frame = wp.media({
	          title: 'Select a image to upload',
	          button: { text: 'Use this image',},
	          multiple: false
	        });
	        file_frame.on( 'select', function() {
	          attachment = file_frame.state().get('selection').first().toJSON();
	          $( '#image-<?php echo $id_nome ?>' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
	          $( '#image_<?php echo $id_nome ?>' ).val( attachment.id );
	          wp.media.model.settings.post.id = wp_media_<?php echo $id_nome ?> ;
	        });
	        file_frame.open();
	      });
	      jQuery( 'a.add_media' ).on( 'click', function() {
	        wp.media.model.settings.post.id = wp_media_<?php echo $id_nome ?> ;
	      });
	    });
	  </script> <?php
	}
}
if (! function_exists('tc_rating')) {
	function tc_rating($media, $n_aval) {
		echo '<div><a href="<?php the_permalink(); ?>"><aval>'.$n_aval.' avaliações </aval>';
		if($media < 0.2){
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span></a></div>';
			return;
		}
		if($media >= 0.2 && $media < 0.8){
			echo '<span class="dashicons dashicons-star-half"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span></div>';
			return;
		}
		if($media >= 0.8 && $media < 1.3){
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span></div>';
			return;
		}
		if($media >= 1.3 && $media < 1.8){
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-half"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span></div>';
			return;
		}
		if($media >= 1.8 && $media < 2.3){
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span></div>';
			return;
		}
		if($media >= 2.3 && $media < 2.8){
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-half"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span></div>';
			return;
		}
		if($media >= 2.8 && $media < 3.3){
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span></div>';
			return;
		}
		if($media >= 3.3 && $media < 3.8){
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-half"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span></div>';
			return;
		}
		if($media >= 3.8 && $media < 4.3){
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-empty"></span></div>';
			return;
		}
		if($media >= 4.3 && $media < 4.8){
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-half"></span></div>';
			return;
		} else {
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span>';
			echo '<span class="dashicons dashicons-star-filled"></span></div>';
			return;
		}
	}
}
