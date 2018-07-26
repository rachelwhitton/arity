<?php
namespace App\Theme;

// Gather data ya'll
if(empty($data)) {
  if(empty($data = $GLOBALS['THEME_SITE_FOOTER_LITE'])) {
    return false;
  }
}

?>

<footer class="site-footer-generic">
  <div class="container">
    <div class="row">
      <div class="site-footer-generic-copy">
        <small class="site-footer-generic__copyright">
          <span><?= do_shortcode('[copyright]'); ?></span>
          <span class="separator">|</span>
          <?php
            if (has_nav_menu('footer_copyright')) :
          ?>
            <?php
              wp_nav_menu([
                'menu'            => 'nav_menu',
                'theme_location'  => 'footer_copyright',
                'menu_class'      => '',
                'menu_role'       => ''
              ]);
            ?>
          <?php
            endif;
          ?>
          <?php if(!empty($data['menu'])) : ?>

            <ul class="" role="menubar">
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
                <li class="menu-item menu-extras"><span>&nbsp;&nbsp; |</span><a href="<?= $item['menu_item']['url']; ?>" role="menuitem"<?= $item['menu_item']['link_attrs']; ?>><?= $item['menu_item']['title']; ?></a>
              <?php endforeach; ?>
            </ul>
            
          <?php endif; ?>
        </small>
      </div>
    </div>
  </div>
</footer>
