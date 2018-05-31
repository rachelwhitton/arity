<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      T11 Homepage
  Template Type:      Page Template
  Description:
  Last Updated:       03/01/2018
  Since:              1.0.0
*/
?>

<?php get_header() ?>

<?php do_action('theme/before_content') ?>

<div id="main" class="site-content">
  <?php
    // $leadership = get_field('module__leadership');
    // module('leadership', $leadership);
    $hero = get_field('module__hero-c');
    module('hero-c', $hero);

    if (has_nav_menu('privacy_selector')) {
      wp_nav_menu([
        'menu'            => 'nav_menu',
        'theme_location'  => 'privacy_selector',
        'menu_class'      => '',
        'menu_role'       => ''
      ]);
    }

    the_acf_content();
  ?>
</div>

<?php do_action('theme/after_content') ?>

<?php get_footer() ?>
