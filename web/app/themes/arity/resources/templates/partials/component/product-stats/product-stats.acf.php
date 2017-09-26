<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Product Stats
    acf_repeater([
      'label' => '',
      'name' => 'product-stats__stats',
      'sub_fields' => [

        acf_tab([
          'label' => 'Content',
          'name' => 'tab_content',
        ]),

        // Before Value
        [
          'type' => 'text',
          'label' => 'Text before Stat Value',
          'name' => 'value_before',
          'key' => 'field_value_before',
          'instructions' => '',
          'required' => 0,
          'maxlength' => '',
          'wrapper' => array (
            'width' => '33',
          )
        ],

        // Value
        [
          'type' => 'text',
          'label' => 'Stat Value',
          'name' => 'value',
          'key' => 'field_value',
          'instructions' => '',
          'required' => 1,
          'maxlength' => '',
          'wrapper' => array (
            'width' => '33',
          )
        ],

        // After Value
        [
          'type' => 'text',
          'label' => 'Text after Stat Value',
          'name' => 'value_after',
          'key' => 'field_value_after',
          'instructions' => '',
          'required' => 0,
          'maxlength' => '',
          'wrapper' => array (
            'width' => '33',
          )
        ],

        // Text
        [
          'type' => 'text',
          'label' => 'Text Below Stat Value',
          'name' => 'text_below',
          'key' => 'field_text_below',
          'instructions' => '',
          'required' => 0,
          'maxlength' => '',
          'wrapper' => array (
            'width' => '66',
          ),
        ],

        // Value
        [
          'type' => 'text',
          'label' => 'Setting: Stat Value before Animated',
          'name' => 'value_start',
          'key' => 'field_value_start',
          'instructions' => '',
          'required' => 0,
          'maxlength' => '',
          'wrapper' => array (
            'width' => '33',
          )
        ],

        acf_tab([
          'label' => 'Options',
          'name' => 'left_column_tab',
        ]),

        acf_select([
          'label' => 'Stat Color',
          'name' => 'stat_color',
          'key' => 'field_stat_color',
          'instructions' => '',
          'required' => 0,
          'maxlength' => '',
          'allow_null' => 1,
          'ui' => 1,
          'wrapper' => array (
            'width' => '50',
          ),
          'choices' => [
            'teal' => 'Teal',
            'darkblue' => 'Dark Blue',
            'blue' => 'Blue'
          ]
        ]),
      ],
      'min'         => 1,
      'max'         => 100,
      'layout'      => 'block',
            'button_label'  => 'Add Stat',
    ])
];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Product Stats',
    'name' => 'component__product-stats',
    'key' => 'group_component_product-stats',
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
