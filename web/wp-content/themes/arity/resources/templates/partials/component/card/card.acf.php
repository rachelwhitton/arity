<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Subhead
    acf_text([
      'label' => 'Subhead',
      'name' => 'card__subhead',
      'key' => 'field_subhead',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '33',
      ),
    ]),

    // Textarea
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'card__body_copy',
      'key' => 'field_body_copy',
      'instructions' => '',
      'required' => 1,
      'new_lines' => 'wpautop'
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'card__cta',
      'key' => 'field_cta',
      'instructions' => '',
      'required' => 0,
      'wrapper' => array (
        'width' => '33',
      ),
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Card',
    'name' => 'component__card',
    'key' => 'group_component_card',
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
