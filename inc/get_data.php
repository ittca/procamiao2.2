<?php
define('SHORTINIT', true);
require_once( '/media/Home/Servidor/pro/wp-load.php'); // TODO: este caminho não é dinamico
if (isset($_POST)){
  if(isset($_POST['bn'])){
    $bn = $_POST['bn'];
    if($bn = 'ad'){
      $name = $_POST['name'];
      $link = $_POST['link'] ? $_POST['link'] : '#' ;
      $img = $_POST['img'];
      $wpdb->query("update pro_banners set link= '$link', img = '$img' where name = '$name';");
    }
    if($bn = 'rm'){
      $name = $_POST['name'];
      $wpdb->query("update pro_banners set link= '', img = '' where name = '$name';");
    }
    if($bn = 'sldal'){
      $id = $_POST['id'];
      $link = $_POST['link'] ? $_POST['link'] : '#' ;
      $img = $_POST['img'];
      $wpdb->query("update pro_slider set img = '$img', link= '$link' where id = '$id';");
    }
    if($bn = 'sldrm'){
      $id = $_POST['id'];
      $wpdb->query( "delete from pro_slider where id = {$id};");
      $d = 1;
      $a = $wpdb->get_results("select * from pro_slider order by pos", OBJECT);
      foreach($a as $f){
        $wpdb->query( "update pro_slider set pos = {$d} where id = {$f->id};");
        $d+=1;
      }
    }
  }
}
