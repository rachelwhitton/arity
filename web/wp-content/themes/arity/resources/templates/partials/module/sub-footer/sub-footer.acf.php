<?php
namespace App\Theme;

// ACF Fields
$fields = [
  // Headline
  acf_wysiwyg([
    'label' => 'Content',
    'name' => 'sub-footer__content',
    'key' => 'field_content',
    'instructions' => '',
    'required' => 1,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Text: Subfooter',
    'name' => 'module__sub-footer',
    'key' => 'group_module_sub-footer',
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
