<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'vertical-cards-block__headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
    ]),

    // Vertical Card
    acf_repeater([
      'label' => '',
      'name' => 'vertical-cards-block__cards',
      'sub_fields' => [
        [
          // Headline
          'type' => 'clone',
          'label' => 'Vertical Card',
          'name' => 'component__vertical-card-stack',
          'display' => 'group',
          'clone' => [
              'group_component_vertical-card-stack'
          ]
        ]
      ],
      'min'         => 2,
      'max'         => 10,
      'layout'      => 'block',
            'button_label'  => 'Add Vertical Card',
    ])
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Vertical Cards Block',
    'name' => 'module__vertical-cards-block',
    'key' => 'group_module_vertical-cards-block',
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
