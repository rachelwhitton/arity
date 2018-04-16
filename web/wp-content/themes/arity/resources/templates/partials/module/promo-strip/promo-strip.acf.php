<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'promo-strip__headline',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      )
    ]),

    // Location
    acf_text([
      'label' => 'Location',
      'name' => 'promo-strip__location',
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
      'name' => 'promo-strip__body_copy',
      'instructions' => '',
      'required' => 1,
      'new_lines' => 'wpautop',
      'maxlength' => '',
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'promo-strip__cta',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Promo Strip',
    'name' => 'module__promo-strip',
    'key' => 'group_module_promo-strip',
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
