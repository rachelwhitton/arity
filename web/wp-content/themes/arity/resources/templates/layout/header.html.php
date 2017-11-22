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
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggle-box">
            <span class="navbar-toggle-inner"></span>
          </span>
        </button>
        <a href="<?= home_url('/'); ?>" rel="home" title="Arity Homepage" class="navbar-brand">
          <img src="<?= asset_path('img/logo-arity-white.svg'); ?>" alt="" class="navbar-logo">
          <span class="sr-only"><?= get_bloginfo('name'); ?></span>
        </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <div class="navbar-collapse-wrapper">
          <div class="navbar-nav-title" aria-hidden="true">
            <span>Menu</span>
          </div>
          <?php
            if (has_nav_menu('header_primary')) :
              wp_nav_menu([
                'menu'            => 'nav_menu',
                'theme_location'  => 'header_primary',
                'depth'           => 2,
                'container'       => false,
                'menu_class'      => 'nav navbar-nav',
                'menu_id'         => '',
                'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
                // 'walker'          => new NavWalker()
              ]);
            endif;

            $menus = get_nav_menu_locations();
            $nav_items = wp_get_nav_menu_items($menus['header_primary']);
            $last_nav_item = end($nav_items);
            $last_nav_item->post_slug = sanitize_title($last_nav_item->title);
          ?>
          <div class="navbar-toolbar-bottom" aria-hidden="true">
            <ul class="nav">
              <li class="menu-item menu-<?= $last_nav_item->post_slug; ?>"><a href="<?= $last_nav_item->url; ?>"><?= $last_nav_item->title; ?></a></li>
            </ul>
          </div>
        </div><!--/.nav-collapse-wrapper -->
      </div><!--/.nav-collapse -->
    </div>
  </nav>
</div>
