<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'vertical-cards__headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
    ]),

    // Vertical Card
    acf_repeater([
      'label' => '',
      'name' => 'vertical-cards__cards',
      'sub_fields' => [
        [
          // Headline
          'type' => 'clone',
          'label' => 'Verical Card',
          'name' => 'component__vertical-card',
          'display' => 'group',
          'clone' => [
              'group_component_vertical-card'
          ]
        ]
      ],
      'min'         => 2,
      'max'         => 2,
      'layout'      => 'block',
            'button_label'  => 'Add Vertical Card',
    ])
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Vertical Cards',
    'name' => 'module__vertical-cards',
    'key' => 'group_module_vertical-cards',
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
