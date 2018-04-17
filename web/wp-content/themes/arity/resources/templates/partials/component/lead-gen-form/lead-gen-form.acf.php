<?php
namespace App\Theme;

// ACF Field Group
acf_field_group([
    'title' => 'Component - Form :: Generic (Short)',
    'name' => 'component__generic-form-short',
    'key' => 'group_component_generic-form-short',
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
