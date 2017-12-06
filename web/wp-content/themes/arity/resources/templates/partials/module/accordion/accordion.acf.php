<?php
namespace App\Theme;

// ACF Fields
$fields = [
  // Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'accordion__headline',
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
    'name' => 'accordion__categories',
    'sub_fields' => [
      [
        // Headline
        'type' => 'clone',
        'label' => 'Accordion Category',
        'name' => 'component__accordion-category',
        'display' => 'group',
        'clone' => [
          'group_component_accordion-category'
        ]
      ]
    ],
    'min'         => 2,
    'max'         => 10,
    'layout'      => 'block',
    'button_label'  => 'Add Accordion Category',
  ])
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Accordion',
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
