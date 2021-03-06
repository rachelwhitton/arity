<?php
namespace App\Theme;

// ACF Fields
$fields = [

    acf_tab([
      'label' => 'Content',
      'name' => 'hero-e__content_tab',
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'hero-e__headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 100 <br/>(For homepage: limit characters to 60)',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    // Image
    acf_image([
      'label' => 'Image',
      'name' => 'hero-e__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => 'Suggested image size: 890 x 890 px<br/>(For homepage: suggested Image size: 940 x 600 px<br/>Note: The copy will determine where the image is cut off. Make the image shorter or taller to achieve different effects.)',
      'required' => 0,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '50',
      )
    ]),

    // Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'hero-e__body_copy',
    'instructions' => 'Recommended character count max: 280',
      'required' => 1,
      'new_lines' => 'wpautop'
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'hero-e__cta',
      'instructions' => 'Recommended character count max: 30',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    acf_link([
      'label' => 'CTA Button 2',
      'name' => 'hero-e__cta-2',
      'instructions' => 'Recommended character count max: 30',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    acf_tab([
      'label' => 'Options',
      'name' => 'hero-e__options_tab',
    ]),

    acf_radio([
      'label' => 'Textured Dot Background',
      'name' => 'hero-e__dotted',
      'instructions' => '(Does not apply to homepage or when no image is selected)',
      'choices' => [
        '1' => 'Enabled (default)',
        '0' => 'Disabled'
      ],
      // 'return_format' => 'id',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    acf_radio([
      'label' => 'Animation (Homepage only)',
      'name' => 'hero-e__animation',
      'instructions' => '(This will replace the static image with animated dots and dashes)',
      'default_value' => '0',
      'choices' => [
        '1' => 'Enabled',
        '0' => 'Disabled (default)'
      ],
      // 'return_format' => 'id',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Hero: Elaborated: Half-half with CTAs',
    'name' => 'module__hero-e',
    'key' => 'group_module_hero-e',
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
