<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'icon-two-column__headline',
      'key' => 'field_headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    acf_tab([
      'label' => 'Left Column',
      'name' => 'icon-two-column__left_column_tab',
    ]),

    // Left Column
    acf_flexible_content([
      'label' => '',
      'name' => 'icon-two-column__left_column',
      'key' => 'field_left_column',
      'instructions' => '',
      'required' => 0,
      'button_label'    => 'Add Component',
      'layouts' => [
        [
          'label' => 'Icon Only Stack',
          'name' => 'component__icon-only-stack',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Icon Only Stack',
              'name' => 'component__icon-only-stack',
              'key' => 'field_component_icon-only-stack',
              'display' => 'seamless',
              'clone' => [
                  'group_component_icon-only-stack'
              ]
            ]
          ]
        ]
      ]
    ])

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Icon Two Column',
    'name' => 'module__icon-two-column',
    'key' => 'group_module_icon-two-column',
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
