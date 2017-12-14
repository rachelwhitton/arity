<?php

namespace App\Theme;

use function App\Theme\template;

?>

<?php do_action('theme/before_footer') ?>
<?php
    if(!empty($GLOBALS['THEME_SITE_HEADER_LITE'])) {
        template('layout/footer-lite');
    } else {
        template('layout/footer');
    }
?>
<?php do_action('theme/after_footer') ?>

    <?php wp_footer(); ?>

  </body>
</html>
