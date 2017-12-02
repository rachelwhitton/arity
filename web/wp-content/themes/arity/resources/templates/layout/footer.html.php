<?php
namespace App\Theme;

?>

<footer class="site-footer">
  <div class="container">

    <div class="row">
      <div class="site-footer__col col1--">
        <a href="<?= home_url('/'); ?>" rel="home">
          <svg class="site-footer__logo icon-svg" title="" role="img">
            <use xlink:href="#arity-logo"></use>
          </svg>
        </a>
      </div>
      <div class="site-footer__col col2--">
        <h2 class="site-footer__header">Developer portal</h2>
        <p>Sign up for an account on the Arity developer portal and try our APIs.</p>
        <p>
        <a href="https://developer.arity.com/" target="_blank" class="ar-element button button--footer">
          <svg class="site-footer__icon icon-svg" title="" role="img">
            <use xlink:href="#link-external"></use>
          </svg> Visit the portal
        </a>
        </p>
      </div>
      <div class="site-footer__col col3--">
        <h2 class="site-footer__header">Press</h2>
        <p>Looking for more? Get in touch with an Arity representative.</p>
        <p>
        <a href="mailto:media@arity.com" class="ar-element button button--footer">
          <svg class="site-footer__icon icon-svg" title="" role="img">
            <use xlink:href="#link-email"></use>
          </svg> Press inquiries
        </a>
        </p>
      </div>
      <div class="site-footer__col col4--">
        <h2 class="site-footer__header">Follow us</h2>
        <nav class="social-nav" role="navigation">
          <ul class="navlist social-nav__list">
            <li class="social-nav__item">
              <a class="social-nav__link linkedin--" href="https://www.linkedin.com/company/arity" target="_blank" aria-label="LinkedIn">
                <svg class="site-footer__icon icon-svg" title="" role="img">
                  <use xlink:href="#social-linkedin"></use>
                </svg>
              </a>
            </li>
            <li class="social-nav__item">
              <a class="social-nav__link twitter--" href="https://twitter.com/arity" target="_blank" aria-label="Twitter">
                <svg class="site-footer__icon icon-svg" title="" role="img">
                  <use xlink:href="#social-twitter"></use>
                </svg>
              </a>
            </li>
            <li class="social-nav__item">
              <a class="social-nav__link instagram--" href="https://www.instagram.com/arityofficial/" target="_blank" aria-label="Instagram">
                <svg class="site-footer__icon icon-svg" title="" role="img">
                  <use xlink:href="#social-instagram"></use>
                </svg>
              </a>
            </li>
            <li class="social-nav__item">
              <a class="social-nav__link facebook--" href="https://www.facebook.com/ArityInt/" target="_blank" aria-label="Facebook">
                <svg class="site-footer__icon icon-svg" title="" role="img">
                  <use xlink:href="#social-facebook"></use>
                </svg>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="site-footer__col col5--">
        <a href="<?= home_url('/'); ?>" rel="home">
          <svg class="site-footer__logo icon-svg" title="" role="img">
            <use xlink:href="#arity-logo"></use>
          </svg>
        </a>
        <br />
        <small class="site-footer__copyright">
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
<?php
  if (!empty($GLOBALS['sub-footer'])) {
    module('sub-footer', $GLOBALS['sub-footer']);
  }
?>
