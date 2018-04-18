<?php
namespace App\Theme;

// ACF Fields
$fields = [

  // Layout
  acf_select([
    'label' => 'Layout',
    'name' => 'cards-block-split__--settings_alignment',
    'key' => 'cards-block-split_--settings_alignment',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'allow_null' => 0,
    'ui' => 1,
    'default_value' => 'layout__full-bg',
    'choices' => [
      'layout__full-bg' => 'Full Background',
      'layout__half-bg' => 'Half and Half Background (Remove Padding)',
    ]
  ]),

  // Split Background Top
  acf_select([
    'label' => 'Background Color -- Top',
    'name' => 'cards-block-split__bg-color_top',
    'key' => 'field_bg-color_top',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'allow_null' => 0,
    'ui' => 1,
    'wrapper' => array (
      'width' => '50',
    ),
    'default_value' => 'White',
    'choices' => [
      'cards-block-split--white-bg' => 'White',
      'cards-block-split--light-gray-bg' => 'Light Gray',
      'cards-block-split--dark-blue-bg' => 'Dark Blue'
    ],
    'conditional_logic' => [
      [
        [
          'name' => 'cards-block-split__--settings_alignment',
          'operator' => '==',
          'value' => 'layout__half-bg'
        ]
      ]
    ]
  ]),

  // Split Background Top
  acf_select([
    'label' => 'Background Color -- Bottom',
    'name' => 'cards-block-split__bg-color_bot',
    'key' => 'field_bg-color_bot',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'allow_null' => 0,
    'ui' => 1,
    'wrapper' => array (
      'width' => '50',
    ),
    'default_value' => 'Light Gray',
    'choices' => [
      'split-bg__bottom--white-bg' => 'White',
      'split-bg__bottom--light-gray-bg' => 'Light Gray',
      'split-bg__bottom--dark-blue-bg' => 'Dark Blue'
    ],
    'conditional_logic' => [
      [
        [
          'name' => 'cards-block-split__--settings_alignment',
          'operator' => '==',
          'value' => 'layout__half-bg'
        ]
      ]
    ]
  ]),

  // Full Background Color
  acf_select([
    'label' => 'Background Color',
    'name' => 'cards-block-split__bg-color',
    'key' => 'field_bg-color',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'allow_null' => 0,
    'ui' => 1,
    'wrapper' => array (
      'width' => '50',
    ),
    'default_value' => 'cards-block-split--light-gray-bg',
    'choices' => [
      'cards-block-split--white-bg' => 'White',
      'cards-block-split--light-gray-bg' => 'Light Gray',
      'cards-block-split--dark-blue-bg' => 'Dark Blue'
    ],
    'conditional_logic' => [
      [
        [
          'name' => 'cards-block-split__--settings_alignment',
          'operator' => '==',
          'value' => 'layout__full-bg'
        ]
      ]
    ]
  ]),

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'cards-block-split__eyebrow',
      'key' => 'field_eyebrow',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '60',
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'cards-block-split__headline',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
    ]),

    // Text
    acf_wysiwyg([
      'label' => 'Subhead',
      'name' => 'cards-block-split__subhead',
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
      'name' => 'cards-block-split__cards',
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
    'name' => 'module__cards-block-split',
    'key' => 'group_module_cards-block-split',
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
