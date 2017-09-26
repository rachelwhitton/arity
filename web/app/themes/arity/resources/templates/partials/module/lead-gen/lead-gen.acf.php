<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'lead-gen__headline',
      'key' => 'field_headline',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    acf_message([
      'label' => 'Lead Gen Form',
      'name' => 'lead-gen__form_placeholder',
      'key' => 'field_form_placeholder',
      'message' => '',
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Lead Gen',
    'name' => 'module__lead-gen',
    'key' => 'group_module_lead-gen',
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
