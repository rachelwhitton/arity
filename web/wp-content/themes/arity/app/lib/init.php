<?php

declare(strict_types=1);

namespace App\Theme;

/*
|-----------------------------------------------------------
| Theme Init
|-----------------------------------------------------------
|
| This file enables the most common theme defaults.
|
*/

use function App\Theme\config;

/**
 * Theme setup
 *
 * @since 1.0.0
 * @return void
 */
add_action('after_setup_theme', function () {

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'widgets'
    ]);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');
});

/**
 * Loads theme textdomain language files.
 *
 * @since 1.0.0
 * @return void
 */
add_action('after_setup_theme', function () {
    $paths = config('paths');
    $directories = config('directories');

    if (!empty($directories['languages'])) {
        load_theme_textdomain(config('textdomain'), "{$paths['directory']}/{$directories['languages']}");
    }
});
