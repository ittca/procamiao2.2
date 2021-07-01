<?php
if (! function_exists('pro_banner')) {
	function pro_banner($bnr){
	  global $wpdb;
	  $data = $wpdb->get_results("select link, img from pro_banners where name = '$bnr';", OBJECT);
	  $imgs = $data['0']->img = '' ? false : $data['0']->img;
    $link = $data['0']->link;
	  if($imgs != ''){ ?>
	    <a href="#" class="<?php echo $bnr ?>-upl button-secondary" style="padding:0;">
	      <img src="<?php echo $imgs ?>" style="max-width:600px;margin:-2px -36px -13px -2px;">
      </a>
	    <a href="#" id="<?php echo $bnr ?>-rmv" class="<?php echo $bnr ?>-rmv button" style="background:darkred;color:#fff;"> x </a> <br><br>
        <input type="text" name="<?php echo $bnr ?>-enc" id="<?php echo $bnr ?>-link"style="width:600px;" value="<?php echo $link ?>"> <?php
	  } else { ?>
	    <a href="#" class="<?php echo $bnr ?>-upl button-secondary" style="padding:0;">. Adicionar .</a>
	    <a href="#" id="<?php echo $bnr ?>-rmv" class="<?php echo $bnr ?>-rmv button" style="background:darkred;color:#fff;visibility: hidden;"> x </a> <br><br>
        <input type="text" name="<?php echo $bnr ?>-enc" id="<?php echo $bnr ?>-link"style="width:600px;visibility:hidden;" value="<?php echo $link ?>"> <?php
	  } ?>
	   <script type="text/javascript">
	   jQuery(function($){
	     $('body').on( 'click', '.<?php echo $bnr ?>-upl', function(e){
	       e.preventDefault();
	       var button = $(this),
	       custom_uploader = wp.media({
	         title: 'Procamiao - escolher um banner',
	         library : { type : 'image'},
	         button: { text: 'Inserir a imagem' },
	         multiple: false
	       }).on('select', function() {
	         var attachment = custom_uploader.state().get('selection').first().toJSON();
           var link = document.getElementById("<?php echo $bnr ?>-link").value;
	         $('.<?php echo $bnr ?>-upl').html('<img src="' + attachment.url + '" style="max-width:600px;margin:-2px -36px -13px -2px;">').next().val(attachment.id).next().show();
	         var httpr = new XMLHttpRequest();
	         httpr.open("POST","../wp-content/themes/procamiao/inc/get_data.php",true);
	         httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	         httpr.send("bn=ad&name=<?php echo $bnr ?>&img="+attachment.url+"&link="+link);
	         document.getElementById("<?php echo $bnr ?>-rmv").style.visibility = 'visible';
           document.getElementById("<?php echo $bnr ?>-link").style.visibility = 'visible';
	       }).open();
	     });
	     $('body').on('click', '.<?php echo $bnr ?>-rmv', function(e){
	       e.preventDefault();
	       var button = $(this);
	       button.prev().html('. Adicionar .');
	       var httpr = new XMLHttpRequest();
	       httpr.open("POST","../wp-content/themes/procamiao/inc/get_data.php",true);
	       httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	       httpr.send("bn=rm&name=<?php echo $bnr ?>");
	       document.getElementById("<?php echo $bnr ?>-rmv").style.visibility = 'hidden';
         document.getElementById("<?php echo $bnr ?>-link").style.visibility = 'hidden';
	     });
	   });
	   </script>   <?php
	}
}


