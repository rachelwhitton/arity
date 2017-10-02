<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'feature-solution__eyebrow',
      'key' => 'field_eyebrow',
      'instructions' => 'Text above the headline',
      'required' => 0, // @todo - Should be required but "Empower your drivers" breaks the rules
      'maxlength' => '',
      'wrapper' => array (
        'width' => '33',
      ),
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'feature-solution__headline',
      'key' => 'field_headline',
      'instructions' => '&nbsp;',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '33',
      ),
    ]),

    // Round Image
    acf_image([
      'label' => 'Image',
      'name' => 'feature-solution__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => '',
      'required' => 0,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '33',
      ),
    ]),

    // Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'feature-solution__body_copy',
      'key' => 'field_body_copy',
      'instructions' => '',
      'required' => 0,
      'new_lines' => 'wpautop',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Footer Copy
    acf_textarea([
      'label' => 'Footnote Copy',
      'name' => 'feature-solution__footnote_copy',
      'key' => 'field_footnote_copy',
      'instructions' => '',
      'required' => 0,
      'new_lines' => 'wpautop',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'feature-solution__cta',
      'key' => 'field_cta',
      'instructions' => '',
      'required' => 0,
      'wrapper' => array (
        'width' => '50',
      ),
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Feature Solution',
    'name' => 'component__feature-solution',
    'key' => 'group_component_feature-solution',
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
