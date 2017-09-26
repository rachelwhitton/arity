<?php

namespace App\Theme;

use function App\Theme\template;

?>

<?php do_action('theme/before_footer') ?>
<?php template('layout/footer'); ?>
<?php do_action('theme/after_footer') ?>

    <?php wp_footer(); ?>

  </body>
</html>
