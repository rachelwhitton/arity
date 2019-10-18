<?php
namespace App\Theme;

// ACF Fields
$fields = [

    acf_tab([
      'label' => 'Content',
      'name' => 'hero-a__content_tab',
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'hero-a__headline',
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
      'name' => 'hero-a__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => 'Suggested image size: 890 x 890 px<br/>(For homepage: suggested Image size: 940 x 600 px<br/>Note: The copy will determine where the image is cut off. Make the image shorter or taller to achieve different effects.)',
      'required' => 0,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '50',
      )
    ]),
    // Background video
    acf_file([
      'label' => 'Background Video',
      'name' => 'hero-a__background-video',
      'key' => 'field_hero-a_background-video',
      'instructions' => 'Videos should be short seamless sequences, 12:7 aspect ratio or close, accommodate title and subtitle overlay visibility, and have at least 1200x700 resolution. Optimize files to keep download sizes as small as possible',
      'required' => 0,
      'return_format' => 'url',
      'library' => 'all',
      'mime_types' => 'mp4,ogg,webm',
      'wrapper' => array(
        'width' => '100'
      ),
    ]),
    // Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'hero-a__body_copy',
    'instructions' => 'Recommended character count max: 280',
      'required' => 1,
      'new_lines' => 'wpautop'
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'hero-a__cta',
      'instructions' => 'Recommended character count max: 30',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    acf_tab([
      'label' => 'Options',
      'name' => 'hero-a__options_tab',
    ]),

    acf_radio([
      'label' => 'Textured Dot Background',
      'name' => 'hero-a__dotted',
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
      'name' => 'hero-a__animation',
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
    'title' => 'Module - Hero: Elaborated',
    'name' => 'module__hero-a',
    'key' => 'group_module_hero-a',
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
