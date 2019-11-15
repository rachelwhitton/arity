<?php

namespace App\Theme;

// echo '<pre>';print_r($data);echo '</pre>';
?>
<div class="ar-module blog-teaser">
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

        <?php if (!empty($data['link'])) : ?>
          <span class="blog-teaser__link"><?=$data['content']?> <a class="blog-teaser__link" href="move"><?=$data['link']?></a></span>
        <?php endif; ?>

      </div>
    </div>

    <div class="row">
      <?php
        if (empty($data['industries'])) {
          $page = get_page_by_path("move");
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

            $data['featured'] = true;
            component('teaser-blog-card', $data);
          }
        } else {
          $args = array(
            'posts_per_page' => 3,
            'tax_query' => array(
              array(
                'taxonomy' => 'industry',
                'field' => 'term_id',
                'terms' => $data['industries'],
                'operator' => 'AND',
              ),
            ),
          );
        }
      ?>

      <?php
        $wp_query = new \WP_Query( $args );
      ?>

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
