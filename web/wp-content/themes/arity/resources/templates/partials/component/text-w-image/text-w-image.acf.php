<?php
namespace App\Theme;

global $acf_choices_icon;

// ACF Fields
$fields = [

  // Image
  acf_image([
    'label' => 'Image',
    'name' => 'text-w-image__image_id',
    'key' => 'field_image',
    'return_format' => 'id',
    'instructions' => 'Reccommended image size: 120 x 120 px',
    'required' => 0,
    'preview_size'  => 'thumbnail',
    'wrapper' => array (
      'width' => '50',
    )
  ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'text-w-image__headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 56',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    // Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'text-w-image__body_copy',
      'key' => 'field_body_copy',
      'instructions' => 'Recommended character count max: 240',
      'required' => 1,
      'new_lines' => 'wpautop',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Text w/ Icon',
    'name' => 'component__text-w-image',
    'key' => 'group_component_text-w-image',
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
