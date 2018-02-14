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
    <h1><?php echo get_the_title(); ?></h1>
    <div class="blog-brand">a blog by <span>Arity</span></div>
  </div>

<?php

  $featured = get_field('featured_blog_post');
  $post = $featured;
  setup_postdata( $post );

  $category_name = yoast_get_primary_term('category', $post);
  $abstract = get_field('abstract');
?>

<?php 
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

  if ( $paged == 1) :
?>

<div class="feature-card__image">
<?php
  $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
  echo '<div class="feature-card__bg-image" style="background: url('. $url.') no-repeat center center; background-size: cover;"></div>';
?>
</div>

<div class="container">
  <div class="row">

    <div class="feature-card__inner">
      <div class="blog-card__cat">
        <a href="/insights/category/<?php echo strtolower($category_name) ?>"><?php echo $category_name ?></a>
      </div>
      <a class="blog-card__link" href="<?php echo get_permalink(); ?>">
        <?php the_title('<h1 class="feature-card__title">','</h1>'); ?>
      </a>
      <div class="blog-card__excerpt">
       <?php echo $abstract; ?>
      </div>
      <div class="blog-card__date">
        <?php the_date('F d, Y'); ?>
      </div>
      <div class="blog-card__read"><?= do_shortcode('[ttr]'); ?></div>
    </div>

  </div>
</div>

<?php endif; ?>

<?php
  $feature_id = get_the_id();


wp_reset_postdata();

?>

<div class="container">

<?php

global $wp_query, $paged;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


global $post;
$args = array(
  'posts_per_page' => 12,
  'paged' => $paged,
  'post__not_in' => array($feature_id)
);

$wp_query = new \WP_Query( $args );
//$posts = $query->posts; 

?>

  <div class="row">
    <?php if ( $wp_query->have_posts() ) : ?>

    <?php
    /* Start the Loop */
    $rowCount = 0;
    while ( $wp_query->have_posts() ) :
      $wp_query->the_post();

    ?>

    <?php module('blog-card'); ?>

    <?php
      $rowCount++;
      //if ($rowCount % 3 == 0 && $rowCount != count($postlist) ) echo '</div><div class="row">';

      endwhile; // End of the loop.
    ?>

  </div><!-- /row -->

  <?php
    // start pagination 
    $total = $wp_query->max_num_pages;
    if ( $total > 1 ) {
      // get the current page
      if ( !$current_page = get_query_var('paged') ){
        $current_page = 1;
      }  

      $links = paginate_links(array(
        'type' => 'array'
      ));
  ?>
  <div class="blog-pagination">
    <div class="blog-pagination__inner">
      <?php if( get_previous_posts_link() ) : ?>
        <div class="blog-pagination__arrow-link prev-link">
          <?php previous_posts_link( '<svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#caret"></use></svg>' ); ?>
        </div>
      <?php else : ?>
        <div class="blog-pagination__arrow-link prev-link no-posts">
          <div class="rotate">
            <svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#caret"></use></svg>
          </div>
        </div>
      <?php endif; ?>

      <div class="blog-pagination__page-selector">
        Page 
        <select id="blog-pagination">
            <?php

            foreach ( $links as $pgl ) {
                //Skip Prev and Next.
                if(strpos($pgl, 'class="prev') || strpos($pgl, 'class="next')){
                    continue;
                }
                $option = str_replace('<a','<option',$pgl);
                $option = str_replace('<span','<option id="current" selected ',$option);
                $option = str_replace('a>','option>',$option);
                $option = str_replace('span>','option>',$option);
                $option = str_replace('href','value',$option);
                $option = str_replace('current"','" id="current" selected',$option);

                echo $option;
            }
            ?>
        </select>
        of 
        <a href="/blog/page/<?php echo $total; ?>"><?php echo $total; ?></a>
      </div>

      <?php if( get_next_posts_link() ) : ?>
        <div class="blog-pagination__arrow-link next-link">
          <?php next_posts_link( '<svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#caret"></use></svg>' ); ?>
        </div>
      <?php else : ?>
        <div class="blog-pagination__arrow-link next-link no-posts">
          <svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#caret"></use></svg>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <?php
    } 
    // end pagination
  ?>

  <?php endif; ?>

</div> <!-- /container -->
</div> <!-- /site-content -->
<?php do_action('theme/after_content') ?>

<?php get_footer(); ?>
