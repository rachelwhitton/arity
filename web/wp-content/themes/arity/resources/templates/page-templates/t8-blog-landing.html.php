<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      T8 Blog Landing
  Template Type:      Page Template
  Description:
  Last Updated:       1/22/2018
  Since:              1.1.0
*/
?>

<?php get_header(); ?>

<?php do_action('theme/before_content') ?>
<div class="site-content">

  <div class="blog-header">
    <h1>Title of the blog</h1>
    <div class="blog-brand">a blog by <span>Arity</span></div>
  </div>

<?php

  $featured = get_field('featured_blog_post');
  $post = $featured;
  setup_postdata( $post ); 

  $category_name = yoast_get_primary_term('category', $post);
?>

<div class="feature-card__image">
<?php
  $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
  echo '<div class="feature-card__bg-image" style="background: url('. $url.') no-repeat center center; background-size: cover;"></div>';
?>
</div>

<div class="container">
  <div class="row">
    <div class="col-8">
      <div class="feature-card__inner">
        <div class="blog-card__cat">
          <a href="/insights/category/<?php echo strtolower($category_name) ?>"><?php echo $category_name ?></a>
        </div>
        <a href="<?php echo get_permalink(); ?>">
          <?php the_title('<h1 class="feature-card__title">','</h1>'); ?>
        </a>
        <div class="blog-card__excerpt">
         <?php the_excerpt(); ?>
        </div>
        <div class="blog-card__date">
          <?php the_date('F d, Y'); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  $feature_id[] = get_the_id();


wp_reset_postdata();

?>

<div class="container">



<?php

global $post;
$args = array( 
  'posts_per_page' => 12,
  'exclude' => $feature_id
);
$postlist = get_posts( $args ); 

?>

  <div class="row">

    <?php
    /* Start the Loop */
    $rowCount = 0;
    foreach ( $postlist as $post ) :
      setup_postdata( $post );

      $category_name = yoast_get_primary_term('category', $post);

    ?>

    <div class="blog-card__col col-4">
      <a href="<?php echo get_permalink(); ?>">
        <div class="blog-card__image">
          <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail( 'post-thumbnail' ); ?>
          <?php else : ?>
            <div class="blog-card__filler-img"></div>
          <?php endif ?>
        </div>
      </a>
      <div class="blog-card__inner">
        <div class="blog-card__cat">
          <a href="/insights/category/<?php echo strtolower($category_name) ?>"><?php echo $category_name ?></a>
        </div>
        <a href="<?php echo get_permalink(); ?>">
          <?php the_title( '<h1 class="blog-card__title">', '</h1>' ); ?>
        </a>
        <div class="blog-card__excerpt">
         <?php the_excerpt(); ?>
        </div>
        <div class="blog-card__date">
          <?php the_date('F d, Y', '<div class="date">', '</div>'); ?>
        </div>
      </div>
    </div>

    <?php
      $rowCount++;
      if ($rowCount % 3 == 0 && $rowCount != count($postlist) ) echo '</div><div class="row">';

      endforeach; // End of the loop.
    ?>
  
  </div><!-- /row -->

</div> <!-- /container -->
</div> <!-- /site-content -->
<?php do_action('theme/after_content') ?>

<?php get_footer(); ?>
