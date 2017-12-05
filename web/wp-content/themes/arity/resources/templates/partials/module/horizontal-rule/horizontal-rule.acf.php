<?php
namespace App\Theme;

// ACF Fields
$fields = [

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Horizontal Rule',
    'name' => 'module__horizontal-rule',
    'key' => 'group_module_horizontal-rule',
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
