<?php

namespace App\Theme;
?>

<?php if (!empty($data['posts'])) : ?>
<div class="ar-module blog-promo">
  <div class="row">
      <?php foreach ($data['posts'] as $item) : ?>
        <div class="blog-card__col">
        	<a href="<?php echo get_permalink($item->ID); ?>">
	      		<div class="blog-card__image">
	            <?php if (get_the_post_thumbnail($item->ID )) : ?>
	                <?php
			            $url = wp_get_attachment_url( get_post_thumbnail_id($item->ID) );
			            echo '<div class="blog-card__bg-image" style="background: url('. $url.') no-repeat center center; background-size: cover;"></div>';
			          ?>
	            <?php else : ?>
	              <div class="blog-card__filler-img"></div>
	            <?php endif ?>
          		</div>
          	</a>
          <div class="blog-card__inner">
            <div class="blog-card__cat">
              <span><?php echo $item->primary_term ?></span>
            </div>
            <a class="blog-card__link" href="<?php echo get_permalink($item->ID); ?>">
           	 <div class="blog-card__title"><?php echo $item->post_title; ?></div>
           	</a>
            <div class="blog-card__excerpt">
             <?php echo $item->abstract ?>
            </div>
            <div class="blog-card__date">
              <?php echo get_the_date('F Y'); ?>
            </div>
            <div class="blog-card__read"><?= do_shortcode('[ttr id='.$item->ID.']'); ?></div>
          </div>
        </div>
      <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
