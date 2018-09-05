<?php
namespace App\Theme;

/*
  Template Name:      Site Header Lite
  Template Type:      Module
  Description:        This is the lighter site header.
  Last Updated:       12/12/2017
  Since:              1.3.0
  Version:            1
*/

// Gather data ya'll
if(empty($data)) {
  if(empty($data = $GLOBALS['THEME_SITE_HEADER_LITE'])) {
    return false;
  }
}

//echo '<pre>';echo get_field('header_lite_white_header');print_r($GLOBALS['THEME_SITE_HEADER_LITE']);echo '</pre>';

$is_white = "";
if(get_field('header_lite_white_header')){
  $is_white = "is-white";
}

if(!isset($data['brand']['link'])) {
  $data['brand']['link'] = home_url('/');
}

if(!isset($data['brand']['title'])) {
  $data['brand']['title'] = get_bloginfo('name') . " Homepage";
}

if(!isset($data['brand']['rel']) && $data['brand']['link'] == home_url('/')) {
  $data['brand']['rel'] = "home";
}

if(!isset($data['brand']['name'])) {
  $data['brand']['name'] = get_bloginfo('name');
}

if(!isset($data['brand']['logo'])) {
  $data['brand']['logo'] = asset_path('img/logo-arity-white.svg');
}

?>
<div class="site-header lite-- <?=$is_white?>">
  <nav class="navbar" role="navigation">
    <div class="container">
      <div class="navbar__header">
        <?php if(!empty($data['brand']['link'])) : ?>
          <a role="menuitem" class="navbar__brand" href="<?= $data['brand']['link']; ?>"<?php if(!empty($data['brand']['rel'])) : ?> rel="<?= $data['brand']['rel']; ?>"<?php endif; ?> title="<?= $data['brand']['title']; ?>">
        <?php else : ?>
          <div class="navbar__brand">
        <?php endif; ?>
        <?php if(get_field('header_lite_white_header')){ ?>
          <?php if(!empty($data['brand']['logo'])) : ?><img src="<?= $data['brand']['logo']; ?>" alt="" class="navbar__logo dark_logo"><?php endif; ?>
          <?php if(!empty(get_field('header_lite_brand_white_logo'))) : ?><img src="<?= get_field('header_lite_brand_white_logo') ?>" alt="" class="navbar__logo white_logo"><?php endif; ?>
        <?php }else{?>
          <?php if(!empty($data['brand']['logo'])) : ?><img src="<?= $data['brand']['logo']; ?>" alt="" class="navbar__logo"><?php endif; ?>
        <?php }?>
          <?php if(!empty($data['brand']['name'])) : ?><span class="sr-only"><?= $data['brand']['name']; ?></span><?php endif; ?>
          <?php if(!empty($data['brand']['link'])) : ?>
            </a>
          <?php else : ?>
          </div>
          <?php endif; ?>
        <button type="button" role="button" class="navbar__toggle collapsed" data-toggle="collapsed" data-target="#navbar" aria-expanded="false" aria-controls="navbar" aria-hidden="true">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar__toggle__box">
            <span class="navbar__toggle__inner"></span>
          </span>
        </button>
      </div>
      <?php if(!empty($data['menu'])) : ?>
        <div id="navbar" class="navbar__collapse collapsed">
          <div class="navbar__collapse-wrapper">
            <div class="navbar__nav-title" aria-hidden="true" hidden>
              <span>Menu</span>
            </div>
            <ul class="nav navbar__nav" role="menubar">
              <?php
                $i=0; foreach($data['menu'] as $item) :
                  $i++;

                  if(empty($item['menu_item']['title'])) {
                    continue;
                  }

                  if(empty($item['menu_item']['id'])) {
                    $item['menu_item']['id'] = sanitize_title($item['menu_item']['title']);
                  }

                  $item['menu_item']['link_attrs'] = '';
                  if($i!=1) {
                    $item['menu_item']['link_attrs'] .= ' tabindex="-1"';
                  }

                  if(!empty($item['menu_item']['target'])) {
                    $item['menu_item']['link_attrs'] .= ' target="' . $item['menu_item']['target'] . '"';
                  }

                  if(empty($item['menu_item']['url'])) {
                    $item['menu_item']['url'] = '#'.$item['menu_item']['id'];
                  }
                ?>
                <li class="menu-item menu-industries"><a href="<?= $item['menu_item']['url']; ?>" role="menuitem"<?= $item['menu_item']['link_attrs']; ?>><?= $item['menu_item']['title']; ?></a>
              <?php endforeach; ?>
            </ul>
          </div><!--/.nav__collapse-wrapper -->
        </div><!--/.nav__collapse -->
      <?php endif; ?>
    </div>
  </nav>
</div>
