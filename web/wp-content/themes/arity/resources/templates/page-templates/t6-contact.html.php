<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      T6 Contact
  Template Type:      Page Template
  Description:
  Last Updated:       11/14/2017
  Since:              1.1.0
*/
$hero = get_field('module__hero-d');
?>

<?php get_header(); ?>

<?php do_action('theme/before_content') ?>
<div id="main" class="site-content">
  <?php module('hero-d', $hero); ?>
  <?php the_acf_content(); ?>
</div>
<?php do_action('theme/after_content') ?>

<?php get_footer(); ?>
