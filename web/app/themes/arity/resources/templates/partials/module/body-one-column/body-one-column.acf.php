<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'body-one-column__headline',
      'key' => 'field_headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Center Content
    acf_wysiwyg([
      'label' => 'Content',
      'name' => 'body-one-column__content',
      'key' => 'field_content',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ])

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Body One Column',
    'name' => 'module__body-one-column',
    'key' => 'group_module_body-one-column',
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
