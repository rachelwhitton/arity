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
      'instructions' => 'Recommended max character count: 42',
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
      'instructions' => 'Recommended max character count: 70',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '33',
      ),
    ]),

    // Headline
    acf_message([
       'label' => '',//'Three Blog Promos',
      'name' => 'blog-teaser__message',
      'instructions' => 'Dynamically generates two most recent, and one featured blog post.',
      'message' => '',
      'wrapper' => array (
        'width' => '33',
      ),
    ]),
    // Content
    acf_text([
      'label' => 'Content',
      'name' => 'blog-teaser__content',
      'key' => 'field_content',
      'instructions' => 'Recommended max character count: 42',
      'required' => 0,
      'maxlength' => ''
    ]),
    
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Block: Blog teaser',
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
