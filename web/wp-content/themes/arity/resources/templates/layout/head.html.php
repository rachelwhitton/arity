<?php
namespace App\Theme;

?>

<head>
  <meta charset="<?= get_bloginfo('charset'); ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="msapplication-config" content="none"/>
  <meta name="google-site-verification" content="VJohIR_Gmk-5Dd3pGQFA2wkseBfX3jbquvwkI1GsdK4" />
  <meta name="msvalidate.01" content="DB78D25556E2C1E8350F7FF5D7740943" />

<?php do_action('theme/head'); ?>

<?php /* Intentional Spaces */ ?>

<?php wp_head(); ?>

</head>
