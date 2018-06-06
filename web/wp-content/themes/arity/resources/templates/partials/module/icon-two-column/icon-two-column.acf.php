<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'icon-two-column__headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 100',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Left Tab
    acf_tab([
      'label' => 'Left Column',
      'name' => 'icon-two-column__left_column_tab',
    ]),

    // Left Column
    acf_flexible_content([
      'label' => '',
      'name' => 'icon-two-column__left_column',
      'key' => 'field_left_column',
      'instructions' => '',
      'required' => 0,
      'button_label'    => 'Add Component',
      'layouts' => [
        [
          'label' => 'Text Image Stack',
          'name' => 'component__text-image-stack',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Text Image Stack',
              'name' => 'component__text-image-stack',
              'key' => 'field_component_left_text-image-stack',
              'display' => 'seamless',
              'clone' => [
                  'group_component_text-image-stack'
              ]
            ]
          ]
        ],
        [
          'label' => 'Text Icon Stack',
          'name' => 'component__text-icon-stack',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Text Icon Stack',
              'name' => 'component__text-icon-stack',
              'key' => 'field_component_left_text-icon-stack',
              'display' => 'seamless',
              'clone' => [
                  'group_component_text-icon-stack'
              ]
            ]
          ]
        ],
        [
          'label' => 'Icon Only Stack (Deprecated DO NOT USE)',
          'name' => 'component__icon-only-stack',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Icon Only Stack',
              'name' => 'component__icon-only-stack',
              'key' => 'field_component_left_icon-only-stack',
              'display' => 'seamless',
              'clone' => [
                  'group_component_icon-only-stack'
              ]
            ]
          ]
        ]
      ]
    ]),

    // Right Tab
    acf_tab([
      'label' => 'Right Column',
      'name' => 'icon-two-column__right_column_tab',
    ]),

    // Right Column
    acf_flexible_content([
      'label' => '',
      'name' => 'icon-two-column__right_column',
      'key' => 'field_right_column',
      'instructions' => '',
      'required' => 0,
      'button_label'    => 'Add Component',
      'layouts' => [
        [
          'label' => 'Text Image Stack',
          'name' => 'component__text-image-stack',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Text Image Stack',
              'name' => 'component__text-image-stack',
              'key' => 'field_component_right_text-image-stack',
              'display' => 'seamless',
              'clone' => [
                  'group_component_text-image-stack'
              ]
            ]
          ]
        ],
        [
          'label' => 'Text Icon Stack',
          'name' => 'component__text-icon-stack',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Text Icon Stack',
              'name' => 'component__text-icon-stack',
              'key' => 'field_component_right_text-icon-stack',
              'display' => 'seamless',
              'clone' => [
                  'group_component_text-icon-stack'
              ]
            ]
          ]
        ],
        [
          'label' => 'Icon Only Stack (Deprecated DO NOT USE)',
          'name' => 'component__icon-only-stack',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Icon Only Stack',
              'name' => 'component__icon-only-stack',
              'key' => 'field_component_right_icon-only-stack',
              'display' => 'seamless',
              'clone' => [
                  'group_component_icon-only-stack'
              ]
            ]
          ]
        ]
      ]
    ])

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Block: Content icon pair: 2 column',
    'name' => 'module__icon-two-column',
    'key' => 'group_module_icon-two-column',
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
