<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
        'label' => 'Headline',
        'name' => 'email-form__headline',
        'key' => 'field_headline',
        'instructions' => '',
        'required' => 0,
        'maxlength' => '',
        'wrapper' => array (
        'width' => '100',
        ),
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Email Form',
    'name' => 'module__email-form',
    'key' => 'group_module_email-form',
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
