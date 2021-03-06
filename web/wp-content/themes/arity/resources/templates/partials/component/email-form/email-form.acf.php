<?php
namespace App\Theme;
// ACF Fields
$fields = [
  acf_message([
    'label' => '',
    'name' => 'email-form__placeholder',
    'key' => 'field_placeholder',
    'message' => '',
    'instructions' => 'Generates form fields.',
  ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Form :: Email ',
    'name' => 'component__email-form',
    'key' => 'group_component_email-form',
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
