<?php
namespace App\Theme;

// ACF Fields
$fields = [
    acf_text([
      'label' => 'Headline',
      'name' => 'horizontal-cards__headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
    ]),

    // Vertical Card
    acf_repeater([
      'label' => '',
      'name' => 'horizontal-cards__cards',
      'sub_fields' => [
        [
          // Headline
          'type' => 'clone',
          'label' => 'Horizontal Card',
          'name' => 'component__horizontal-card',
          'display' => 'group',
          'clone' => [
              'group_component_horizontal-card'
          ]
        ]
      ],
      'min'         => 1,
      'max'         => 1,
      'layout'      => 'block',
            'button_label'  => 'Add Horizontal Card',
    ])
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Horizontal Cards',
    'name' => 'module__horizontal-cards',
    'key' => 'group_module_horizontal-cards',
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
