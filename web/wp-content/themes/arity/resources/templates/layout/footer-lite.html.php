<?php
namespace App\Theme;

?>

<footer class="site-footer-generic">
  <div class="container">
    <div class="row">
      <div class="site-footer-generic-copy">
        <p>SMALL FOOTER INFO</p>
      </div>
    </div>
  </div>
</footer>
<?php
  if (!empty($GLOBALS['sub-footer'])) {
    module('sub-footer', $GLOBALS['sub-footer']);
  }
?>
