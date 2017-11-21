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
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="<?= home_url('/'); ?>" rel="home" title="Arity Homepage" class="navbar-brand">
          <img src="<?= asset_path('img/logo-arity-white.svg'); ?>" alt="" class="navbar-logo">
          <span class="sr-only"><?= get_bloginfo('name'); ?></span>
        </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <?php
          if (has_nav_menu('header_primary')) :
            wp_nav_menu([
              'menu'            => 'nav_menu',
              'theme_location'  => 'header_primary',
              'depth'           => 1,
              'container'       => false,
              'menu_class'      => 'nav navbar-nav',
              'menu_id'         => '',
              'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
              'walker'          => new NavWalker()
            ]);
          endif;
        ?>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
</div>
