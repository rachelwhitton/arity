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
      'instructions' => 'Recommended image size: 2400 x 940 px',
      'required' => 1,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '50',
      )
    ]),

    acf_radio([
      'label' => 'Dot Dash Overlay',
      'name' => 'hero-b__dotted',
      'instructions' => '',
      'choices' => [
        '1' => 'Enabled (default)',
        '0' => 'Disabled'
      ],
      // 'return_format' => 'id',
      'wrapper' => array (
        'width' => '50',
      ),
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
      // 'wrapper' => array (
      //   'width' => '50',
      // ),
      'default_value' => 'one-column',
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
      'instructions' => 'Recommended character count max: 54',
      'required' => 1,
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
      'instructions' => 'Recommended character count max: 330',
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

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'hero-b__cta',
      'instructions' => 'Recommended character count max: 30',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
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
      'instructions' => 'Recommended character count max: 54',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Left Column Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'hero-b__left_column_body_copy',
      'instructions' => 'Recommended character count max: 280',
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
      'instructions' => 'Recommended character count max: 100',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '66',
      ),
    ]),

    acf_select([
      'label' => 'Right Column Vertical Alignment',
      'name' => 'hero-b__--settings_right-column-vertical-alignment',
      'key' => 'field_--settings_right_column_vertical_alignment',
      'instructions' => '&nbsp;',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,
      'wrapper' => array (
        'width' => '33',
      ),
      'default_value' => 'top',
      'choices' => [
        'top' => 'Top (default)',
        'middle' => 'Middle'
      ]
  ]),

    // Right Column CTA Repeater
    acf_repeater([
      'label' => '',
      'name' => 'hero-b__right_column_links',
      'instructions' => 'If using more than one CTA, try to use similar character counts to prevent odd button sizing.',
      'sub_fields' => [
        [
          // Headline
          'type' => 'link',
          'label' => 'CTA Button',
          'name' => 'link',
          'instructions' => 'Recommended character count max: 30',
          'required' => 0,
          'maxlength' => ''
        ]
      ],
      'min'         => 1,
      'max'         => 2,
      'layout'      => 'block',
      'button_label'  => 'Add Link',
    ]),
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
