<?php

namespace App\Theme;
?>
<div class="module blog-teaser">
<div class="container">
  <div class="row">
    <div class="blog-teaser__intro anim-ready">
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


  <?php
    $page = get_page_by_path("blog");
    $feature_id = 0;
    $args = array(
      'posts_per_page' => 3
    );
    if ($page) {
        $test = get_field('featured_blog_post', $page->ID);//747);
        $feature_id = $test->ID;
        $post = $test;
        setup_postdata( $post );

        $args = array(
          'posts_per_page' => 2,
          'post__not_in' => array($feature_id)
        );

        echo '<div class="row">';
        component('teaser-blog-card');
        echo '</div><!-- /row -->';
    }
  ?>

  <?php
    $wp_query = new \WP_Query( $args );
  ?>

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
