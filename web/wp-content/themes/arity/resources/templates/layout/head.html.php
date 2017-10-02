<?php
namespace App\Theme;

?>

<head>
  <meta charset="<?= get_bloginfo('charset'); ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="msapplication-config" content="none"/>

<?php do_action('theme/head'); ?>

<?php /* Intentional Spaces */ ?>

<?php wp_head(); ?>

</head>
