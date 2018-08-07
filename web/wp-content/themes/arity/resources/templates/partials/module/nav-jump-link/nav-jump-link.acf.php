<?php
namespace App\Theme;

// ACF Fields
$fields = [

  // Left Headline
  acf_text([
    'label' => 'ID',
    'name' => 'nav-jump-link__left_headline',
    'key' => 'field_left_headline',
    'instructions' => 'Recommended character count max: 70',
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ])
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Nav: Jump Link',
    'name' => 'module__nav-jump-link',
    'key' => 'group_module_nav-jump-link',
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
