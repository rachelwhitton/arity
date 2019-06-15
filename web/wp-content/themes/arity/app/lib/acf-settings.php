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

// Sort
array_multisort($acf_choices_color);

/**
 * Helper for ACF icon choices.
 */
global $acf_choices_icon;
$acf_choices_icon = [
    'safe-alerts' => 'Alert Triangle',
    'accident-prediction' => 'Car Accident',
    'speedy' => 'Car SpeedBehavior',
    'driving-engine-sdk' => 'Device BarChart',
    'mobile-sensors' => 'Device Sensors',
    'save-money' => 'Dollar Sign',
    'driver-safety' => 'Person Shield',
    'person-focus' => 'Person Focus',
    'solutions' => 'System Circle',
    'mobility-analytics-report' => 'System Connections',
    'vehicle-systems' => 'System Spokes',
    'driving-behavior' => 'Swerve Arrow',
    'navigation' => 'Navigation Pin',
    'mobility-prequal' => 'Checkboxes (Mobility PreQual)',
    'mobility-score' => 'Speedometer (Mobility Score)',
    'driving-score' => 'Tag (Driving Score)',
];

// Sort
array_multisort($acf_choices_icon);

/*
|--------------------------------------------------------------------------
| Components
|--------------------------------------------------------------------------
|
*/
$module_builder->includeACFSettings('accordion-item', 'component');
// $module_builder->includeACFSettings('block-two-col-component', 'component');
$module_builder->includeACFSettings('feature-solution', 'component');
$module_builder->includeACFSettings('horizontal-card', 'component');
$module_builder->includeACFSettings('vertical-card', 'component');
$module_builder->includeACFSettings('card', 'component');
$module_builder->includeACFSettings('highlight-block', 'component');
$module_builder->includeACFSettings('product-cta', 'component');
$module_builder->includeACFSettings('product-stats', 'component');
$module_builder->includeACFSettings('text-icon-stack', 'component');
$module_builder->includeACFSettings('text-image-stack', 'component');
$module_builder->includeACFSettings('text-w-icon', 'component');
$module_builder->includeACFSettings('text-w-image', 'component');
$module_builder->includeACFSettings('text-block', 'component');
$module_builder->includeACFSettings('text-block-two-column', 'component');
$module_builder->includeACFSettings('custom-cta', 'component');
$module_builder->includeACFSettings('carousel-item', 'component');

//to be archived Components
$module_builder->includeACFSettings('icon-only-stack', 'component');

/*
|--------------------------------------------------------------------------
| Modules
|--------------------------------------------------------------------------
|
*/
$module_builder->includeACFSettings('accordion', 'module');
$module_builder->includeACFSettings('addthis-social-sharing', 'module');
$module_builder->includeACFSettings('body-one-column', 'module');
$module_builder->includeACFSettings('body-two-column', 'module');
$module_builder->includeACFSettings('body-inset-ten-col', 'module');
$module_builder->includeACFSettings('blog-teaser', 'module');
$module_builder->includeACFSettings('generic-form-container', 'module');
$module_builder->includeACFSettings('headless-form-container', 'module');
$module_builder->includeACFSettings('content-image-block', 'module');
$module_builder->includeACFSettings('hero-a', 'module');
$module_builder->includeACFSettings('hero-b', 'module');
$module_builder->includeACFSettings('hero-c', 'module');
$module_builder->includeACFSettings('hero-d', 'module');
$module_builder->includeACFSettings('block-cards', 'module');
$module_builder->includeACFSettings('block-feature-solution', 'module');
$module_builder->includeACFSettings('block-highlights', 'module');
$module_builder->includeACFSettings('block-two-col-repeater', 'module');
$module_builder->includeACFSettings('block-video', 'module');
$module_builder->includeACFSettings('promo', 'module');
$module_builder->includeACFSettings('promo-card-horizontal', 'module');
$module_builder->includeACFSettings('vertical-cards-block', 'module');
$module_builder->includeACFSettings('career-list', 'module');
$module_builder->includeACFSettings('action-bar', 'module');
$module_builder->includeACFSettings('action-bar-one-col-cta', 'module');
$module_builder->includeACFSettings('action-bar-w-bkg', 'module');
$module_builder->includeACFSettings('action-bar-map', 'module');
$module_builder->includeACFSettings('disclaimer', 'module');
$module_builder->includeACFSettings('sub-footer', 'module');
$module_builder->includeACFSettings('icon-two-column', 'module');
$module_builder->includeACFSettings('horizontal-rule', 'module');
$module_builder->includeACFSettings('nav-jump-link', 'module');
$module_builder->includeACFSettings('newsroom-item', 'module');
$module_builder->includeACFSettings('data-vis', 'module');
$module_builder->includeACFSettings('image-full-width', 'module');
$module_builder->includeACFSettings('pardot-form', 'module');
$module_builder->includeACFSettings('blog-popup', 'module');
$module_builder->includeACFSettings('content-custom-feature', 'module');
$module_builder->includeACFSettings('carousel', 'module');
$module_builder->includeACFSettings('about-us-instagram', 'module');
$module_builder->includeACFSettings('block-two-column-narrow', 'module');

//archive candidate

//archived Modules
// $module_builder->includeACFSettings('body-intro', 'module');
// $module_builder->includeACFSettings('hero-g-test', 'module');
// $module_builder->includeACFSettings('page-footnote', 'module');
// $module_builder->includeACFSettings('contact-form-w-cta', 'module');
// $module_builder->includeACFSettings('contact-form', 'module');
// $module_builder->includeACFSettings('email-form', 'module');
// $module_builder->includeACFSettings('smart-city-form', 'module');
// $module_builder->includeACFSettings('horizontal-cards', 'module');
// $module_builder->includeACFSettings('big-feature-block', 'module');
// $module_builder->includeACFSettings('two-column-contact', 'module');
// $module_builder->includeACFSettings('lead-gen', 'module');
// $module_builder->includeACFSettings('vertical-cards', 'module');
// $module_builder->includeACFSettings('cards-block-split', 'module');
// $module_builder->includeACFSettings('highlights', 'module');
// $module_builder->includeACFSettings('promo-strip', 'module');
// $module_builder->includeACFSettings('module-header', 'module');
// $module_builder->includeACFSettings('promo-section', 'module');
// $module_builder->includeACFSettings('video', 'module');
// $module_builder->includeACFSettings('location-section', 'module');
// $module_builder->includeACFSettings('horizontal-card-split', 'module');
// $module_builder->includeACFSettings('feature-solution-block', 'module');


/*
|--------------------------------------------------------------------------
| Other Settings
|--------------------------------------------------------------------------
|
*/
$module_builder->buildModulesFieldGroup(array(
    'page_template' => 't0-modules',
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
