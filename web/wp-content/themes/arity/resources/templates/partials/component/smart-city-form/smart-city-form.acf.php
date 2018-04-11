<?php
namespace App\Theme;

// ACF Field Group
acf_field_group([
    'title' => 'Component - Form :: Smart City',
    'name' => 'component__smart-city-form',
    'key' => 'group_component_smart-city-form',
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
