<?php
namespace App\Theme;

// ACF Fields
$fields = [
    acf_image([
      'label' => 'Image',
      'name' => 'image__id',
      'return_format' => 'id'
    ])
];

// ACF Field Group
acf_field_group([
    'title' => 'Element - Image',
    'name' => 'element__image',
    'key' => 'group_element_image',
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
