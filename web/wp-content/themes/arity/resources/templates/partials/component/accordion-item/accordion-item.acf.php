<?php
namespace App\Theme;

// ACF Fields
$fields = [
  // Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'accordion-item__headline',
    'key' => 'field_headline',
    'instructions' => 'Recommended max character count: 160',
    'required' => 1,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  // Center Content
  acf_wysiwyg([
    'label' => 'Content',
    'name' => 'accordion-item__content',
    'key' => 'field_content',
    'instructions' => '',
    'media_upload' => 0,
    'required' => 1,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ])
];

// ACF Field Group
acf_field_group([
  'title' => 'Component - Accordion Item',
  'name' => 'component__accordion-item',
  'key' => 'group_component_accordion-item',
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
