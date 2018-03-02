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
        <h4 class="blog-teaser__eyebrow"><?= $data['eyebrow']; ?></h4>
      <?php endif; ?>
      <?php if (!empty($data['headline'])) : ?>
        <h2 class="blog-teaser__header"><?= $data['headline']; ?></h2>
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
