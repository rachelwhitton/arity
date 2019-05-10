<?php
namespace App\Theme;

// ACF Fields
$fields = [
    // Background color
    acf_select([
      'label' => 'Background color',
      'name' => 'body-inset-ten-col__background-color',
      'key' => 'field_background-color',
      'required' => 0,
      'allow_null' => 0,
      'ui' => 1,
      'default_value' => 'white',
      'choices' => [
        'white' => 'White',
        'light-gray' => 'Light gray'
      ]
    ]),

    // Add Component block
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
