<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'horizontal-card-split__eyebrow',
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
      'name' => 'horizontal-card-split__headline',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
    ]),

    // Textarea
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'horizontal-card-split__body-copy',
      'key' => 'field_body_copy',
      'instructions' => '',
      'required' => 0,
      'new_lines' => 'wpautop'
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'horizontal-card-split__cta',
      'key' => 'field_cta',
      'instructions' => '',
      'required' => 1,
      'wrapper' => array (
        'width' => '33',
      ),
    ]),

    // Image
    acf_image([
      'label' => 'Image',
      'name' => 'horizontal-card-split__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => '',
      'required' => 0,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '33',
      )
    ]),


    // Split Background Top
    acf_select([
      'label' => 'Background Color -- Top',
      'name' => 'horizontal-card-split__bg-color_top',
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
      'name' => 'horizontal-card-split__bg-color_bot',
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
    'title' => 'Module - Horizontal Card Split',
    'name' => 'module__horizontal-card-split',
    'key' => 'group_module_horizontal-card-split',
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
