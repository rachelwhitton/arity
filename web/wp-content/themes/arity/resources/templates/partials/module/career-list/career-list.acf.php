<?php
namespace App\Theme;

// ACF Fields
$fields = [
  acf_message([
    'label' => '',
    'name' => 'career-list__placeholder',
    'key' => 'field_placeholder',
    'message' => '',
    'instructions' => 'Dynamically generates career list based on an RSS Feed.',
  ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Career List',
    'name' => 'module__career-list',
    'key' => 'group_module_career-list',
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
