<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      T9 Blog Article
  Template Type:      Page Template
  Description:
  Last Updated:       1/19/2018
  Since:              1.1.0
*/
//$related['posts'] = get_field('related_posts');
$category_name = yoast_get_primary_term('category', $post);
$abstract = get_field('abstract');
$author = [];
$blauthor = get_field('author_override');
if($blauthor){
  $blost = get_post($blauthor);
  $bloouthor = get_fields($blauthor);
  $author['author-name'] = $blost->post_title;
  $author['description'] = $bloouthor['author']['biography'];
  $author['twitter'] = $bloouthor['author']['twitter'];
  $author['display_image'] = $bloouthor['author']['image'];
}
?>

<?php get_header(); ?>

<?php do_action('theme/before_content') ?>
<div id="main" class="site-content">
  <div class="container">
    <div class="blog-post newco-insights-category-<?php echo strtolower($category_name) ?>">
      <?php /* Start the Loop */
        while ( have_posts() ) : the_post();

        if(empty($blauthor)){
          $author['author-name'] = get_the_author();
          $author['description'] = get_the_author_meta( 'user_description' );
          $author['twitter'] = get_the_author_meta('twitter');
          $author['display_image'] = get_avatar( get_the_author_meta( 'ID' ) , 245 );
        }
      ?>
      <div class="blog-post__content">
        <div class="blog-post__header">
          <div class="row">
            <div class="blog-post__image">
              <?php the_post_thumbnail(); ?>

              <div class="blog-post__bg"></div>
            </div>
          </div>
          <div class="row">
            <div class="blog-post__inner">
              <div class="blog-post__cat">
                <span><?php echo $category_name ?></span>
              </div>
              <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?><?php  ?>
              <div class="blog-post__stats"><?php echo $author['author-name']; echo ' &middot; '; echo get_the_date();?> &middot; <?= do_shortcode('[ttr]'); ?></em>
            </div>
          </div>
        </div>
        <div class="blog-post__col">
          <div class="row">
            <div class="blog-post__excerpt-col">
              <?php echo $abstract; ?>
            </div>
            <div class="blog-post__content-col">
              <?php the_content();?>
            </div>
          </div>
          <div class="row">
            <div class="blog-post__author-col">
              <?php module('blog-author', $author);?>
            </div>
          </div>
        </div>
      </div>
      <?php
      endwhile; // End of the loop.
      ?>
    </div>
  </div>

  <div class="blog-post__related-content">
    <h2 class="blog-post__related-content-header">You Might Also Like</h2>
    <?php
      $related['posts'] = get_field('related_posts');
      module('blog-promo', $related);
    ?>
  </div>

</div>
<?php do_action('theme/after_content') ?>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a6f42f0b4c9f84d"></script>
<?php get_footer(); ?>
