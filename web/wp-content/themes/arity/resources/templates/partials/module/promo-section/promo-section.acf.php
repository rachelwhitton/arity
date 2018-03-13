<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'promo-section__eyebrow',
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
      'name' => 'promo-section__headline',
      'key' => 'field_headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    // Round Image
    acf_image([
      'label' => 'Image',
      'name' => 'promo-section__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => '',
      'required' => 1,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    // Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'promo-section__body_copy',
      'key' => 'field_body_copy',
      'instructions' => '',
      'required' => 1,
      'new_lines' => 'wpautop',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'promo-section__cta',
      'key' => 'field_cta',
      'instructions' => '',
      'required' => 0,
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    acf_select([
      'label' => 'Background Color',
      'name' => 'promo-section__bkg_color',
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
        'bg-white' => 'White',
        'bg-gray' => 'Light Gray',
        'bg-darkblue' => 'Dark Blue'
      ]
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Promo Section',
    'name' => 'module__promo-section',
    'key' => 'group_module_promo-section',
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
