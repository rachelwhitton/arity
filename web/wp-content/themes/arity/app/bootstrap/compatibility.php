<?php

declare(strict_types=1);

namespace App\Theme;

use Arity\Notices;

// Include detect plugin function.
if (! function_exists('is_plugin_active')) {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
}

/**
 * Ensure Arity\Foundation plugin is loaded.
 */
if (! (
    is_plugin_active('arity/arity.php')
    || class_exists('Arity\Foundation')
)) {
    $message = __('Arity Foundation plugin is required for this theme.');
    $subtitle = __('Missing Required plugin');
    $title = __('Theme &rsaquo; Error');
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p>";
    wp_die($message, $title);

    // We have a problems. Return negative status.
    return false;
}

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.0.0', phpversion(), '>=')) {
    Notices::error(
        __('You must be using PHP 7.0.0 or greater.'),
        __('Invalid PHP version')
    );

    // We have a problems. Return negative status.
    return false;
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.6.0', get_bloginfo('version'), '>=')) {
    Notices::error(
        __('You must be using WordPress 4.6.0 or greater.'),
        __('Invalid WordPress version')
    );

    // We have a problems. Return negative status.
    return false;
}

/**
 * Ensure Composer dependencies are loaded
 */
if (!file_exists($composer = get_template_directory() . '/vendor/autoload.php')) {
    Notices::error(
        __('You must run <code>composer install</code> from the Theme directory.'),
        __('Autoloader not found.')
    );

    // We have a problems. Return negative status.
    return false;
}

/**
 * Check for missing dist directory.
 */
if (!is_admin() && !is_dir(get_template_directory() . '/dist')) {
    Notices::error(
        __('/dist directory is missing. Try rebuilding your assets by running `yarn run dev`.'),
        __('Missing dist directory')
    );

    // We have a problems. Return negative status.
    return false;
}

// Everything is ok. Return positive status.
return true;
