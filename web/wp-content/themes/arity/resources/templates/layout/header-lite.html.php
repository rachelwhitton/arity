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

if(empty($data)) {
  $data = $GLOBALS['THEME_SITE_HEADER_LITE'];
}

if(empty($data)) {
  return false;
}

if(!isset($data['brand']['href'])) {
  $data['brand']['href'] = home_url('/');
}

if(!isset($data['brand']['title'])) {
  $data['brand']['title'] = "Arity Homepage";
}

if(!isset($data['brand']['rel']) && $data['brand']['href'] == home_url('/')) {
  $data['brand']['rel'] = get_bloginfo('name') . " Homepage";
}

if(!isset($data['brand']['tagline'])) {
  $data['brand']['tagline'] = get_bloginfo('name');
}

if(!isset($data['brand']['logo'])) {
  $data['brand']['logo'] = asset_path('img/logo-arity-white.svg');
}

?>
<div class="site-header lite--">
  <nav class="navbar" role="navigation">
    <div class="container">
      <div class="navbar__header">
        <?php if(!empty($data['brand']['href'])) : ?>
          <a role="menuitem" class="navbar__brand" href="<?= $data['brand']['href']; ?>" rel="<?= $data['brand']['rel']; ?>" title="<?= $data['brand']['title']; ?>">
        <?php else : ?>
          <div class="navbar__brand">
        <?php endif; ?>
          <?php if(!empty($data['brand']['logo'])) : ?><img src="<?= $data['brand']['logo']; ?>" alt="" class="navbar__logo"><?php endif; ?>
          <?php if(!empty($data['brand']['tagline'])) : ?><span class="sr-only"><?= $data['brand']['tagline']; ?></span><?php endif; ?>
          <?php if(!empty($data['brand']['href'])) : ?>
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
      <?php if(!empty($data['menu']['items'])) : ?>
        <div id="navbar" class="navbar__collapse collapsed">
          <div class="navbar__collapse-wrapper">
            <div class="navbar__nav-title" aria-hidden="true" hidden>
              <span>Menu</span>
            </div>
            <ul class="nav navbar__nav" role="menubar">
              <?php
                $i=0; foreach($data['menu']['items'] as $item) :
                  $i++;

                  if(empty($item['label'])) {
                    continue;
                  }

                  if(empty($item['id'])) {
                    $item['id'] = sanitize_title($item['label']);
                  }

                  $item['link_attrs'] = '';
                  if($i!=1) {
                    $item['link_attrs'] .= ' tabindex="-1"';
                  }

                  if(empty($item['link'])) {
                    $item['link'] = '#'.$item['id'];
                  }
              ?>
                <li class="menu-item menu-industries"><a href="<?= $item['link']; ?>" role="menuitem"<?= $item['link_attrs']; ?>><?= $item['label']; ?></a>
              <?php endforeach; ?>
            </ul>
          </div><!--/.nav__collapse-wrapper -->
        </div><!--/.nav__collapse -->
      <?php endif; ?>
    </div>
  </nav>
</div>
