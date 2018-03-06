<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'highlights__eyebrow',
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
      'name' => 'highlights__headline',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
    ]),

    // Text
    acf_wysiwyg([
      'label' => 'Subhead',
      'name' => 'highlights__subhead',
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
      'name' => 'highlights__highlight-block',
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
    'title' => 'Module - Highlights',
    'name' => 'module__highlights',
    'key' => 'group_module_highlights',
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
