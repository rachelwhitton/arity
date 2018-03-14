<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'location-section__eyebrow',
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
      'name' => 'location-section__headline',
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
      'name' => 'location-section__image_id',
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
      'name' => 'location-section__body_copy',
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
      'name' => 'location-section__cta',
      'key' => 'field_cta',
      'instructions' => '',
      'required' => 0,
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    acf_select([
      'label' => 'Background Color',
      'name' => 'location-section__bkg_color',
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

     // Location Link
    acf_text([
      'label' => 'Location Link',
      'name' => 'location-section__location-link',
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
      'name' => 'location-section__location',
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
    'title' => 'Module - Location Section',
    'name' => 'module__location-section',
    'key' => 'group_module_location-section',
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
