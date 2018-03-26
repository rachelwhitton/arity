<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'cards-block-split__eyebrow',
      'key' => 'field_eyebrow',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      )
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'cards-block-split__headline',
      'instructions' => '',
      'required' => 0,
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
      'required' => 1,
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
        'width' => '25',
      ),
      'default_value' => 'white',
      'choices' => [
        '#FFFFFF' => 'White',
        '#F7F7F7' => 'Light Gray',
        '#011C2C' => 'Dark Blue'
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
        'width' => '25',
      ),
      'default_value' => 'white',
      'choices' => [
        '#FFFFFF' => 'White',
        '#F7F7F7' => 'Light Gray',
        '#011C2C' => 'Dark Blue'
      ]
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Cards Block Split',
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
