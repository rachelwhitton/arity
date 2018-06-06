<?php
namespace App\Theme;

// ACF Fields
$fields = [

    acf_message([
      'label' => 'Headless Form Container',
      'name' => 'headless-form-container__form_placeholder',
      'key' => 'field_form_placeholder',
      'message' => '',
    ]),
    acf_flexible_content([
      'label' => '',
      'name' => 'headless-form-container__content',
      'key' => 'field_content',
      'instructions' => '',
      'required' => 0,
      'min' => 1,
      'max' => 1,
      'button_label'    => 'Add Form',
      'layouts' => [

        [
          'label' => 'Long Form',
          'name' => 'component__generic-form-long',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Long Form',
              'name' => 'component__generic-form-long',
              'key' => 'field_component_generic-form-long',
              'display' => 'seamless',
              'clone' => [
                  'group_component_generic-form-long'
              ]
            ]
          ]
        ],
        [
          'label' => 'Short Form',
          'name' => 'component__generic-form-short',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Short Form',
              'name' => 'component__generic-form-short',
              'key' => 'field_component_generic-form-short',
              'display' => 'seamless',
              'clone' => [
                  'group_component_generic-form-short'
              ]
            ]
          ]
        ],
        [
          'label' => 'Smart City Form',
          'name' => 'component__smart-city-form',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Smart City Form',
              'name' => 'component__smart-city-form',
              'key' => 'field_component_smart-city-form',
              'display' => 'seamless',
              'clone' => [
                  'group_component_smart-city-form'
              ]
            ]
          ]
        ],
        [
          'label' => 'Email Form',
          'name' => 'component__email-form',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Smart City Form',
              'name' => 'component__email-form',
              'key' => 'field_component_email-form',
              'display' => 'seamless',
              'clone' => [
                  'group_component_email-form'
              ]
            ]
          ]
        ],
        [
          'label' => 'Contact Us Form',
          'name' => 'component__form',
          'sub_fields' => [
            [
              'type' => 'clone',
              'label' => 'Contact Us Form',
              'name' => 'component__form',
              'key' => 'field_component_form',
              'display' => 'seamless',
              'clone' => [
                  'group_component_form'
              ]
            ]
          ]
        ]

      ]
    ])

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Headless Form Container',
    'name' => 'module__headless-form-container',
    'key' => 'group_module_headless-form-container',
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
