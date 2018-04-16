<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Headline
    acf_text([
        'label' => 'Headline',
        'name' => 'email-form__headline',
        'key' => 'field_headline',
        'instructions' => '',
        'required' => 1,
        'maxlength' => '',
        'wrapper' => array (
        'width' => '100',
        ),
    ]),

    // Content
    acf_wysiwyg([
        'label' => 'Content',
        'name' => 'email-form__content',
        'key' => 'field_content',
        'instructions' => '',
        'required' => 0,
        'maxlength' => '',
        'wrapper' => array (
        'width' => '100',
        ),
    ]),

    acf_tab([
        'label' => 'Options',
        'name' => 'email-form__options_tab',
      ]),

      acf_select([
        'label' => 'Background Color',
        'name' => 'email-form__bkg_color',
        'key' => 'field_bkg_color',
        'instructions' => '',
        'required' => 0,
        'maxlength' => '',
        'allow_null' => 1,
        'ui' => 1,
        'wrapper' => array (
          'width' => '25',
        ),
        'default_value' => 'white',
        'choices' => [
          'white' => 'White Background',
          'blue' => 'Blue Background'
        ]
    ])

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Form :: Email ',
    'name' => 'module__email-form',
    'key' => 'group_module_email-form',
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
