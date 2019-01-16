<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      T3 Product Detail
  Template Type:      Page Template
  Description:
  Last Updated:       08/15/2017
  Since:              1.0.0
*/

$hero = get_field('module__hero-b-two-column');
?>

<?php get_header(); ?>

<?php do_action('theme/before_content') ?>
<div id="main" class="site-content <?=$_ENV['PANTHEON_ENVIRONMENT']?>">
  <?php module('hero-b', $hero); ?>
  <?php the_acf_content(); ?>
</div>
<?php do_action('theme/after_content') ?>

<?php get_footer(); ?>
