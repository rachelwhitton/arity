<?php
namespace App\Theme;

// ACF Fields
$fields = [
  // Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'accordion-category__headline',
    'key' => 'field_headline',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  // Vertical Card
  acf_repeater([
    'label' => '',
    'name' => 'accordion-category__items',
    'sub_fields' => [
      [
        // Headline
        'type' => 'clone',
        'label' => 'Accordion Category Item',
        'name' => 'component__accordion-category-item',
        'display' => 'group',
        'clone' => [
          'group_component_accordion-category-item'
        ]
      ]
    ],
    'min'         => 2,
    'max'         => 10,
    'layout'      => 'block',
    'button_label'  => 'Add Accordion Category Item',
  ])
];

// ACF Field Group
acf_field_group([
  'title' => 'Component - Accordion Category',
  'name' => 'component__accordion-category',
  'key' => 'group_component_accordion-category',
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
