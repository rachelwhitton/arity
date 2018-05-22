<?php
namespace App\Theme;

global $acf_blog_category;

// ACF Fields
$fields = [
    acf_select([
      'label' => 'Category',
      'name' => 'blog-promo__term',
      'instructions' => '',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '33',
      ),
      'allow_null' => 0,
      'ui' => 1,
      'choices' => $acf_blog_category
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Blog Promo',
    'name' => 'module__blog-promo',
    'key' => 'group_module_blog-promo',
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
