<?php
get_header();
if (have_posts()):
  while(have_posts()): the_post(); the_tags();?>
    <div class="corpo-index">
      <?php the_content(); ?>
    </div><?php
  endwhile;
endif;
get_footer();
