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
      <!-- <div class="site-footer__col col2--">
        <h2 class="site-footer__header">Developer portal</h2>
        <p>Sign up for an account on the Arity developer portal and try our APIs.</p>
        <p>
        <a href="https://developer.arity.com/" target="_blank" class="ar-element button button--footer">
          <svg class="site-footer__icon icon-svg" title="" role="img">
            <use xlink:href="#external"></use>
          </svg> Visit the portal
        </a>
        </p>
      </div> -->
      <div class="site-footer__col col2--">
        <h2 class="site-footer__header">Press</h2>
        <p>Get in touch with an Arity rep or visit our newsroom.</p>
        <p>
          <a href="mailto:media@arity.com" target="_blank" class="ar-element button button--footer">
            <svg class="site-footer__icon icon-svg arrow-right" title="" role="img">
              <use xlink:href="#email"></use>
            </svg> Email press inquiries
          </a>
          <!-- <a href="https://www.arity.com/wp-content/uploads/2018/04/arity-press-kit.zip" class="ar-element button button--footer">
            <svg class="site-footer__icon icon-svg" title="" role="img">
              <use xlink:href="#download"></use>
            </svg> Download the press kit
          </a> -->
          <a href="<?= home_url('newsroom/'); ?>" class="ar-element button button--footer">
            <svg class="site-footer__icon icon-svg news" title="" role="img">
              <use xlink:href="#news"></use>
            </svg> Visit the Newsroom
          </a>
        </p>
      </div>
      <div class="site-footer__col col3--">
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
    <?php
    $all_fields = get_fields($post_id);
    for($j=0; $j<sizeof($all_fields['modules']);$j++){
      if($all_fields['modules'][$j]['acf_fc_layout']=='module__disclaimer'){ ?>
        <div class="row">
          <div class="site-footer__col col5-- disclaimer">
            <?=$all_fields['modules'][$j]['disclaimer__content']?>
          </div>
        </div>
    <?php
      }
    }
    ?>
   
    
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
