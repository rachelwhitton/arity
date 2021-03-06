<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      T12 Privacy Selector
  Template Type:      Page Template
  Description:
  Last Updated:       12/05/2018
  Since:              2.1.0
*/
?>

<?php get_header() ?>

<?php do_action('theme/before_content') ?>

<div id="main" class="site-content <?=$_ENV['PANTHEON_ENVIRONMENT']?>">
  <?php
    $hero['headline'] = get_the_title();
    module('hero-c', $hero);
    
    module('privacy-selector');

    the_acf_content();

    //for google and screen readers?
    if (has_nav_menu('privacy_selector')) {
      wp_nav_menu([
        'menu'            => 'hidden_menu',
        'theme_location'  => 'privacy_selector',
        'menu_class'      => 'sr-only visibility-hidden',
        'menu_role'       => ''
      ]);
    }
  ?>
</div>

<?php do_action('theme/after_content') ?>

<?php get_footer() ?>
