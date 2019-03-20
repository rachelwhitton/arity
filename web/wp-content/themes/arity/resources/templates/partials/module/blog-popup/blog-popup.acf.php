<?php
namespace App\Theme;

// ACF Fields
$fields = [
  // Time
  acf_text([
    'label' => 'Popup Delay Interval',
    'name' => 'blog-popup__time',
    'key' => 'field_popup-time',
    'instructions' => 'Delay, in seconds, before popup appears. Default is 20sec.<br/> Countdown is triggered by initial scroll.',
    'required' => 1,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Blog - Popup',
    'name' => 'module__blog-popup',
    'key' => 'group_module_blog-popup',
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