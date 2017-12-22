<?php

namespace App\Theme;

use function App\Theme\template;

?>

<?php do_action('theme/before_footer') ?>
<?php
    if(!empty($GLOBALS['THEME_SITE_FOOTER_LITE'])) {
        template('layout/footer-lite');
    } else {
        template('layout/footer');
    }
?>
<?php do_action('theme/before_wpfooter') ?>
    <?php wp_footer(); ?>
    <?php do_action('theme/after_wpfooter') ?>
  </body>
</html>
