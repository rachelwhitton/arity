<?php
namespace App\Theme;
use function App\Theme\template;
?>
<?php
/*
  Template Name:      T1 Homepage
  Template Type:      Page Template
  Description:
  Last Updated:       03/01/2018
  Since:              1.0.0
*/
?>

<?php get_header() ?>

<?php do_action('theme/before_content') ?>
<div class="site-content">
  <?php the_acf_content(); ?>
</div>
<?php do_action('theme/after_content') ?>

<?php get_footer() ?>
