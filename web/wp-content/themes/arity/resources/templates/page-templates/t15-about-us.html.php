<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      T15 About Us
  Template Type:      Page Template
  Description:
  Last Updated:       05/21/2019
  Since:              2.3.0
*/
?>

<?php get_header() ?>
<?php do_action('theme/before_content') ?>
<div id="main" class="site-content <?=$_ENV['PANTHEON_ENVIRONMENT']?>">

	<?php the_acf_content(); ?>

</div>
<?php do_action('theme/after_content') ?>
<?php get_footer() ?>
