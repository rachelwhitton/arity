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

<div class="popupTime" data-time="<?= get_field('time')!=''?get_field('time'):'20'; ?>"></div>

<?php do_action('theme/before_content') ?>
<div id="main" class="site-content <?=$_ENV['PANTHEON_ENVIRONMENT']?>">

  <div class="blog-header">
    <h1><?php echo get_the_title(); ?> <div class="blog-brand">a blog by <span>Arity</span></div></h1>
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
  
  if ($url==''){
    $url = get_template_directory_uri().'/dist/patterns/2.3.0/images/img-blog-landing-L@2x.png';
  }
  
  echo '<div class="feature-card__bg-image" style="background: url('. $url.') no-repeat center center; background-size: cover;"></div>';
?>
</div>

<div class="container">
  <div class="row">

    <div class="feature-card__inner">
      <div class="blog-card__cat">
        <span><?php echo $category_name; ?></span>
      </div>
      <a class="blog-card__link" href="<?php echo get_permalink(); ?>">
        <?php the_title('<h2 class="feature-card__title">','</h2>'); ?>
      </a>
      <div class="blog-card__excerpt">
       <?php echo $abstract; ?>
      </div>
      <div class="blog-card__date">
        <?php echo get_the_date(); ?>
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
$promo_set = false;
if (get_field('module__promo_area')) {
  $promo_area = get_field('module__promo_area');
  $promo = array(
    'headline' => $promo_area[0]['promo__headline'],
    'location' => $promo_area[0]['promo__location'],
    'body_copy' => $promo_area[0]['promo__body_copy'],
    'cta' => $promo_area[0]['promo__cta']
  );
  $promo_set = true;

  add_action('pre_get_posts',function( $query ) {

    if (!is_admin()) {
      $ppp = get_option('posts_per_page');  // MAKE SURE TO SET THIS IN WP BACKEND TO 12
      $offset = -1;
      if (!$query->is_paged()) {
        $query->set('posts_per_page',$offset + $ppp);
      } else {
        $offset = $offset + ( ($query->query_vars['paged']-1) * $ppp );
        $query->set('posts_per_page',$ppp);
        $query->set('offset',$offset);
      }
    }
  });

  add_filter( 'found_posts', function( $found_posts, $query ) {
      if (!is_admin() ) {
        if (!$query->is_paged()) {
          $found_posts = $found_posts - 2;
        } else {
          $found_posts = $found_posts + 1;
        }
      }
      return $found_posts;
  }, 10, 2 );

}
?>

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

      if ($rowCount == 2 && $promo_set && $paged == 1) {
        echo '<div class="blog-card__col">';

        module('promo', $promo);

        echo '</div>';
      }

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
        <a href="/move/page/<?php echo $total; ?>"><?php echo $total; ?></a>
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
<?php require_once('blog-popup.php');?>