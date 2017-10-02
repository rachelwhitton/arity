<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Subhead
    acf_text([
      'label' => 'Subhead',
      'name' => 'horizontal-card__subhead',
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
      'name' => 'horizontal-card__cta',
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
      'name' => 'horizontal-card__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => '',
      'required' => 0,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '33',
      )
    ]),

    // Textarea
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'horizontal-card__body_copy',
      'key' => 'field_body_copy',
      'instructions' => '',
      'required' => 1,
      'new_lines' => 'wpautop'
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Horizontal Card',
    'name' => 'component__horizontal-card',
    'key' => 'group_component_horizontal-card',
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
