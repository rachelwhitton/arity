<?php
namespace App\Theme;

// ACF Fields
$fields = [
    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'action-bar-map__headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 70',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'action-bar-map__eyebrow',
      'key' => 'field_eyebrow',
      'instructions' => 'Recommended character count max: 42',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      )
    ]),

    // Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'action-bar-map__body_copy',
      'key' => 'field_body_copy',
      'instructions' => 'Recommended character count max: 200',
      'required' => 1,
      'new_lines' => 'wpautop',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'action-bar-map__cta',
      'key' => 'field_cta',
      'instructions' => 'Recommended character count max: 30',
      'required' => 0,
      'wrapper' => array (
        'width' => '33',
      ),
    ]),

    // Round Image
    acf_image([
      'label' => 'Image',
      'name' => 'action-bar-map__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => '',
      'required' => 1,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '33',
      ),
    ]),

    acf_select([
      'label' => 'Background Color',
      'name' => 'action-bar-map__bkg_color',
      'key' => 'field_bkg_color',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 1,
      'ui' => 1,
      'wrapper' => array (
        'width' => '33',
      ),
      'default_value' => 'bg-gray',
      'choices' => [
        'bg-white' => 'White',
        'bg-gray' => 'Light Gray',
        'bg-darkblue' => 'Navy'
      ]
    ]),

     // Location Link
    acf_text([
      'label' => 'Location Link',
      'name' => 'action-bar-map__location-link',
      'instructions' => 'Use a Google Maps link.',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      )
    ]),

    // Location Link
    acf_text([
      'label' => 'Location Text',
      'name' => 'action-bar-map__location',
      'instructions' => 'Use &lt;br/&gt; to insert line breaks in the address.',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      )
    ]),


];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Action Bar: Contact, map',
    'name' => 'module__action-bar-map',
    'key' => 'group_module_action-bar-map',
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
