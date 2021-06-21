<?php global $wpdb;
$a = $wpdb->get_results("select * from pro_slider order by pos", OBJECT);
$b = 0; ?>
<div id="hom_sld">
  <div id="sld"> <?php
    foreach ($a as $k => $c):
      $b++; ?>
      <div><img src="<?php echo $c->link ?>"></div>
      <?php
    endforeach; ?>
  </div>
  <div id="sld_spn"> <?php
    for($d = 0; $d < $b; $d++){
      if ($d == 0) { echo '<span class="selected"></span>';}
      else {echo '<span></span>';}
    } ?>
  </div>
</div>

<script type="text/javascript">
var nsld = <?php echo $b; ?>;
const slider = document.querySelector('#sld');
const parent = document.querySelector('#sld_spn');
var index = 0;
var dir = 1;

function setIndex(){
  document.querySelector('#sld_spn .selected').classList.remove('selected');
  slider.style.transform = 'translate(calc(100% * -' + (index) +'))';
}
document.querySelectorAll('#sld_spn span').forEach(function(indicator, ind){
  indicator.addEventListener('click', function(){
    index = ind;
    setIndex();
    indicator.classList.add('selected');
  });
});
setInterval(function(){
  if (dir){
    index++;
    if (index >= nsld - 1){
      dir = 0;
      index = nsld - 1;
    }
  } else {
    index--;
    if (index <= 0){
      dir = 1;
      index = 0;
    }
  }
  setIndex();
  parent.children[index].classList.add('selected');
},14000);
</script>
