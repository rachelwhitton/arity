<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      T20 Campaign Landing Template
  Template Type:      Page Template
  Description:
  Last Updated:       04/20/2018
  Since:              1.8.1
*/
?>

<?php get_header() ?>

<?php do_action('theme/before_content') ?>
<div id="main" class="site-content">
  <?php the_acf_content(); ?>
</div>
<?php do_action('theme/after_content') ?>

<?php get_footer() ?>
