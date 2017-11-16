<?php

namespace App\Theme;

use function App\Theme\template;

$content = '
<p>Sorry, the page you are looking for does not exist. <br>Make a U-turn.</p>
<p>
  <a href="'. home_url('/') .'" class="ar-element button button--primary"><span class="button__label">Go home</span></a>
</p>';
?>

<?php get_header() ?>

<?php do_action('theme/before_content') ?>
<div>
  <?php module('error-content', array(
    'headline' => '404',
    'content' => $content
  )); ?>
</div>
<?php do_action('theme/after_content') ?>

<?php get_footer() ?>
