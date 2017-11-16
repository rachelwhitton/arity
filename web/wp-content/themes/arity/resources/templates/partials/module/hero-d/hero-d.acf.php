<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'hero-d__headline',
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
      'name' => 'hero-d__text',
      'key' => 'field_text',
      'instructions' => '',
      'required' => 0,
      'new_lines' => 'wpautop',
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      )
    ]),

    // Image
    acf_image([
      'label' => 'Bkg Image',
      'name' => 'hero-d__bkg_image_id',
      'key' => 'field_bkg_image_id',
      'return_format' => 'id',
      'instructions' => '',
      'required' => 0,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '50',
      )
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Hero D',
    'name' => 'module__hero-d',
    'key' => 'group_module_hero-d',
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
