<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'horizontal-card-location__eyebrow',
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
      'name' => 'horizontal-card-location__headline',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
    ]),

    // Textarea
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'horizontal-card-location__body-copy',
      'key' => 'field_body_copy',
      'instructions' => '',
      'required' => 0,
      'new_lines' => 'wpautop'
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'horizontal-card-location__cta',
      'key' => 'field_cta',
      'instructions' => '',
      'required' => 1,
      'wrapper' => array (
        'width' => '25',
      ),
    ]),


    // Image
    acf_image([
      'label' => 'Image',
      'name' => 'horizontal-card-location__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => '',
      'required' => 0,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '25',
      )
    ]),

    // Split Background Top
    acf_select([
      'label' => 'Background Color -- Top',
      'name' => 'horizontal-card-location__bg-color_top',
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
      'name' => 'horizontal-card-location__bg-color_bot',
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

    // Location Link
    acf_text([
      'label' => 'Location Link',
      'name' => 'horizontal-card-location__link',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      )
    ]),

    // Location Link
    acf_text([
      'label' => 'Location Text',
      'name' => 'horizontal-card-location__location',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      )
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Horizontal Card Location',
    'name' => 'module__horizontal-card-location',
    'key' => 'group_module_horizontal-card-location',
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
