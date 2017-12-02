<?php
namespace App\Theme;

// ACF Fields
$fields = [

  // Center Tab
  acf_tab([
    'label' => 'Center Column',
    'name' => 'action-bar-one-col-cta__center_column_tab',
  ]),

  // Center Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'action-bar-one-col-cta__center_headline',
    'key' => 'field_center_headline',
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
    'name' => 'action-bar-one-col-cta__center_content',
    'key' => 'field_center_content',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  // Center Content CTA Repeater
  acf_repeater([
    'label' => '',
    'name' => 'action-bar-one-col-cta__center_links',
    'sub_fields' => [
      [
        // Headline
        'type' => 'link',
        'label' => 'CTA Button',
        'name' => 'link',
        'instructions' => '',
        'required' => 0,
        'maxlength' => ''
      ]
    ],
    'min'         => 1,
    'max'         => 2,
    'layout'      => 'block',
    'button_label'  => 'Add Link',
  ])
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Action Bar One Column CTA',
    'name' => 'module__action-bar-one-col-cta',
    'key' => 'group_module_action-bar-one-col-cta',
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
