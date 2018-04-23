<?php
namespace App\Theme;

// ACF Fields
$fields = [

    acf_tab([
      'label' => 'Content',
      'name' => 'content-image-block__content_tab',
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'content-image-block__headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 60',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    // Round Image
    acf_image([
      'label' => 'Image',
      'name' => 'content-image-block__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => 'Suggested image size: 1444 x 780 px ',
      'required' => 1,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    // Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'content-image-block__body_copy',
      'key' => 'field_body_copy',
      'instructions' => 'Recommended character count max: 300',
      'required' => 1,
      'new_lines' => 'wpautop',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'content-image-block__cta',
      'key' => 'field_cta',
      'instructions' => 'Recommended character count max: 80',
      'required' => 0,
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    acf_tab([
      'label' => 'Options',
      'name' => 'content-image-block__options_tab',
    ]),

    acf_select([
      'label' => 'Layout',
      'name' => 'content-image-block__layout',
      'key' => 'field_layout',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 1,
      'ui' => 1,
      'wrapper' => array (
        'width' => '25',
      ),
      'choices' => [
        'left' => 'Image Left, Content Right',
        'right' => 'Image Right, Content Left'
      ]
    ]),

    acf_select([
      'label' => 'Background Color',
      'name' => 'content-image-block__bkg_color',
      'key' => 'field_bkg_color',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 1,
      'ui' => 1,
      'wrapper' => array (
        'width' => '25',
      ),
      'choices' => [
        'white' => 'White',
        'lightgray' => 'Light Gray'
      ]
    ]),

    // Headline
    acf_text([
      'label' => '"Module" Headline',
      'name' => 'content-image-block__module-headline',
      'key' => 'field_module-headline',
      'instructions' => 'Recommended character count max: 100',
      'required' => 0,
      'maxlength' => '',
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Block: 2 column',
    'name' => 'module__content-image-block',
    'key' => 'group_module_content-image-block',
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
