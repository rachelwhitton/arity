<?php

namespace App\Theme;

use function App\Theme\template;
?>

<?php get_header() ?>

<?php do_action('theme/before_content') ?>
<div id="main" class="site-content <?=$_ENV['PANTHEON_ENVIRONMENT']?>">
  <?php the_acf_content(); ?>
</div>
<?php do_action('theme/after_content') ?>

<?php get_footer() ?>
