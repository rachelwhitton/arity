<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Image
    acf_image([
      'label' => 'Image',
      'name' => 'highlight-block__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => '',
      'required' => 0,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '33',
      )
    ]),

    // Subhead
    acf_text([
      'label' => 'Subhead',
      'name' => 'highlight-block__subhead',
      'key' => 'field_subhead',
      'instructions' => '',
      'required' => 1,
      'maxlength' => 70,
      'wrapper' => array (
        'width' => '33',
      ),
    ]),

    // Textarea
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'highlight-block__body_copy',
      'key' => 'field_body_copy',
      'instructions' => '',
      'maxlength' => 190,
      'required' => 0,
      'new_lines' => 'wpautop'
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Highlight Block',
    'name' => 'component__highlight-block',
    'key' => 'group_component_highlight-block',
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
