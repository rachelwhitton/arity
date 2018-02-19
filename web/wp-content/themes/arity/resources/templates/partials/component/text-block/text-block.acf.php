<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Layout
    acf_select([
      'label' => 'Layout',
      'name' => 'text-block__--settings_alignment',
      'key' => 'text-block_--settings_alignment',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,

      'wrapper' => array (
        'width' => '50',
      ),
      'default_value' => 'layout__left-align',
      'choices' => [
        'layout__left-align' => 'Left Align',
        'layout__center-align' => 'Center Align',
      ]
    ]),

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'text-block__eyebrow',
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
      'name' => 'text-block__headline',
      'key' => 'field_headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '66',
      )
    ]),

    // Headline Size
    acf_select([
      'label' => 'Headline Size',
      'name' => 'text-block__h-size',
      'key' => 'text-block_h-size',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,

      'wrapper' => array (
        'width' => '33',
      ),
      'default_value' => 'h1',
      'choices' => [
        'h2' => 'Large (h2)',
        'h3' => 'Medium (h3)',
      ]
    ]),

    // Text
    acf_wysiwyg([
      'label' => 'Content',
      'name' => 'text-block__content',
      'key' => 'field_content',
      'instructions' => '',
      'toolbar' => 'simple',
      'media_upload' => 0,
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ), 
      'conditional_logic' => [
        [
          [
            'name' => 'text-block__--settings_alignment',
            'operator' => '==',
            'value' => 'layout__left-align'
          ]
        ]
      ]
    ]),

    // Text
    acf_wysiwyg([
      'label' => 'Content',
      'name' => 'text-block__content-center',
      'key' => 'field_content-center',
      'instructions' => '',
      'toolbar' => 'center',
      'media_upload' => 0,
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ), 
      'conditional_logic' => [
        [
          [
            'name' => 'text-block__--settings_alignment',
            'operator' => '==',
            'value' => 'layout__center-align'
          ]
        ]
      ]
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Text Block',
    'name' => 'component__text-block',
    'key' => 'group_component_text-block',
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
