<?php

namespace App\Theme;

use function App\Theme\template;
?>

<?php get_header() ?>

<?php do_action('theme/before_content') ?>
<div id="main" class="site-content <?=$_ENV['PANTHEON_ENVIRONMENT']?>">
  <?php module('hero-c', array(
    'headline' => get_the_title()
  )); ?>
  <?php module('body-one-column', array(
    'content' => get_the_content()
  )); ?>
</div>
<?php do_action('theme/after_content') ?>

<?php get_footer() ?>
