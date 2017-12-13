<?php

namespace App\Theme;

use function App\Theme\template;

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<?php template('layout/head'); ?>

<body <?php body_class(); ?>>
<?php do_action('theme/after_body') ?>

<?php do_action('theme/before_header') ?>
<?php
    if(!empty($GLOBALS['THEME_SITE_HEADER_LITE'])) {
        template('layout/header-lite');
    } else {
        template('layout/header');
    }
?>
<?php do_action('theme/after_header') ?>
