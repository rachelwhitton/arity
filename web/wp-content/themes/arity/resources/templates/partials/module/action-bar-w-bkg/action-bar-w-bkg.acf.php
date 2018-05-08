<?php
namespace App\Theme;

// ACF Fields
$fields = [

  // Left Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'action-bar-w-bkg__left_headline',
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
    'name' => 'action-bar-w-bkg__left_content',
    'key' => 'field_left_content',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  // Image
  acf_image([
    'label' => 'Bkg Image',
    'name' => 'action-bar-w-bkg__bkg_image_id',
    'key' => 'field_bkg_image_id',
    'return_format' => 'id',
    'instructions' => '',
    'required' => 0,
    'preview_size'  => 'thumbnail',
    'wrapper' => array (
      'width' => '50',
    )
  ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Action Bar: Image',
    'name' => 'module__action-bar-w-bkg',
    'key' => 'group_module_action-bar-w-bkg',
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
