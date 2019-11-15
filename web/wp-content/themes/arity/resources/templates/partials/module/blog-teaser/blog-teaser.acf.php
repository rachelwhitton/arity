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
    // Headline
    acf_message([
      'label' => 'Taxonomy Selector',
      'name' => 'blog-teaser__message',
      'instructions' => '',
      'message' => 'By default, this module dynamically returns one featured, and the two most recent, blog posts. Select categories and industries to filter the generated posts.',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),
    // Select blog categories
    acf_taxonomy([
      'label' => 'Categories',
      'name' => 'blog-teaser__categories',
      'key' => 'field_blog-teaser_categories',
      'instructions' => 'Selecting a category returns the most recent posts in that category. Selecting more than one category returns posts that are tagged with all of the selected categories.',
      'taxonomy' => 'category',
      'field_type' => 'checkbox',
      'allow_null' => 1,
      'save_terms' => 0,
      'load_terms' => 0,
      'return_format' => 'id',
      'multiple' => 0,
      'wrapper' => array(
        'width' => '50',
      ),
    ]),
    // Select blog industries
    acf_taxonomy([
      'label' => 'Industries',
      'name' => 'blog-teaser__industries',
      'key' => 'field_blog-teaser_industries',
      'instructions' => 'Select industries to further filter the most recent posts returned by this module. Filtering will not occur if no industries are selected.',
      'taxonomy' => 'industry',
      'field_type' => 'checkbox',
      'allow_null' => 1,
      'save_terms' => 0,
      'load_terms' => 0,
      'return_format' => 'id',
      'multiple' => 0,
      'wrapper' => array(
        'width' => '50',
      ),
    ]),
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
