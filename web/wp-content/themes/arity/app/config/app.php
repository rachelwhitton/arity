<?php

$pkg = json_decode(file_get_contents(get_template_directory() .'/package.json'));

return [
    /*
    |--------------------------------------------------------------------------
    | Theme General
    |--------------------------------------------------------------------------
    |
    */
    'name' => $pkg->name,
    'title' => $pkg->title,
    'version' => $pkg->version,
    'patterns-version' => $pkg->config->arity,

    /*
    |--------------------------------------------------------------------------
    | Theme Textdomain
    |--------------------------------------------------------------------------
    |
    | Determines a textdomain for your theme. Should be used to dynamically set
    | namespace for gettext strings across theme. Remember, this value must
    | be in sync with `Text Domain:` entry inside style.css theme file.
    |
    */
    'textdomain' => 'arity',

    /*
    |--------------------------------------------------------------------------
    | Templates files extension
    |--------------------------------------------------------------------------
    |
    | Determines the theme's templates settings like an extension of the files.
    | By default, they use `.tpl.php` suffix to distinguish template files
    | from controllers, but you are free to change it however you like.
    |
    */
    'templates' => [
        'extension' => '.html.php'
    ],

    /*
    |--------------------------------------------------------------------------
    | ACF Configurations
    |--------------------------------------------------------------------------
    |
    | Determines the theme's settings for ACF like an extension of the files.
    |
    */
    'acf' => [
        'extension' => '.acf.php'
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme Root Paths
    |--------------------------------------------------------------------------
    |
    | This values determines the "root" paths of your theme. By default,
    | they use WordPress `get_template_directory` functions and
    | probably you don't need make any changes in here.
    |
    */
    'paths' => [
        'directory' => get_template_directory(),
        'uri' => get_template_directory_uri(),
    ],

    /*
    |--------------------------------------------------------------------------
    | Theme Directory Structure Paths
    |--------------------------------------------------------------------------
    |
    | This array of directories will be used within core for locating
    | and loading theme files, assets and templates. They must be
    | given as relative to the `root` theme directory.
    |
    */
    'directories' => [
        'languages' => 'resources/languages',
        'templates' => 'resources/templates',
        'templates-partials' => 'resources/templates/partials',
        'templates-page' => 'resources/templates/page-templates',
        'assets' => 'resources/assets',
        'dist' => 'dist',
        'app' => 'app',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Page Templates
    |--------------------------------------------------------------------------
    |
    | Add custom page templates
    |
    */
    'pageTemplates' => [
        't0-modules' => 'All Modules',
        't1-homepage' => 'T1 - Homepage',
        't2a-solutions-overview' => 'T2a - Solutions Overview',
        't2b-applications-overview' => 'T2b - Applications Overview',
        't3-product-detail' => 'T3 - Product Detail',
        't5-careers' => 'T5 - Careers',
        't6-contact' => 'T6 - Contact',
        't8-blog-landing' => 'T8 - Blog Landing',
        't12-privacy-policy' => 'T12 - Privacy Policy (Lang)',
        't13-smart-cities-usdot' => 'T13 - Smart Cities USDot',
        't14-cookies' => 'T14 - Cookies (Lang)',
        't20-campaign-landing' => 'T20 - Campaign Landing',
        't9-blog-post' => 'T9 Blog Article'
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Theme Components
    |--------------------------------------------------------------------------
    |
    | The components listed below will be automatically loaded on the
    | theme bootstrap by `functions.php` file. Feel free to add your
    | own files to this array which you would like to autoload.
    |
    */
    'autoload' => [
        'helpers',
        'init',
        'customize',
        'assets',
        'filters',
        'acf-settings',
        'nav-walker'
    ],

    /*
    |--------------------------------------------------------------------------
    | Assets - jQuery
    |--------------------------------------------------------------------------
    |
    | Choose to use jQuery cdn
    | Change jQuery Version
    | Add a jQuery local fallback if using CDN
    |
    */
    'jquery' => [
        'use_cdn' => true,
        'version' => !empty($pkg->dependencies->jquery) ? $pkg->dependencies->jquery : null,
        'local_fallback' => (str_replace(home_url(), '', get_template_directory_uri())) . '/node_modules/jquery/dist/jquery.min.js',
    ],
];
