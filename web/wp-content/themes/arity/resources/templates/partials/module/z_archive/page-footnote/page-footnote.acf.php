<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Body Copy
    acf_text([
      'label' => 'Body Copy',
      'name' => 'page-footnote__body_copy',
      'key' => 'field_body_copy',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Page Footnote',
    'name' => 'module__page-footnote',
    'key' => 'group_module_page-footnote',
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
