<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Subhead
    acf_text([
      'label' => 'Subhead',
      'name' => 'vertical-card__subhead',
      'key' => 'field_subhead',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '33',
      ),
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'vertical-card__cta',
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
      'name' => 'vertical-card__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => '',
      'required' => 1,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '33',
      )
    ]),

    // Textarea
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'vertical-card__body_copy',
      'key' => 'field_body_copy',
      'instructions' => '',
      'required' => 1,
      'new_lines' => 'wpautop'
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Vertical Card',
    'name' => 'component__vertical-card',
    'key' => 'group_component_vertical-card',
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
