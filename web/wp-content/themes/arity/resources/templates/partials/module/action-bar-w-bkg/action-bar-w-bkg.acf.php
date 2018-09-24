<?php
namespace App\Theme;

// ACF Fields
$fields = [
  acf_select([
    'label' => 'Background Color',
    'name' => 'content-image-block__bkg_color',
    'key' => 'field_bkg_color',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'allow_null' => 1,
    'ui' => 1,
    'wrapper' => array (
      'width' => '25',
    ),
    'default_value' => 'colors__bg--blue',
    'choices' => [
      'colors__bg--blue' => 'Blue',
      'colors__bg--lightgray' => 'Light Gray',
      'colors__bg--navy' => 'Navy',
      'colors__bg--white' => 'White'
    ]
  ]),
  // Left Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'action-bar-w-bkg__left_headline',
    'key' => 'field_left_headline',
    'instructions' => 'Recommended character count max: 70',
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
    'instructions' => 'Recommended character count max: 200',
    'media_upload' => 0,
    'toolbar' => 'basic',
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  // Image
  acf_image([
    'label' => 'Image',
    'name' => 'action-bar-w-bkg__bkg_image_id',
    'key' => 'field_bkg_image_id',
    'return_format' => 'id',
    'instructions' => 'Suggested image size: 1080 x 700 px<br/> Note: Ideal image height is dependent on content ',
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
