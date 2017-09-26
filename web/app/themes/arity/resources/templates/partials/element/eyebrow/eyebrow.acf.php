<?php
namespace App\Theme;

// ACF Fields
$fields = [
    acf_text([
      'name' => 'eyebrow__label',
      'label' => 'Label'
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Element - Eyebrow',
    'name' => 'element__eyebrow',
    'key' => 'group_element_eyebrow',
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
