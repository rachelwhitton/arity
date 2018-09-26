<?php
namespace App\Theme;

// ACF Fields
$fields = [
  // Headline
  acf_wysiwyg([
    'label' => 'Content',
    'name' => 'disclaimer__content',
    'key' => 'field_content_disclaimer',
    'instructions' => '',
    'media_upload' => 0,
    'toolbar' => 'basic',
    'required' => 1,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Text: Disclaimer Footer',
    'name' => 'module__disclaimer',
    'key' => 'group_module_disclaimer',
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
