<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'hero-c__headline',
      'key' => 'field_headline',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      )
    ]),

    // Text
    acf_textarea([
      'label' => 'Text',
      'name' => 'hero-c__text',
      'key' => 'field_text',
      'instructions' => '',
      'required' => 0,
      'new_lines' => 'wpautop',
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      )
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Hero C',
    'name' => 'module__hero-c',
    'key' => 'group_module_hero-c',
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
