<?php

declare(strict_types=1);

/*
 |------------------------------------------------------------------
 | Bootstraping a Theme
 |------------------------------------------------------------------
 |
 | This file is responsible for bootstrapping your theme. Autoloads
 | composer packages, checks compatibility and loads theme files.
 | Most likely, you don't need to change anything in this file.
 | Your theme custom logic should be distributed across a
 | separated components in the `/app` directory.
 |
 */


/**
 * Require Composer
 * @since 1.0.0
 * @return void
 *
 * Require Composer's autoloading file
 * if it's present in theme directory.
 */
if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    require_once $composer;
}

/**
 * Autoload plugins
 * @since 1.0.0
 * @return void
 *
 * Autoloads plugins/plugins in <theme>/app/plugin/
 * Similar to how Wordpress autoloads plugins
 */
$plugins = require_once __DIR__ . '/app/bootstrap/plugins.php';
foreach ($plugins as $filename) {
    if (file_exists($filename)) {
        require_once($filename);
    }
}

// Before running we need to check if everything is in place.
// If something went wrong, we will display friendly alert.
$ok = require_once __DIR__ . '/app/bootstrap/compatibility.php';

/**
 * Bootstrap Theme
 * @since 1.0.0
 * @return void
 *
 * Bootstraps Theme and autoloads required files in <theme>/app/config/app.php
 */
if ($ok) {
    // Now, we can bootstrap our theme.
    $theme = require_once __DIR__ . '/app/bootstrap/theme.php';

    // Autoload theme. Uses localize_template() and
    // supports child theme overriding. However,
    // they must be under the same dir path.
    (new \Arity\Autoloader($theme->get('config')))->register();
}
