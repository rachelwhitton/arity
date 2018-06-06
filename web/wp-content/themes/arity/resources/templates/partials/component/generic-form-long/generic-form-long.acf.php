<?php
namespace App\Theme;

// ACF Fields
$fields = [
  acf_message([
    'label' => '',
    'name' => 'generic-form-long__placeholder',
    'key' => 'field_placeholder',
    'message' => '',
    'instructions' => 'Generates form fields.',
  ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Form :: Generic (Long)',
    'name' => 'component__generic-form-long',
    'key' => 'group_component_generic-form-long',
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
