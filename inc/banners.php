<?php
global $wpdb;
session_start();
defined('ABSPATH') or die('Este site apenas aceita acesso registado!');
?>
<h2 style="text-align:center;">Banners procamiao</h2>

<h3>testes</h3>
<div class="form-group">
  <input type="text" name="post_title" id="post_title" class="form-control">
</div>
<div class="form-group">
  <input type="hidden" name="post_id" id="post_id">
  <div id="autosave"></div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
  function autosave(){
    var post_title = $('#post_title').val();
    var post_id = $('#post_id').val();
    if(post_title != ''){
      $.ajax({
          url:"tiagos.php",
          method:"POST",
          data:{postTitle:post_title, postId:post_id},
          dataType:"text",
          success:function(data){
            if(data != ''){
              $('#post_id').val(data);
            }
            $('#autosave').text("Post save as draft");
            setInterval(function(){
              $('#autosave').text('');
            },2000);
          }
      });
    }
  }
  setInterval(function(){
    autosave();
  },4000);
</script>


<a href="#" id="tiagos" class="misha-upl button-secondary" style="padding:0;" value="hi">. Adicionar .</a>
<a href="#" class="misha-rmv button" style="background:darkred;color:#fff;"> x </a>
<input type="hidden" name="misha-img" value="">


 <script type="text/javascript">
 jQuery(function($){
   $('body').on( 'click', '.misha-upl', function(e){
     e.preventDefault();
     var button = $(this),
     custom_uploader = wp.media({
       title: 'Procamiao - escolher um banner',
       library : { type : 'image'},
       button: { text: 'Inserir a imagem' },
       multiple: false
     }).on('select', function() { // it also has "open" and "close" events
       var attachment = custom_uploader.state().get('selection').first().toJSON();
       $('.misha-upl').html('<img src="' + attachment.url + '" style="max-width:600px;margin:-2px -36px -13px -2px;">').next().val(attachment.id).next().show();
     }).open();
   });

   $('body').on('click', '.misha-rmv', function(e){
     e.preventDefault();
     var button = $(this);
     button.next().val(''); // emptying the hidden field
     button.hide().prev().html('. Adicionar .');
   });
 });
 </script>
<?php print_r($_SESSION); ?>


<h3>Cabeçalho</h3> <?php
  adc_banner('cabecalho'); ?>
<h3>Página inicial</h3>
<h4>Slider (1256x360)</h4>
<div class="pro_sli"> <?php
  if (isset($_GET['adc'])){
    $a = $wpdb->get_results("select * from pro_slider order by pos", OBJECT);
    $d = count($a) + 1;
    $wpdb->insert('pro_slider', array(
      'id' => 'default',
      'pos' => $d,
      'link' => 'http://localhost/pro/wp-content/uploads/2021/06/11.jpg'));
    }
  if (isset($_GET['rmv'])){
    $e = $_GET['rmv'];
    $wpdb->query( "delete from pro_slider where id = {$e};");
    $d = 1;
    $a = $wpdb->get_results("select * from pro_slider order by pos", OBJECT);
    foreach($a as $f){
      $wpdb->query( "update pro_slider set pos = {$d} where id = {$f->id};");
      $d+=1;
    }
  }
  if (isset($_GET['alt'])){
    $a = 'Slider'.$_GET['alt'];
  }
  $a = $wpdb->get_results("select * from pro_slider order by pos", OBJECT);
  foreach($a as $b){ ?>
    <div class="pro_img_prev">
      <p><b>Slider <?php echo $b->pos ?></b></p>
      <img id='image-<?php echo $b->pos?>' src='<?php echo $b->link ?>' width=98%>
      <a href="admin.php?page=editor_tiagos&rmv=<?php echo $b->id ?>" class="button" style="margin-right:2%;background:darkred;color:#fff;">Remover</a>
      <!--<a href="admin.php?page=editor_tiagos&alt=<?php echo $b->id ?>" class="button-secondary" style="margin-right:1%;">Alterar</a> -->
      <?php
       adc_ban($b->id, 'alterar', 'secondary alignright'); ?>
    </div><?php
  } ?>
</div>
<p><a href="admin.php?page=editor_tiagos&adc"class="button-primary" style="margin:15px;">Adicionar &#x2B;</a></p>
<h4>banner central (1256x250)</h4> <?php
  adc_banner('banner_central'); ?>
<h4>banner esquerdo (500x250)</h4> <?php
  adc_banner('ini_esq'); ?>
<h4>banner direito (500x250)</h4> <?php
  adc_banner('ini_dir'); ?>
<h4>Página top vendas (1256x160)</h4> <?php
  adc_banner('top_vendas'); ?>
<h4>Página Promoções (1256x160)</h4> <?php
  adc_banner('promo'); ?>
<h4>Página Novidades (1256x160)</h4> <?php
  adc_banner('novidades');
?>
<style media="screen">
  body{background:#1B2332;}
  h4,h3,p{color:#fff;}
  h2{color:#EF7522;}
  .pro_sli{display:flex;flex-wrap:wrap;}
  .pro_sli .pro_img_prev{flex:0 0 50%;margin-top:20px;}
  .pro_sli .pro_img_prev a{float:right;}
</style>
