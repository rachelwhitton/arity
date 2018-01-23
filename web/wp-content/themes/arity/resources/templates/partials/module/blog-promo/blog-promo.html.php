<?php

namespace App\Theme;
?>

<?php if (!empty($data['posts'])) : ?>
<div class="ar-module blog-promo">
  <div class="row">
      <?php foreach ($data['posts'] as $item) : ?>
        <div class="blog-promo__col">
          <?php echo get_the_post_thumbnail($item->ID); ?>
          <div class="blog-promo__content">
            <h4><?php echo $item->primary_term; ?></h4>
            <h2><?php echo $item->post_title; ?></h2>
            <?php echo $item->post_excerpt;?>
            <?php the_date('F Y', '<div class="date">', '</div>'); ?>
            <div class="">5 min read</div>
          </div>
    		</div>
      <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
