<?php
namespace App\Theme;

/*
  Template Name:      Site Header
  Template Type:      Module
  Description:        This is the site header v2.
  Last Updated:       11/20/2017
  Since:              1.2.0
  Version:            2
*/

?>
<div class="site-header">
  <nav class="navbar" role="navigation">
    <div class="container">
      <div class="navbar__header">
        <a role="menuitem" class="navbar__brand" href="<?= home_url('/'); ?>" rel="home" title="Arity Homepage">
          <img src="<?= asset_path('img/logo-arity-white.svg'); ?>" alt="" class="navbar__logo">
          <span class="sr-only"><?= get_bloginfo('name'); ?></span>
        </a>
        <button type="button" role="button" class="navbar__toggle collapsed" data-toggle="collapsed" data-target="#navbar" aria-expanded="false" aria-controls="navbar" aria-hidden="true">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar__toggle__box">
            <span class="navbar__toggle__inner"></span>
          </span>
        </button>
      </div>
      <div id="navbar" class="navbar__collapse collapsed">
        <div class="navbar__collapse-wrapper">
          <div class="navbar__nav-title" aria-hidden="true" hidden>
            <span>Menu</span>
          </div>
          <?php
            if (has_nav_menu('header_primary')) :
              wp_nav_menu([
                'menu'            => 'nav_menu',
                'theme_location'  => 'header_primary',
                'depth'           => 2,
                'menu_class'      => 'nav navbar__nav',
                'submenu_class'   => 'sub-menu navbar__nav__sub-menu collapsed',

              ]);
            endif;

            $menus = get_nav_menu_locations();
            $nav_items = wp_get_nav_menu_items($menus['header_primary']);
            $last_nav_item = end($nav_items);
            $last_nav_item->post_slug = sanitize_title($last_nav_item->title);
          ?>
          <div class="navbar__toolbar-bottom" tabindex="-1" aria-hidden="true">
            <ul role="menubar" class="nav">
              <li class="menu-item menu-<?= $last_nav_item->post_slug; ?>">
                <a href="<?= $last_nav_item->url; ?>" role="menuitem" tabindex="-1"><?= $last_nav_item->title; ?></a>
              </li>
            </ul>
          </div>
        </div><!--/.nav__collapse-wrapper -->
      </div><!--/.nav__collapse -->
    </div>
  </nav>
  <div class="dropmenu" data-menu-item="industries" tabindex="-1" aria-hidden="true">
    <div class="dropmenu__container">
      <div class="dropmenu__arrow"></div>
      <div class="dropmenu__wrap">
        <div class="dropmenu__primary">
          <a href="<?= home_url('industry-applications/'); ?>" title="Learn more about Industries Solutions" tabindex="-1">
            <p>See the ways we can shape transportation, together.</p>
            <p>
              <span class="button">
                <span class="button__label">View all industries</span>
                <svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-right-short"></use></svg>
              </span>
            </p>
          </a>
        </div>
        <div class="dropmenu__secondary">
          <div class="dropmenu__item">
            <a href="<?= home_url('industry-applications/shared-mobility-solutions/'); ?>" title="Learn more about Shared Mobility" tabindex="-1">
              <h2>Shared Mobility <svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-right-short"></use></svg></h2>
              <p>Recruit and incentivize top drivers, set smarter pricing strategies and accurately predict losses to maximize efficiency.</p>
            </a>
          </div>
          <div class="dropmenu__item">
            <a href="<?= home_url('industry-applications/automotive/'); ?>" title="Learn more about Automotive" tabindex="-1">
              <h2>Automotive <svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-right-short"></use></svg></h2>
              <p>Predict and prevent accidents by leveraging historical data and real-time factors like weather and traffic.</p>
            </a>
          </div>
          <div class="dropmenu__item">
            <a href="<?= home_url('industry-applications/insurance/'); ?>" title="Learn more about Insurance" tabindex="-1">
              <h2>Insurance <svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#arrow-right-short"></use></svg></h2>
              <p>Identify and retain preferred drivers, anticipate loss and price accurately with the most predictive measure of driving risk ever.</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
