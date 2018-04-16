<?php
namespace App\Theme;

// ACF Fields
$fields = [

    acf_tab([
      'label' => 'Content',
      'name' => 'contact-form-w-cta__content_tab',
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'contact-form-w-cta__headline',
      'key' => 'field_headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    acf_tab([
      'label' => 'Left Column',
      'name' => 'contact-form-w-cta__left_column_tab',
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'contact-form-w-cta__left_column_headline',
      'key' => 'field_left_column_headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    acf_message([
      'label' => 'Contact Form',
      'name' => 'contact-form-w-cta__left_column_form_placeholder',
      'key' => 'field_left_column_form_placeholder',
      'message' => '',
    ]),

    acf_tab([
      'label' => 'Right Column',
      'name' => 'contact-form-w-cta__right_column_tab',
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'contact-form-w-cta__right_column_headline',
      'key' => 'field_right_column_headline',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    // Round Image
    acf_image([
      'label' => 'Round Image',
      'name' => 'contact-form-w-cta__right_column_image_id',
      'key' => 'field_right_column_image',
      'return_format' => 'id',
      'instructions' => '',
      'required' => 0,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    // Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'contact-form-w-cta__right_column_body_copy',
      'key' => 'field_right_column_body_copy',
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
      'name' => 'contact-form-w-cta__right_column_cta',
      'key' => 'field_right_column_cta',
      'instructions' => '',
      'required' => 0,
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    acf_tab([
      'label' => 'Options',
      'name' => 'contact-form-w-cta__options_tab',
    ]),

    acf_select([
      'label' => 'Color Theme',
      'name' => 'color_theme',
      'key' => 'field_color_theme',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,
      'wrapper' => array (
        'width' => '50',
      ),
      'default_value' => 'light',
      'choices' => [
        'light' => 'Light',
        'dark' => 'Dark'
      ]
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Form :: Contact w/ CTA',
    'name' => 'module__contact-form-w-cta',
    'key' => 'group_module_contact-form-w-cta',
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
