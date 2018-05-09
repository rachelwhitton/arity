<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'text-image-stack__headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 100',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Icon Stack
    acf_repeater([
      'label' => '',
      'name' => 'text-image-stack__stacks',
      'sub_fields' => [
        [
          // Headline
          'type' => 'clone',
          'label' => '',
          'name' => 'component__text-w-image',
          'display' => 'group',
          'clone' => [
              'group_component_text-w-image'
          ]
        ]
      ],
      'min'         => 1,
      'max'         => 100,
      'layout'      => 'block',
            'button_label'  => 'Add Image Stack',
    ])
];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Text Image Stack',
    'name' => 'component__text-image-stack',
    'key' => 'group_component_text-image-stack',
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
