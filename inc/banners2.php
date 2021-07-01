<?php
global $wpdb;
session_start();
defined('ABSPATH') or die('Este site apenas aceita acesso registado!');
?>
<h2 style="text-align:center;">Banners procamiao</h2>

<h3>testes</h3>

<?php $wpdb->query("update pro_slider set pos = 35 where id = 24;"); ?>
<a href="#" id="tiagos" class="misha-upl button-secondary" style="padding:0;">. Adicionar .</a>
<a href="#" class="misha-rmv button" style="background:darkred;color:#fff;"> x </a>
<input type="hidden" name="misha-img" value="" >


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
<div class="form">
      <center>
        <h3>Ajax Example</h3>
      </center>
      <input type="text" id="name" placeholder="Enter name" ><br>
      <input type="text" id="cont" placeholder="Enter_contact"><br>
      <input type="button" value="submit" onclick="send_Data()"><br>
      <span id="response"></span>
    </div>
<script type="text/javascript">
function send_Data(){
  var name = document.getElementById("name").value;
  var cont = document.getElementById("cont").value;

  var httpr = new XMLHttpRequest();
  httpr.open("POST","./get_data.php",true);
  httpr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  httpr.onreadystatechange=function(){
    if(httpr.readyState==4 && httpr.status==200){
      document.getElementById("response").innerHTML=httpr.responseText;
    }
  }
  httpr.send("name="+name+"&cont="+cont);
}

</script>
<?php print_r($_POST); ?>
