<?php
namespace App\Theme;

/*
  Template Name:      Site Header
  Template Type:      Module
  Description:        This is the site header.
  Last Updated:       08/01/2017
  Since:              1.0.0
*/
?>

<header class="app__header site-header" id="appHeader">
  <a href="<?= home_url(); ?>" class="site-header__logo" aria-label="">
    <span class="sr-only"><?= get_bloginfo('name'); ?></span>
    <svg class="icon-svg" title="" role="img">
            <use xlink:href="#arity-logo"></use>
    </svg>
  </a>

  <a href="#" id="app-menu-control" class="site-header__menu-control" aria-controls="app-menu" aria-selected="false" aria-has-dropdown="true" aria-label="Open site menu" role="button"><span role="presentation"></span></a>

    <?php
      if (has_nav_menu('header_primary')) :
    ?>
      <nav id="app-menu" class="primary-navigation" role="navigation" aria-hidden="true">

        <div class="primary-navigation-wrapper">

          <?php
          wp_nav_menu([
            'menu'            => 'nav_menu',
            'theme_location'  => 'header_primary',
            'depth'           => 1,
            'container'       => false,
            'menu_class'      => 'primary-navigation__list navlist',
            'menu_id'         => 'primary-navigation',
            'items_wrap'      => '<ul class="%2$s"><li class="navlist__item--vertical navlist__item--title">Menu</li>%3$s</ul>',
            'walker'          => new NavWalker()
          ]);
          ?>

        </div>

      </nav>
    <?php
      endif;
    ?>
</header>
