<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'feature-solution-block__headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 100',
      'required' => 1,
      'maxlength' => ''
    ]),

    // Repeater: Component Feature Solution Blocks
    acf_repeater([
      'label' => '',
      'name' => 'feature-solution-block__blocks',
      'sub_fields' => [
        [
          // Headline
          'type' => 'clone',
          'label' => 'Feature Solution',
          'name' => 'component__feature-solution',
          'display' => 'group',
          'clone' => [
              'group_component_feature-solution'
          ]
        ]
      ],
      'min'         => 1,
      'max'         => 100,
      'layout'      => 'block',
            'button_label'  => 'Add Feature Solution Block',
    ])

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Feature Solution Block',
    'name' => 'module__feature-solution-block',
    'key' => 'group_module_feature-solution-block',
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
