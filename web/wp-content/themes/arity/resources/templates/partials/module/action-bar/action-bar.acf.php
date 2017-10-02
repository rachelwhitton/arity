<?php
namespace App\Theme;

// ACF Fields
$fields = [

  // Left Tab
  acf_tab([
    'label' => 'Left Column',
    'name' => 'action-bar__left_column_tab',
  ]),

  // Left Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'action-bar__left_headline',
    'key' => 'field_left_headline',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  // Left Content
  acf_wysiwyg([
    'label' => 'Content',
    'name' => 'action-bar__left_content',
    'key' => 'field_left_content',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  // Center Tab
  acf_tab([
    'label' => 'Center Column',
    'name' => 'action-bar__center_column_tab',
  ]),

  // Center Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'action-bar__center_headline',
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
    'name' => 'action-bar__center_content',
    'key' => 'field_center_content',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  acf_tab([
    'label' => 'Right Column',
    'name' => 'action-bar__right_column_tab',
  ]),

  // Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'action-bar__right_headline',
    'key' => 'field_right_headline',
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
    'name' => 'action-bar__right_content',
    'key' => 'field_right_content',
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
    'title' => 'Module - Action Bar',
    'name' => 'module__action-bar',
    'key' => 'group_module_action-bar',
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
