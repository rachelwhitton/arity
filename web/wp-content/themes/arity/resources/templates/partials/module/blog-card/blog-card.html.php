<?php

namespace App\Theme;

$category_name = yoast_get_primary_term('category', $post);
?>

<div class="blog-card__col">
  <a href="<?php echo get_permalink(); ?>">
    <div class="blog-card__image">
      <?php if (has_post_thumbnail()) : ?>
          <?php
            $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
            echo '<div class="blog-card__bg-image" style="background: url('. $url.') no-repeat center center; background-size: cover;"></div>';
          ?>
      <?php else : ?>
        <div class="blog-card__filler-img"></div>
      <?php endif ?>
    </div>
  </a>
  <div class="blog-card__inner">
    <div class="blog-card__cat">
      <span><?php echo $category_name; ?></span>
    </div>
    <a class="blog-card__link" href="<?php echo get_permalink(); ?>">
      <?php the_title( '<h2 class="blog-card__title">', '</h2>' ); ?>
    </a>
    <div class="blog-card__excerpt">
     <?php // the_excerpt(); ?>
     <?php

        $abstract = get_field('abstract');
        echo $abstract;
        ?>
    </div>
    <div class="blog-card__stats">
      <div class="blog-card__date">
        <?php echo get_the_date(); ?>
      </div>
      <div class="blog-card__read"><?= do_shortcode('[ttr]'); ?></div>
    </div>
  </div>
</div>
