<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'hero-g-test__headline',
      'key' => 'field_headline',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    // Image
    acf_image([
      'label' => 'Image',
      'name' => 'hero-g-test__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => '',
      'required' => 0,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '50',
      )
    ]),

    // Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'hero-g-test__body_copy',
      'instructions' => '',
      'required' => 1,
      'new_lines' => 'wpautop'
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'hero-g-test__cta',
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
    'title' => 'Module - Hero G TEST',
    'name' => 'module__hero-g-test',
    'key' => 'group_module_hero-g-test',
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
