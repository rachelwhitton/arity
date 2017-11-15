<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      T2a Applications Overview
  Template Type:      Page Template
  Description:
  Last Updated:       08/15/2017
  Since:              1.0.0
*/

$hero = get_field('module__hero-a');
?>

<?php get_header(); ?>

<?php do_action('theme/before_content') ?>
<div class="site-content">
  <?php module('hero-a', $hero); ?>
  <?php the_acf_content(); ?>
</div>
<?php do_action('theme/after_content') ?>

<?php get_footer(); ?>
