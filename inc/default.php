<?php
defined('ABSPATH') or die('A procamião apenas aceita acesso registado!');
global $wpdb;?>
<h3 class="middle">Procamiao criação das páginas default do tema</h3>
<p>Ao clicar no botão seguinte o tema vai instalar o seu default.
<form method="post">
  <input type="submit" name="pag_default" value="tema default"/>
</form></p> <?php
if(isset($_POST['pag_default'])){
  criar_pag('Validar email','templates/validar-email.php');
  criar_pag('Promoções','templates/promos.php');
  criar_pag('Novidades','templates/novidades.php');
  criar_pag('Login','templates/login.php');
  criar_pag('Registar','templates/registar.php');
  criar_pag('Top vendas','templates/topvendas.php');
  $menu_exists = wp_get_nav_menu_object('menuProcamiao');
  if( !$menu_exists){
    $menu_id = wp_create_nav_menu('menuProcamiao');
    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' => 'Top vendas',
      'menu-item-classes' => 'top-vendas',
      'menu-item-url' => home_url( '/top-vendas' ),
      'menu-item-status' => 'publish'));
    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' => 'Promoções',
      'menu-item-classes' => 'promocoes',
      'menu-item-url' => home_url( '/promocoes' ),
      'menu-item-status' => 'publish'));
    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' => 'Novidades',
      'menu-item-classes' => 'novidades',
      'menu-item-url' => home_url( '/novidades' ),
      'menu-item-status' => 'publish'));
    $locations = get_theme_mod('nav_menu_locations');
    $locations['Procamiao'] = $menu_id;
    set_theme_mod( 'nav_menu_locations', $locations );
    echo '<p>menu criado com sucesso</p>';
  } else {
    echo '<p>menu menuProcamiao já existe.</p>';
  }
}
?>
<h3 class="middle">Procamiao tabelas mysql customizadas</h3>
<form class="" method="post">
  <label for="tc_email">verificação de email</label>
  <select name="tc_email" id="tc_ec" class="tc_postbox">
    <option value="consultar">consultar</option>
    <option value="criar">criar </option>
    <option value="apagar">Apagar todos os dados</option>
  </select>
  <input type="submit" value="executar"/>
</form>
<form class="" method="post">
  <label for="pro_slider">Slider inicial</label>
  <select name="pro_slider" class="tc_postbox">
    <option value="consultar">consultar</option>
    <option value="criar">criar </option>
  </select>
  <input type="submit" value="executar"/>
</form>
<form class="" method="post">
  <label for="pro_banners">Tabela dos banners</label>
  <select name="pro_banners" class="tc_postbox">
    <option value="consultar">consultar</option>
    <option value="criar">criar </option>
  </select>
  <input type="submit" value="executar"/>
</form>
<?php
if(isset($_POST['tc_email'])){
  $option = isset($_POST['tc_email']) ? $_POST['tc_email'] : false;
  if ($option) {
     $escolhido = htmlentities($_POST['tc_email'], ENT_QUOTES, "UTF-8");
     if ($escolhido == 'consultar'){
       echo '<br><br><b>Tabela pro_ver_email</b>';
       $dados = $wpdb->get_results('SELECT * FROM pro_ver_email');
       echo '<pre>';
       print_r($dados);
     }
     if ($escolhido == 'criar'){
       tc_criar_bd('pro_ver_email', 'user_login varchar(100),user_pass varchar(100), user_email varchar(100), user_activation_key varchar(100), user_display_name varchar(100)');
     }
     if ($escolhido == 'apagar'){
       tc_apagar_dt('pro_ver_email');
     }
  } else {
    exit;
  }
}
if(isset($_POST['pro_slider'])){
  $opt = isset($_POST['pro_slider']) ? $_POST['pro_slider'] : false;
  if ($opt) {
     $escolhido = htmlentities($_POST['pro_slider'], ENT_QUOTES, "UTF-8");
     if ($escolhido == 'consultar'){
       echo '<br><br><b>tabela pro_slider</b>';
       $dados = $wpdb->get_results('SELECT * FROM pro_slider');
       echo '<pre>';
       print_r($dados);
     }
     if ($escolhido == 'criar'){
       tc_criar_bd('pro_slider', 'id int auto_increment primary key, pos tinyint, link varchar(255)');
     }
  } else {
    exit;
  }
}
if(isset($_POST['pro_banners'])){
  $opt = isset($_POST['pro_banners']) ? $_POST['pro_banners'] : false;
  if ($opt) {
     $escolhido = htmlentities($_POST['pro_banners'], ENT_QUOTES, "UTF-8");
     if ($escolhido == 'consultar'){
       echo '<br><br><b>tabela pro_banners</b>';
       $dados = $wpdb->get_results('SELECT * FROM pro_banners');
       echo '<pre>';
       print_r($dados);
     }
     if ($escolhido == 'criar'){
       tc_criar_bd('pro_banners', 'name varchar(40), link varchar(255)');
     }
  } else {
    exit;
  }
}
