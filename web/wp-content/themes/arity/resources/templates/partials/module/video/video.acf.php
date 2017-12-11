<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Video
    acf_text([
      'label' => 'Video',
      'name' => 'video__url',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      )
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Video',
    'name' => 'module__video',
    'key' => 'group_module_video',
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
