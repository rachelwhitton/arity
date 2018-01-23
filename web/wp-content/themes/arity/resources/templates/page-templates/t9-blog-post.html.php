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
?>

<?php get_header(); ?>

<?php do_action('theme/before_content') ?>
<div class="site-content">
  <div class="container">
    <div class="blog-post newco-insights-category-<?php echo strtolower($category_name) ?>">
      <?php /* Start the Loop */
        while ( have_posts() ) : the_post();
      ?>
      <div class="blog-post__content">
        <div class="row">
          <?php the_post_thumbnail(); ?>
          <div class="blog-post__header">
            <a href="/insights/category/<?php echo strtolower($category_name) ?>"><?php echo $category_name ?></a>
            <?php the_date('F Y', '<span class="date">', '</span>'); ?>
            10 min read
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
          </div>
        </div>
        <div class="blog-post__col">
          <div class="row">
            <div class="blog-post__excerpt-col">
              <?php the_excerpt();?>
            </div>
            <div class="blog-post__content-col">
              <?php the_content();?>
            </div>
          </div>
          <div class="row">
            <div class="blog-post__author-col">
              <?php
              echo "by "; the_author();

              $author = [];
              echo $author['description'] = get_the_author_meta( 'user_description' );
              echo $author['display_name'] = get_the_author_meta( 'display_name' );
              echo $author['display_image'] =  get_avatar( get_the_author_meta( 'ID' ) , 245 );
              ?>
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

<?php get_footer(); ?>
