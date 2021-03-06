<?php
namespace App\Theme;

global $acf_choices_icon;

// ACF Fields
$fields = [

    acf_select([
      'label' => 'Icon',
      'name' => 'text-w-icon__icon',
      'key' => 'field_icon',
      'instructions' => 'Select an icon from the dropdown',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
      'allow_null' => 1,
      'ui' => 1,
      'choices' => $acf_choices_icon
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'text-w-icon__headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 56',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    // Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'text-w-icon__body_copy',
      'key' => 'field_body_copy',
      'instructions' => 'Recommended character count max: 240',
      'required' => 1,
      'new_lines' => 'wpautop',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Text w/ Icon',
    'name' => 'component__text-w-icon',
    'key' => 'group_component_text-w-icon',
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
