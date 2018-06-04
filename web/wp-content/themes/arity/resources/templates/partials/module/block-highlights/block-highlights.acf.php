<?php
namespace App\Theme;

// ACF Fields
$fields = [
    // Full Background Color
    acf_select([
      'label' => 'Background Color',
      'name' => 'block-highlights__bg-color',
      'key' => 'field_bg-color',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,
      'default_value' => 'block-highlights--white-bg',
      'choices' => [
        'block-highlights--white-bg' => 'White',
        'block-highlights--light-gray-bg' => 'Light Gray',
        'block-highlights--navy-bg' => 'Navy'
      ]
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'block-highlights__headline',
      'instructions' => 'Recommended character count max: 100',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      )
    ]),

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'block-highlights__eyebrow',
      'key' => 'field_eyebrow',
      'instructions' => 'Recommended character count max: 42',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      )
    ]),

    // Text
    acf_wysiwyg([
      'label' => 'Subhead',
      'name' => 'block-highlights__subhead',
      'key' => 'field_subhead',
      'instructions' => 'Recommended character count max: 210',
      'toolbar' => 'basic',
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
      'name' => 'block-highlights__highlight-block',
      'sub_fields' => [
        [
          // Headline
          'type' => 'clone',
          'label' => 'Card',
          'name' => 'component__highlight-block',
          'display' => 'group',
          'clone' => [
              'group_component_highlight-block'
          ]
        ]
      ],
      'min'         => 2,
      'max'         => 8,
      'layout'      => 'block',
      'button_label'  => 'Add Highlight',
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Block: Highlights',
    'name' => 'module__block-highlights',
    'key' => 'group_module_block-highlights',
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
