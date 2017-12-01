<?php

declare(strict_types=1);

namespace App\Theme;

/*
    @see - https://github.com/wordplate/acf
*/

// We don't need this file if ACF isn't loaded
if (! class_exists('Acf')) {
    return;
}

// Make sure WordPlate\Acf\Acf is loaded
if (! class_exists('WordPlate\Acf\Acf') || ! function_exists('acf_field_group')) {
    return;
}

// Make sure our fancy plugin is loaded
if (! class_exists('ModuleBuilder\ModuleBuilder')) {
    return;
}

$module_builder = new \ModuleBuilder\ModuleBuilder(config());

/*
|--------------------------------------------------------------------------
| Settings
|--------------------------------------------------------------------------
|
| ACF Lite Mode
| ACF Options Page
| ACF Options Page User Role Settings
|
*/

/**
 * ACF Lite Mode
 */
// define( 'ACF_LITE' , true );

/**
 * ACF Options Page
 */
if (function_exists('acf_add_options_page')) {

    /**
     * ACF Add Options Page
     */

    // acf_add_options_page(array(
    // 	'menu_title'	=> 'Theme Settings',
    // 	'menu_slug' 	=> 'theme-general-settings',
    // 	'redirect'		=> true
    // ));
    //
    // acf_add_options_sub_page(array(
    // 	'page_title' 	=> 'Theme General Settings',
    // 	'menu_title'	=> 'General',
    // 	'parent_slug'	=> 'theme-general-settings',
    // 	'capability'	=> 'manage_options'
    // ));

    // acf_add_options_sub_page(array(
    // 	'page_title' 	=> 'Theme Header Settings',
    // 	'menu_title'	=> 'Header',
    // 	'parent_slug'	=> 'theme-general-settings',
    // 	'capability'	=> 'manage_options'
    // ));
    //
    // acf_add_options_sub_page(array(
    // 	'page_title' 	=> 'Theme Footer Settings',
    // 	'menu_title'	=> 'Footer',
    // 	'parent_slug'	=> 'theme-general-settings',
    // 	'capability'	=> 'manage_options'
    // ));
}

/**
 * Determine User Level for Settings Pages
 */
add_filter('acf/settings/show_admin', function ($show) {
    // Uncomment for Admin access allow
    // return current_user_can('manage_options');
    return $show;
});


/*
|--------------------------------------------------------------------------
| Field Choices
|--------------------------------------------------------------------------
|
*/

/**
 * Helper for ACF color choices.
 */
global $acf_choices_color;
$acf_choices_color = [
    'red' => 'Red',
    'blue' => 'Blue'
];

/**
 * Helper for ACF icon choices.
 */
global $acf_choices_icon;
$acf_choices_icon = [
    'driving-engine-sdk' => 'Driving Engine SDK',
    'driving-behavior' => 'Driving Behavior',
    'driving-score' => 'Driving Score',
    'solutions' => 'Solutions',
    'mobility-prequal' => 'Mobility PreQual',
    'mobility-score' => 'Mobility Score',
    'mobility-analytics-report' => 'Mobility Analytics Report'
];


/*
|--------------------------------------------------------------------------
| Components
|--------------------------------------------------------------------------
|
*/
$module_builder->includeACFSettings('feature-solution', 'component');
$module_builder->includeACFSettings('horizontal-card', 'component');
$module_builder->includeACFSettings('vertical-card', 'component');
$module_builder->includeACFSettings('product-cta', 'component');
$module_builder->includeACFSettings('product-stats', 'component');
$module_builder->includeACFSettings('text-icon-stack', 'component');
$module_builder->includeACFSettings('icon-only-stack', 'component');
$module_builder->includeACFSettings('text-w-icon', 'component');


/*
|--------------------------------------------------------------------------
| Modules
|--------------------------------------------------------------------------
|
*/
$module_builder->includeACFSettings('big-feature-block', 'module');
$module_builder->includeACFSettings('body-one-column', 'module');
$module_builder->includeACFSettings('body-two-column', 'module');
$module_builder->includeACFSettings('contact-form-w-cta', 'module');
$module_builder->includeACFSettings('contact-form', 'module');
$module_builder->includeACFSettings('content-image-block', 'module');
$module_builder->includeACFSettings('feature-solution-block', 'module');
$module_builder->includeACFSettings('hero-a', 'module');
$module_builder->includeACFSettings('hero-b', 'module');
$module_builder->includeACFSettings('hero-d', 'module');
$module_builder->includeACFSettings('horizontal-cards', 'module');
$module_builder->includeACFSettings('lead-gen', 'module');
$module_builder->includeACFSettings('page-footnote', 'module');
$module_builder->includeACFSettings('promo', 'module');
$module_builder->includeACFSettings('two-column-contact', 'module');
$module_builder->includeACFSettings('vertical-cards', 'module');
$module_builder->includeACFSettings('module-header', 'module');
$module_builder->includeACFSettings('career-list', 'module');
$module_builder->includeACFSettings('action-bar', 'module');
$module_builder->includeACFSettings('action-bar-one-col-cta', 'module');
$module_builder->includeACFSettings('action-bar-w-bkg', 'module');
$module_builder->includeACFSettings('sub-footer', 'module');
$module_builder->includeACFSettings('icon-two-column', 'module');

/*
|--------------------------------------------------------------------------
| Other Settings
|--------------------------------------------------------------------------
|
*/
$module_builder->buildModulesFieldGroup(array(
    'page_template' => 't0-modules'
));

/*
|--------------------------------------------------------------------------
| Debug
|--------------------------------------------------------------------------
|
*/

if (!is_admin()) {
    // var_dump($GLOBALS['acf']->local);
    // exit;
}
