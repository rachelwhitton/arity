<?php
namespace App\Theme;

?>

<footer class="site-footer-generic">
  <div class="container">
    <div class="row">
      <div class="site-footer-generic-copy">
        <small class="site-footer-generic__copyright">
          <span><?= do_shortcode('[copyright]'); ?></span>
          <span>|</span>
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
        </small>
      </div>
    </div>
  </div>
</footer>
