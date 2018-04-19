<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Image
    acf_image([
      'label' => 'Image',
      'name' => 'hero-b__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => '',
      'required' => 1,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '50',
      )
    ]),

    // Layout
    acf_select([
      'label' => 'Layout',
      'name' => 'hero-b__--settings_layout',
      'key' => 'field_--settings_layout',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,

      'wrapper' => array (
        'width' => '50',
      ),
      'default_value' => 'two-column',
      'choices' => [
        'one-column' => 'One Column',
        'two-column' => 'Two Column',
      ]
    ]),

    // One Column Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'hero-b__headline',
      'key' => 'field_headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
      'conditional_logic' => [
        [
          [
            'name' => 'hero-b__--settings_layout',
            'operator' => '==',
            'value' => 'one-column'
          ]
        ]
      ]
    ]),

    // One Column Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'hero-b__body_copy',
      'instructions' => '',
      'required' => 1,
      'new_lines' => 'wpautop',
      'conditional_logic' => [
        [
          [
            'name' => 'hero-b__--settings_layout',
            'operator' => '==',
            'value' => 'one-column'
          ]
        ]
      ]
    ]),

    // Two Column Tab for Left Column
    acf_tab([
      'label' => 'Left Column',
      'name' => 'hero-b__left_column_tab',
      'conditional_logic' => [
        [
          [
            'name' => 'hero-b__--settings_layout',
            'operator' => '==',
            'value' => 'two-column'
          ]
        ]
      ]
    ]),

    // Left Column Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'hero-b__left_column_headline',
      'key' => 'field_left_column_headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Left Column Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'hero-b__left_column_body_copy',
      'instructions' => '',
      'required' => 1,
      'new_lines' => 'wpautop'
    ]),

    // Two Column Tab for Right Column
    acf_tab([
      'label' => 'Right Column',
      'name' => 'hero-b__right_column_tab',
      'conditional_logic' => [
        [
          [
            'name' => 'hero-b__--settings_layout',
            'operator' => '==',
            'value' => 'two-column'
          ]
        ]
      ]
    ]),

    // Right Column Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'hero-b__right_column_headline',
      'key' => 'field_headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Right Column CTA Repeater
    acf_repeater([
      'label' => '',
      'name' => 'hero-b__right_column_links',
      'sub_fields' => [
        [
          // Headline
          'type' => 'link',
          'label' => 'CTA Button',
          'name' => 'link',
          'instructions' => '',
          'required' => 0,
          'maxlength' => ''
        ]
      ],
      'min'         => 1,
      'max'         => 2,
      'layout'      => 'block',
            'button_label'  => 'Add Link',
    ]),

    // Two Column Tab for Left Column
    acf_tab([
      'label' => 'Options',
      'name' => 'hero-b__options_tab',
      'conditional_logic' => [
        [
          [
            'name' => 'hero-b__--settings_layout',
            'operator' => '==',
            'value' => 'two-column'
          ]
        ]
      ]
    ]),

    acf_select([
      'label' => 'Right Column Vertical Alignment',
      'name' => 'hero-b__--settings_right-column-vertical-alignment',
      'key' => 'field_--settings_right_column_vertical_alignment',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,
      'wrapper' => array (
        'width' => '25',
      ),
      'default_value' => 'top',
      'choices' => [
        'top' => 'Top',
        'middle' => 'Middle'
      ]
  ])
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Hero: Concise',
    'name' => 'module__hero-b',
    'key' => 'group_module_hero-b',
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
