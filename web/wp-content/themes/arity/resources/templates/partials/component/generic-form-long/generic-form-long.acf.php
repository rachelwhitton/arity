<?php
namespace App\Theme;

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
