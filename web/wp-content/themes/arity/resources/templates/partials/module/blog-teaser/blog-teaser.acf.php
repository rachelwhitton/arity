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
        'width' => '50',
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
        'width' => '50',
      ),
    ]),
    // Select blog categories
    acf_taxonomy([
      'label' => 'Blog post categories',
      'name' => 'blog-teaser__categories',
      'key' => 'field_blog-teaser_categories',
      'instructions' => 'This module returns the three most recent posts in a selected category. Selecting more than one category returns posts that are tagged with all of the selected categories. If no categories are selected, this module dynamically returns one featured, and the two most recent, blog posts.',
      'taxonomy' => 'category',
      'field_type' => 'checkbox',
      'allow_null' => 1,
      'save_terms' => 0,
      'load_terms' => 0,
      'return_format' => 'id',
      'multiple' => 0,      
    ]),
    // Select blog custom taxonomies
    acf_taxonomy([
      'label' => 'Industry categories',
      'name' => 'blog-teaser__industry-categories',
      'key' => 'field_blog-teaser_industry-categories',
      'instructions' => 'Select an industry category to further filter the most recent posts returned by this module.',
      'taxonomy' => 'industries',
      'field_type' => 'checkbox',
    ]),
    // Headline
    // acf_message([
    //    'label' => '',//'Three Blog Promos',
    //   'name' => 'blog-teaser__message',
    //   'instructions' => 'By default, this module dynamically generates two most recent, and one featured blog post.',
    //   'message' => '',
    //   'wrapper' => array (
    //     'width' => '33',
    //   ),
    // ]),
    // Content
    acf_text([
      'label' => 'Content before link',
      'name' => 'blog-teaser__content',
      'key' => 'field_content',
      'instructions' => 'Recommended max character count: 42',
      'required' => 0,
      'maxlength' => ''
    ]),
    // Link
    acf_text([
      'label' => 'Link Copy',
      'name' => 'blog-teaser__link',
      'key' => 'field_link',
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