if (! function_exists('pro_bnr_slider')) {
	function pro_bnr_slider($id, $pos, $img, $link){
	  if($id){ ?>
      <div class="pro_img_prev">
        <p><b>Slider <?php echo $pos ?></b></p>
	      <a href="#" class="upl<?php echo $pos ?> button-secondary" style="padding:0;">
	         <img src="<?php echo $img ?>" style="max-width:600px;margin:-2px -36px -13px -2px;">
        </a>
	      <a href="#" id="rmv<?php echo $pos ?>" class="rmv<?php echo $pos ?> button" style="background:darkred;color:#fff;"> x </a> <br><br>
        <input type="text" name="enc<?php echo $pos ?>" id="link<?php echo $pos ?>"style="width:600px;" value="<?php echo $link ?>">
      </div> <?php
	  } else { ?>
      <div class="pro_img_prev">
	      <a href="#" class="upl<?php echo $pos ?> button-secondary" style="padding:0;">
	         <img src="#" style="max-width:600px;margin:-2px -36px -13px -2px;">. Adicionar .
        </a>
	      <a href="#" id="rmv<?php echo $pos ?>" class="rmv<?php echo $pos ?> button" style="background:darkred;color:#fff;visibility:hidden;"> x </a> <br><br>
        <input type="text" name="enc<?php echo $pos ?>" id="link<?php echo $pos ?>"style="width:600px;visibility:hidden;" value="<?php echo $link ?>">
      </div> <?php
    }?>
	   <script type="text/javascript">
	   jQuery(function($){
	     $('body').on( 'click', '.upl<?php echo $pos ?>', function(e){
	       e.preventDefault();
	       var button = $(this),
	       custom_uploader = wp.media({
	         title: 'Procamiao - escolher um banner',
	         library : { type : 'image'},
	         button: { text: 'Inserir a imagem' },
	         multiple: false
	       }).on('select', function() {
	         var attachment = custom_uploader.state().get('selection').first().toJSON();
           var link = document.getElementById("link<?php echo $pos ?>").value;
	         $('.upl<?php echo $pos ?>').html('<img src="' + attachment.url + '" style="max-width:600px;margin:-2px -36px -13px -2px;">').next().val(attachment.id).next().show();
	         var httpr = new XMLHttpRequest();
	         httpr.open("POST","../wp-content/themes/procamiao/inc/get_data.php",true);
	         httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	         httpr.send("bn=sldal&id=<?php echo $id ?>&img="+attachment.url+"&link="+link);
	         document.getElementById("rmv<?php echo $pos ?>").style.visibility = 'visible';
           document.getElementById("link<?php echo $pos ?>").style.visibility = 'visible';
	       }).open();
	     });
	     $('body').on('click', '.rmv<?php echo $pos ?>', function(e){
	       e.preventDefault();
	       var button = $(this);
	       button.prev().html('. Adicionar .');
	       var httpr = new XMLHttpRequest();
	       httpr.open("POST","../wp-content/themes/procamiao/inc/get_data.php",true);
	       httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	       httpr.send("bn=sldrm&id=<?php echo $id ?>");
	       document.getElementById("rmv<?php echo $pos ?>").style.visibility = 'hidden';
         document.getElementById("link<?php echo $pos ?>").style.visibility = 'hidden';
	     });
	   });
	   </script>   <?php
	}
}





global $wpdb; ?>
<h2 style="text-align:center;">Banners procamiao</h2>

<h3>Cabeçalho</h3>
<?php
pro_banner('bnHeader');
?>

<h3>Página inicial</h3>
<h4>Slider (1256x360)</h4>
<div class="pro_sli"> <?php
  $a = $wpdb->get_results("select * from pro_slider order by pos", OBJECT);
  foreach($a as $b){
    pro_bnr_slider($b->id, $b->pos, $b->img, $b->link);
  }
  pro_bnr_slider('','','','');
  ?>
</div>

<h4>banner central (1256x250)</h4> <?php
pro_banner('bnFp1'); ?>
<h4>banner esquerdo (500x250)</h4> <?php
pro_banner('bnFp2'); ?>
<h4>banner direito (500x250)</h4> <?php
pro_banner('bnFp3'); ?>
<h3>Página top vendas (1256x160)</h3> <?php
pro_banner('top_vendas'); ?>
<h3>Página Promoções (1256x160)</h3> <?php
pro_banner('promo'); ?>
<h3>Página Novidades (1256x160)</h3> <?php
pro_banner('novidades');
?>



<style media="screen">
  body{background:#1B2332;}
  h4,p{color:#fff;}
  h3{color:orange;}
  h2{color:#EF7522;}
  .pro_sli{display:flex;flex-wrap:wrap;}
  .pro_sli .pro_img_prev{flex:0 0 50%;margin-top:20px;}
</style>
