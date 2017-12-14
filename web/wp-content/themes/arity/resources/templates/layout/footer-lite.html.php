<?php
namespace App\Theme;

?>

<footer class="site-footer-generic">
  <div class="container">
    <div class="row">
      <div class="site-footer-generic-copy">
        <small class="site-footer-generic__copyright">
          <span>© 2017 Arity, LLC. All rights reserved.</span>
          <span>|</span>
          <ul class="">
            <li class="__item menu-item menu-privacy-policy">
              <a href="/privacy/" class="__link" aria-selected="false">Privacy Policy</a>
            </li>
          </ul>
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
