<?php

namespace App\Theme;
?>

<?php
$args = array(
  'posts_per_page' => 3
);

$wp_query = new \WP_Query( $args );
?>
<div class="module blog-teaser">
<div class="container">
  <div class="row">
    <div class="blog-teaser__intro">
      <?php if (!empty($data['eyebrow'])) : ?>
        <?php element('eyebrow', array(
          'classes' => 'eyebrow',
          'label' => $data['eyebrow']
        )); ?>
      <?php endif; ?>
      <?php if (!empty($data['headline'])) : ?>
        <?php element('headline', array(
              'classes' => 'blog-teaser__title',
              'headline' => $data['headline']
            )); ?>
      <?php endif; ?>
    </div>
  </div>
  <div class="row">
    <?php if ( $wp_query->have_posts() ) : ?>

    <?php
    while ( $wp_query->have_posts() ) :
      $wp_query->the_post();
    ?>

    <?php component('teaser-blog-card'); ?>

    <?php
      endwhile; // End of the loop.
    ?>

    <?php endif; ?>

  </div><!-- /row -->
</div>
</div>
