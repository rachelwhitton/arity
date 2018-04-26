<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'promo__headline',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      )
    ]),

    // Location
    acf_text([
      'label' => 'Date / Location',
      'name' => 'promo__location',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      )
    ]),

    // Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'promo__body_copy',
      'instructions' => '',
      'required' => 1,
      'new_lines' => 'wpautop',
      'maxlength' => '',
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'promo__cta',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Promo',
    'name' => 'module__promo',
    'key' => 'group_module_promo',
    'fields' => $fields,
    'location' => [
        [
            acf_location('post_status', 'inactive')
        ]
    ],
    'hide_on_screen' => [
        'the_content',
        'custom_fields',
        'format',
        'featured_image'
    ]
]);
