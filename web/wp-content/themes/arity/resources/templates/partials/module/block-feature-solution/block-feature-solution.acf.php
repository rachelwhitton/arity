<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'block-feature-solution__headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 100',
      'required' => 1,
      'maxlength' => ''
    ]),

    // Repeater: Component Feature Solution Blocks
    acf_repeater([
      'label' => '',
      'name' => 'block-feature-solution__blocks',
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
    'title' => 'Module - Block: Feature Solution',
    'name' => 'module__block-feature-solution',
    'key' => 'group_module_block-feature-solution',
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
