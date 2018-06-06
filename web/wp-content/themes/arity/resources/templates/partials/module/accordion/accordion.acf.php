<?php
namespace App\Theme;

// ACF Fields
$fields = [
  // Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'accordion__headline',
    'key' => 'field_headline',
    'instructions' => 'Recommended max character count: 70',
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  // Vertical Card
  acf_repeater([
    'label' => '',
    'name' => 'accordion__items',
    'sub_fields' => [
      [
        // Headline
        'type' => 'clone',
        'label' => 'Accordion Item',
        'name' => 'component__accordion-item',
        'display' => 'group',
        'clone' => [
          'group_component_accordion-item'
        ]
      ]
    ],
    'min'         => 1,
    'max'         => 10,
    'layout'      => 'block',
    'button_label'  => 'Add Accordion Item',
  ])
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Block: Accordion',
    'name' => 'module__accordion',
    'key' => 'group_module_accordion',
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
