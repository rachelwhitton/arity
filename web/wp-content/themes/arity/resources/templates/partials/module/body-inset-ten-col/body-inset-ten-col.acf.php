<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Left Column
    acf_flexible_content([
      'label' => '',
      'name' => 'body-inset-ten-col__content',
      'key' => 'field_content',
      'instructions' => '',
      'required' => 0,
      'min' => 1,
      'button_label'    => 'Add Component',
      'layouts' => [

        [
          'label' => 'Text Block',
          'name' => 'component__text-block',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Text Block',
              'name' => 'component__text-block',
              'key' => 'field_component_text-block',
              'display' => 'seamless',
              'clone' => [
                  'group_component_text-block'
              ]
            ]
          ]
        ]

      ]
    ])

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Text: Standard',
    'name' => 'module__body-inset-ten-col',
    'key' => 'group_module_body-inset-ten-col',
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
