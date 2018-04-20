<?php
namespace App\Theme;

// ACF Fields
$fields = [

  // Layout
  acf_select([
    'label' => 'Layout',
    'name' => 'block-cards__--settings_alignment',
    'key' => 'block-cards_--settings_alignment',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'allow_null' => 0,
    'ui' => 1,
    'default_value' => 'layout__full-bg',
    'choices' => [
      'layout__full-bg' => 'Full Background',
      'layout__half-bg' => 'Split Background',
    ]
  ]),

  // Split Background Top
  acf_select([
    'label' => 'Background Color -- Top',
    'name' => 'block-cards__bg-color_top',
    'key' => 'field_bg-color_top',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'allow_null' => 0,
    'ui' => 1,
    'wrapper' => array (
      'width' => '50',
    ),
    'default_value' => 'block-cards--white-bg',
    'choices' => [
      'block-cards--white-bg' => 'White',
      'block-cards--light-gray-bg' => 'Light Gray',
      'block-cards--navy-bg' => 'Navy'
    ],
    'conditional_logic' => [
      [
        [
          'name' => 'block-cards__--settings_alignment',
          'operator' => '==',
          'value' => 'layout__half-bg'
        ]
      ]
    ]
  ]),

  // Split Background Top
  acf_select([
    'label' => 'Background Color -- Bottom',
    'name' => 'block-cards__bg-color_bot',
    'key' => 'field_bg-color_bot',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'allow_null' => 0,
    'ui' => 1,
    'wrapper' => array (
      'width' => '50',
    ),
    'default_value' => 'split-bg__bottom--light-gray-bg',
    'choices' => [
      'split-bg__bottom--white-bg' => 'White',
      'split-bg__bottom--light-gray-bg' => 'Light Gray',
      'split-bg__bottom--navy-bg' => 'Navy'
    ],
    'conditional_logic' => [
      [
        [
          'name' => 'block-cards__--settings_alignment',
          'operator' => '==',
          'value' => 'layout__half-bg'
        ]
      ]
    ]
  ]),

  // Full Background Color
  acf_select([
    'label' => 'Background Color',
    'name' => 'block-cards__bg-color',
    'key' => 'field_bg-color',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'allow_null' => 0,
    'ui' => 1,
    'wrapper' => array (
      'width' => '50',
    ),
    'default_value' => 'block-cards--light-gray-bg',
    'choices' => [
      'block-cards--white-bg' => 'White',
      'block-cards--light-gray-bg' => 'Light Gray',
      'block-cards--navy-bg' => 'Navy'
    ],
    'conditional_logic' => [
      [
        [
          'name' => 'block-cards__--settings_alignment',
          'operator' => '==',
          'value' => 'layout__full-bg'
        ]
      ]
    ]
  ]),

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'block-cards__eyebrow',
      'key' => 'field_eyebrow',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '60',
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'block-cards__headline',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
    ]),

    // Text
    acf_wysiwyg([
      'label' => 'Subhead',
      'name' => 'block-cards__subhead',
      'key' => 'field_subhead',
      'instructions' => '',
      'toolbar' => 'center',
      'media_upload' => 0,
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Vertical Card
    acf_repeater([
      'label' => '',
      'name' => 'block-cards__cards',
      'sub_fields' => [
        [
          // Headline
          'type' => 'clone',
          'label' => 'Card',
          'name' => 'component__card',
          'display' => 'group',
          'clone' => [
              'group_component_card'
          ]
        ]
      ],
      'min'         => 2,
      'max'         => 8,
      'layout'      => 'block',
            'button_label'  => 'Add Card',
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Block: Cards',
    'name' => 'module__block-cards',
    'key' => 'group_module_block-cards',
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
