<?php
namespace App\Theme;

?>

<?php do_action('theme/before_content') ?>
<?php the_acf_content(); ?>
<?php do_action('theme/after_content') ?>
