<?php
namespace App\Theme;

// ACF Fields
$fields = [

    acf_message([
      'label' => 'Contact Form',
      'name' => 'contact-form__form_placeholder',
      'key' => 'field_form_placeholder',
      'message' => '',
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Lead Gen',
    'name' => 'module__contact-form',
    'key' => 'group_module_contact-form',
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
