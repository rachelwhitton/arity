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
      'instructions' => 'Suggested image size: 192 x 192px',
      'required' => 1,
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
      'instructions' => 'Recommended max character count: 45<br/> Ideally this would wrap no more than twice on any device.',
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
      'instructions' => 'Recommended max character count: 140<br/> Because copy here is center-aligned, try to keep it as short as possible.',
      'maxlength' => 190,
      'required' => 0,
      'new_lines' => 'wpautop'
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'highlight-block__cta',
      'key' => 'field_cta',
      'instructions' => '',
      'required' => 0
    ]),
    acf_select([
      'label' => 'CTA Icon',
      'name' => 'highlight-block__cta-icon',
      'key' => 'field_cta-icon',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,
      'default_value' => 'arrow-right',
      'choices' => [
        'arrow-right' => 'Link',
        'download' => 'Download',
        'external' => 'External'
      ]
    ])
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
