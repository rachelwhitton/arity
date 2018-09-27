<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'block-two-col-repeater__eyebrow',
      'key' => 'field_eyebrow',
      'instructions' => 'Recommended character count max: 42',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Headline
    acf_text([
      'label' => 'Main Headline',
      'name' => 'block-two-col-repeater__main_headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 60',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Body Copy
    acf_textarea([
      'label' => 'Subhead',
      'name' => 'block-two-col-repeater__subhead',
      'key' => 'field_body_copy',
      'instructions' => 'Recommended character count max: 150',
      'required' => 1,
      'new_lines' => 'wpautop',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Repeater: Block Two Column Components
    acf_repeater([
      'label' => '',
      'name' => 'block-two-col-repeater__blocks',
      'sub_fields' => [
        [
          'type' => 'clone',
          'label' => '2 Column Block',
          'name' => 'component__block-two-col-component',
          'display' => 'group',
          'clone' => [
            'group-component-block-two-col-component'
          ]
        ]
      ],
      'min'          => 1,
      'max'          => 100,
      'layout'       => 'block',
      'button_label' => 'Add 2 Column Block',
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Block: 2 column repeater',
    'name' => 'module__block-two-col-repeater',
    'key' => 'group_module_block-two-col-repeater',
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
