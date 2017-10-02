<?php

namespace ThemeSettings;

/**
 * Custom Logo
 * @link http://kwight.ca/2012/12/02/adding-a-logo-uploader-to-your-wordpress-site-with-the-theme-customizer/
 * @link http://ottopress.com/tag/customizer/
 */


function add_custom_logo_support($wp_customize)
{

    $wp_customize->add_section('logo_section', array(
        'title'       => __('Logo', \App\Theme\config('textdomain')),
        'priority'    => 30,
        'description' => 'Upload a logo to replace the default'
    ));

    $wp_customize->add_setting('logo');

    $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'logo', array(
        'label'    => __('Logo', \App\Theme\config('textdomain')),
        'section'  => 'logo_section',
        'settings' => 'logo'
    )));
}
add_action('customize_register', __NAMESPACE__ . '\\add_custom_logo_support');
