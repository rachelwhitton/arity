<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Icon Stack
    acf_repeater([
      'label' => '',
      'name' => 'icon-only-stack__stacks',
      'sub_fields' => [
        [
          // Headline
          'type' => 'clone',
          'label' => '',
          'name' => 'component__text-w-icon',
          'display' => 'group',
          'clone' => [
              'group_component_text-w-icon'
          ]
        ]
      ],
      'min'         => 1,
      'max'         => 100,
      'layout'      => 'block',
            'button_label'  => 'Add Icon Stack',
    ])
];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Icon Only Stack (Deprecated DO NOT USE)',
    'name' => 'component__icon-only-stack',
    'key' => 'group_component_icon-only-stack',
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
