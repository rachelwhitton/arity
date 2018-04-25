<?php
namespace App\Theme;

// ACF Fields
$fields = [
    acf_tab([
      'label' => 'Content',
      'name' => 'vertical-cards-block__content_tab',
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'vertical-cards-block__headline',
      'instructions' => 'Recommended max character count: 70',
      'required' => 0,
      'maxlength' => '',
    ]),

    // Vertical Card
    acf_repeater([
      'label' => '',
      'name' => 'vertical-cards-block__cards',
      'sub_fields' => [
        [
          // Headline
          'type' => 'clone',
          'label' => 'Vertical Card',
          'name' => 'component__vertical-card',
          'display' => 'group',
          'clone' => [
              'group_component_vertical-card'
          ]
        ]
      ],
      'min'         => 2,
      'max'         => 10,
      'layout'      => 'block',
            'button_label'  => 'Add Vertical Card',
    ]),

    acf_tab([
      'label' => 'Options',
      'name' => 'vertical-cards-block__options_tab',
    ]),

    // Full Background Color
    acf_select([
      'label' => 'Background Color',
      'name' => 'vertical-cards-block__bg-color',
      'key' => 'field_bg-color',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,
      'default_value' => 'vertical-cards-block--light-gray-bg',
      'choices' => [
        'vertical-cards-block--white-bg' => 'White',
        'vertical-cards-block--light-gray-bg' => 'Light Gray',
        'vertical-cards-block--navy-bg' => 'Navy'
      ]
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Block: Cards: Image',
    'name' => 'module__vertical-cards-block',
    'key' => 'group_module_vertical-cards-block',
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
