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

$menus = get_nav_menu_locations();
$nav_items = wp_get_nav_menu_items($menus['header_primary']);
$last_nav_item = end($nav_items);
$last_nav_item->post_slug = sanitize_title($last_nav_item->title);
?>
<div class="site-header">
  <nav class="navbar" role="navigation">
    <div class="container">
      <div class="navbar__header">
        <a role="menuitem" class="navbar__brand" href="<?= home_url('/'); ?>" rel="home" title="Arity Homepage">
          <svg class="site-header__logo icon-svg" title="" role="presentation">
            <use xlink:href="#arity-logo"></use>
          </svg>
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

  <!--
  ******************************************
  COUNTING MENU ITEMS WHEN EDITING THE MENUS

  $nav_items:
  0 => Platform
  1 => Solutions
  2 => Insurance
  3 => Shared Mobility
  4 => See All Insurance
  5 => Company
  6 => About us
  7 => Join the team
  8 => Blog
  9 => Get In Touch

  OLD $nav_items:
  0 => Industries
  1 => Insurance
  2 => Shared Mobility
  3 => View all industries
  4 => Understand your drivers
  5 => Company
  6 => About us
  7 => Join the team
  8 => Blog
  9 => Get In touch

  The $nav_items variable emcompasses all primary and secondary nav items
  For nav items with dropmenus, the parent determine whether a submenu item renders in the dropmenu.
  Ex: Industries resolves to $nav_items[0]->ID so any children of that item will render in the dropmenu and all others will not.
  ******************************************
  -->

  <div class="dropmenu" data-menu-item="solutions" tabindex="-1" aria-hidden="true">
    <div class="dropmenu__container">
      <div class="dropmenu__arrow"></div>
      <div class="dropmenu__wrap">
        <div class="dropmenu__primary" style="display: none;">
          <a href="<?= $nav_items[1]->url; ?>" title="Learn more about <?= $nav_items[1]->title; ?>" tabindex="-1" aria-label="<?= $nav_items[1]->title; ?>">
            <?php if(!empty($nav_items[1]->description)) : ?><p><?= $nav_items[1]->description; ?></p><?php endif; ?>
            <p>
              <span class="button">
                <span class="button__label">See all <?=strtolower($nav_items[2]->title);?></span>
                <svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#caret"></use></svg>
              </span>
            </p>
          </a>
        </div>
        <div class="dropmenu__secondary">
          <div class="eyebrow">Industries</div>

        <?php foreach ($nav_items as $nav_item) : ?>
            <?php if($nav_item->menu_item_parent != $nav_items[1]->ID) { continue; } ?>
            <div class="dropmenu__item">
              <a href="<?= $nav_item->url; ?>" title="Learn more about <?= $nav_item->title; ?>" tabindex="-1" aria-label="<?= $nav_item->title; ?>">
                <h2><?= $nav_item->title; ?> <svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#caret"></use></svg></h2>
                <?php if(!empty($nav_item->description)) : ?><!-- p><?= $nav_item->description; ?></p--><?php endif; ?>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="dropmenu" data-menu-item="company" tabindex="-1" aria-hidden="true">
    <div class="dropmenu__container">
      <div class="dropmenu__arrow"></div>
      <div class="dropmenu__wrap">
        <div class="dropmenu__primary" style="display:none">
          <a href="<?= $nav_items[6]->url; ?>" title="Learn more about <?= $nav_items[5]->title; ?>" tabindex="-1" aria-label="<?= $nav_items[5]->title; ?>">
            <?php if(!empty($nav_items[5]->description)) : ?><p><?= $nav_items[5]->description; ?></p><?php endif; ?>
            <p>
              <span class="button">
                <span class="button__label">View all <?= strtolower($nav_items[5]->title); ?></span>
                <svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#caret"></use></svg>
              </span>
            </p>
          </a>
        </div>
        <div class="dropmenu__secondary">
          <?php foreach ($nav_items as $nav_item) : ?>
            <?php if($nav_item->menu_item_parent != $nav_items[5]->ID) { continue; } ?>
            <div class="dropmenu__item__no-category-landing-page">
              <a href="<?= $nav_item->url; ?>" title="Learn more about <?= $nav_item->title; ?>" tabindex="-1" aria-label="<?= $nav_item->title; ?>">
                <h2><?= $nav_item->title; ?> <svg class="icon-svg" title="" role="img"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#caret"></use></svg></h2>
                <?php if(!empty($nav_item->description)) : ?><!-- p><?= $nav_item->description; ?></p--><?php endif; ?>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- <p><?= $nav_items[7]->title; ?></p> -->
</div>

<style>
  /*
  .dropmenu {
    max-width:350px !important;
  }
  .site-header .dropmenu__secondary {
    width:100% !important;
  }
  .site-header .dropmenu__container::after {
    display: none;
  }
  .site-header .dropmenu__item:last-child a h2 {
    color:#63727E;
    font-size:14px;
  }
  .site-header .dropmenu__item:last-child a:hover h2 {
    color: #0070D6;
  }
  .site-header .dropmenu__item:last-child a h2 .icon-svg {
    height:10px;
    width:10px;
    fill: #63727E;
  }
  .site-header .dropmenu__item:last-child a:hover h2 .icon-svg {
    fill: #0070D6;
  }
  */
</style>