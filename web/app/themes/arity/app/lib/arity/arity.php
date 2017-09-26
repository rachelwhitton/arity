<?php

/*
Plugin Name: Arity/Foundation
Description:
Version: 1.0.0-alpha.1
Author: VSA Partners
Author URI: http://www.vsapartners.com
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

// Autoload using composer, if Composer autoload exists
if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    require_once $composer;
}

$autoloader = require_once('autoload.php');

// If we haven't loaded this plugin from Composer we need to add our own autoloader
if (!class_exists('Arity\Foundation')) {
    $autoloader('Arity\\', __DIR__ . '/src/Arity/');
}

// If we haven't loaded this plugin from Composer we need to add our own autoloader
if (!class_exists('ModuleBuilder\ModuleBuilder')) {
    $autoloader('ModuleBuilder\\', __DIR__ . '/src/Arity/ModuleBuilder/');
}

// Load helpers
$helpers = __DIR__ . '/helpers.php';
require_once $helpers;

add_action('init', function () {
    \Arity\Foundation::init();
});
