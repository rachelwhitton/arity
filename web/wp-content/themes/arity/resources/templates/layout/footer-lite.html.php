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
          <?php if ($data['hideMenu']){ ?>
              <span></span>
          <?php }else{ ?>
            <span class="separator">|</span>
              <?php
                if(get_field('custom_footer_menu_name')!=''){
                  wp_nav_menu([
                    'menu'            => get_field('custom_footer_menu_name'),
                    'theme_location'  => 'footer_copyright',
                    'menu_class'      => '',
                    'menu_role'       => ''
                  ]);
                }else{
                  if (has_nav_menu('footer_copyright')){
                    wp_nav_menu([
                      'menu'            => 'nav_menu',
                      'theme_location'  => 'footer_copyright',
                      'menu_class'      => '',
                      'menu_role'       => ''
                    ]);
                  }
                }
              ?>
          <?php } ?>
        </small>
      </div>
    </div>
  </div>
</footer>
