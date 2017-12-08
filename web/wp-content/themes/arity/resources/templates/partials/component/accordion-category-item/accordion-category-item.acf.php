<?php
namespace App\Theme;

// ACF Fields
$fields = [
  // Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'accordion-category-item__headline',
    'key' => 'field_headline',
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
    'name' => 'accordion-category-item__content',
    'key' => 'field_content',
    'instructions' => '',
    'required' => 1,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ])
];

// ACF Field Group
acf_field_group([
  'title' => 'Component - Accordion Category Item',
  'name' => 'component__accordion-category-item',
  'key' => 'group_component_accordion-category-item',
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
