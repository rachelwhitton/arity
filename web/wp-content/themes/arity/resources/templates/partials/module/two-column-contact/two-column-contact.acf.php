<?php
namespace App\Theme;

// ACF Fields
$fields = [
    acf_text([
      'label' => 'Left Column Headline',
      'name' => 'two-column-contact__left_column_headline',
      'instructions' => '',
      'required' => 0
    ]),
    acf_text([
      'label' => 'Right Column Headline',
      'name' => 'two-column-contact__right_column_headline',
      'instructions' => '',
      'required' => 0
    ]),
    acf_textarea([
      'label' => 'Right Column Body Copy',
      'name' => 'two-column-contact__right_column_body_copy',
      'instructions' => '',
      'required' => 0,
      'new_lines' => 'wpautop'
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Two Column Contact',
    'name' => 'module__two-column-contact',
    'key' => 'group_module_two-column-contact',
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
