<?php
namespace App\Theme;

// ACF Fields
$fields = [

    acf_tab([
      'label' => 'Content',
      'name' => 'image-full-width__content_tab',
    ]),

    // Layout
    acf_select([
      'label' => 'Media type',
      'name' => 'image-full-width__content-chooser',
      'key' => 'image-full-width_content-chooser',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,
      'default_value' => 'layout__image',
      'choices' => [
        'layout__image' => 'Image'
      ]
    ]),

    // Image
    acf_image([
      'label' => 'Image',
      'name' => 'image-full-width__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => 'Suggested image size: 1144 x 780 px ',
      'required' => 1,
      'preview_size'  => 'thumbnail',
      'conditional_logic' => [
        [
          [
            'name' => 'image-full-width__content-chooser',
            'operator' => '==',
            'value' => 'layout__image'
          ]
        ]
      ],
      'wrapper' => array (
        'width' => '25',
      ),
    ]),

    // Images has shadow?
    acf_radio([
      'label' => 'Image Shadow',
      'name' => 'image-full-width__shadow',
      'instructions' => '',
      'default_value' => '1',
      'choices' => [
        '1' => 'Enabled (default)',
        '0' => 'Disabled'
      ],
      // 'return_format' => 'id',
      'wrapper' => array (
        'width' => '25',
      ),
      'conditional_logic' => [
        [
          [
            'name' => 'image-full-width__content-chooser',
            'operator' => '==',
            'value' => 'layout__image'
          ]
        ]
      ],
    ]),

    acf_tab([
      'label' => 'Options',
      'name' => 'image-full-width__options_tab',
    ]),

    acf_select([
      'label' => 'Layout',
      'name' => 'image-full-width__layout',
      'key' => 'field_layout',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 1,
      'ui' => 1,
      'wrapper' => array (
        'width' => '25',
      ),
      'default_value' => 'right',
      'choices' => [
        'left' => 'Image Left, Content Right',
        'right' => 'Image Right, Content Left'
      ]
    ]),

    acf_select([
      'label' => 'Background Color',
      'name' => 'image-full-width__bkg_color',
      'key' => 'field_bkg_color',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 1,
      'ui' => 1,
      'wrapper' => array (
        'width' => '25',
      ),
      'default_value' => 'white',
      'choices' => [
        'white' => 'White',
        'lightgray' => 'Light Gray',
        'navy' => 'Navy'
      ]
    ]),

    acf_select([
      'label' => '"Module" Headline Alignment',
      'name' => 'image-full-width__headline-alignment',
      'key' => 'field_headline-alignment',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 1,
      'ui' => 1,
      'wrapper' => array (
        'width' => '25',
      ),
      'default_value' => 'center',
      'choices' => [
        'left' => 'Left',
        'center' => 'Centered'
      ]
    ]),

    // Headline
    acf_text([
      'label' => '"Module" Headline',
      'name' => 'image-full-width__module-headline',
      'key' => 'field_module-headline',
      'instructions' => 'Recommended character count max: 100',
      'required' => 0,
      'maxlength' => '',
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Image Full Width',
    'name' => 'module__image-full-width',
    'key' => 'group_module_image-full-width',
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
