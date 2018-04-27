<?php
namespace App\Theme;

// ACF Fields
$fields = [

    acf_tab([
      'label' => 'Content',
      'name' => 'promo__content_tab',
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'promo__headline',
      'instructions' => 'Recommended character count max: 100',
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
      'instructions' => 'Recommended character count max: 100',
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
      'instructions' => 'Recommended character count max: 200',
      'required' => 1,
      'new_lines' => 'wpautop',
      'maxlength' => '',
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'promo__cta',
      'instructions' => 'Recommended character count max: 30',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    acf_tab([
      'label' => 'Options',
      'name' => 'promo__options_tab',
    ]),

    acf_checkbox([
      'label' => 'Extra Module Padding',
      'name' => 'promo__padding',
      'instructions' => 'Do you need some space between modules? (Disabled by default)',
      'choices' => [
        'top' => 'Yes, top padding &uarr;',
        'bottom' => 'Yes, bottom padding &darr;'
      ],
      'wrapper' => array (
        'width' => '50',
      ),
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Promo: Wide',
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
