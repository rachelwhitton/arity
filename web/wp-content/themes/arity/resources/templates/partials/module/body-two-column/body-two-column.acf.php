<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'body-two-column__headline',
      'key' => 'field_headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    acf_tab([
      'label' => 'Left Column',
      'name' => 'body-two-column__left_column_tab',
    ]),

    // Left Column
    acf_flexible_content([
      'label' => '',
      'name' => 'body-two-column__left_column',
      'key' => 'field_left_column',
      'instructions' => '',
      'required' => 0,
      'button_label'    => 'Add Component',
      'layouts' => [
        [
          'label' => 'Feature Solution',
          'name' => 'component__feature-solution',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Feature Solution',
              'name' => 'component__feature-solution',
              'key' => 'field_component_feature-solution',
              'display' => 'seamless',
              'clone' => [
                  'group_component_feature-solution'
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
              'key' => 'field_component_text-icon-stack',
              'display' => 'seamless',
              'clone' => [
                  'group_component_text-icon-stack'
              ]
            ]
          ]
        ],
        [
          'label' => 'Product CTA',
          'name' => 'component__product-cta',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Product CTA',
              'name' => 'component__product-cta',
              'key' => 'field_component_product-cta',
              'display' => 'seamless',
              'clone' => [
                  'group_component_product-cta'
              ]
            ]
          ]
        ]
      ]
    ]),

    acf_tab([
      'label' => 'Right Column',
      'name' => 'body-two-column__right_column_tab',
    ]),

    // Right Column
    acf_flexible_content([
      'label' => '',
      'name' => 'body-two-column__right_column',
      'key' => 'field_right_column',
      'instructions' => '',
      'required' => 0,
      'button_label'    => 'Add Component',
      'layouts' => [
        [
          'label' => 'Product Stats',
          'name' => 'component__product-stats',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Product Stats',
              'name' => 'component__product-stats',
              'key' => 'field_component_product-stats',
              'display' => 'seamless',
              'clone' => [
                  'group_component_product-stats'
              ]
            ]
          ]
        ],
        [
          'label' => 'Column Image',
          'name' => 'element__image',
          'sub_fields' => [
            [
              'type' => 'image',
              'label' => 'Image',
              'name' => 'element__image',
              'key' => 'field_element__image',
              'display' => 'seamless',
              'clone' => [
                  'group_element_image'
              ]
            ]
          ]
        ]
      ]
    ])

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Block: 2 column : sidebar',
    'name' => 'module__body-two-column',
    'key' => 'group_module_body-two-column',
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
