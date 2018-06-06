<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Video Url
    acf_text([
      'label' => 'Video Url',
      'name' => 'block-video__url',
      'instructions' => 'Supports Vimeo or Youtube',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      )
    ])
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Block: Video',
    'name' => 'module__block-video',
    'key' => 'group_module_block-video',
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
