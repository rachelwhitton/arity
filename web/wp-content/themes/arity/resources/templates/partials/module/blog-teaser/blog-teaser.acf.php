<?php
namespace App\Theme;

global $acf_blog_category;

// ACF Fields
$fields = [
    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'blog-teaser__eyebrow',
      'key' => 'field_eyebrow',
      'instructions' => 'Text above the headline',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '33',
      ),
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'blog-teaser__headline',
      'key' => 'field_headline',
      'instructions' => '&nbsp;',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '33',
      ),
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Blog Teaser',
    'name' => 'module__blog-teaser',
    'key' => 'group_module_blog-teaser',
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
