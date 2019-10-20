<?php
namespace App\Theme;

// ACF Fields
$fields = [

    acf_tab([
      'label' => 'Content',
      'name' => 'hero-f__content_tab',
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'hero-f__headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 100 <br/>(For homepage: limit characters to 60)',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    // Background video
    acf_file([
      'label' => 'Background Video',
      'name' => 'hero-f__background-video-url',
      'key' => 'field_hero-f_background-video-url',
      'instructions' => 'Videos should be short seamless sequences, 12:7 aspect ratio or close, accommodate title and subtitle overlay visibility, and have at least 1200x700 resolution. Optimize files to keep download sizes as small as possible',
      'required' => 0,
      'return_format' => 'url',
      'library' => 'all',
      'mime_types' => 'mp4,ogg,webm',
      'wrapper' => array(
        'width' => '100'
      ),
    ]),

    // Image
    acf_image([
      'label' => 'Video Backup Image',
      'name' => 'hero-f__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => 'Suggested image size: 1400 x 817 px',
      'required' => 0,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '50',
      )
    ]),

    // Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'hero-f__body_copy',
    'instructions' => 'Recommended character count max: 280',
      'required' => 1,
      'new_lines' => 'wpautop'
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'hero-f__cta',
      'instructions' => 'Recommended character count max: 30',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    acf_tab([
      'label' => 'Options',
      'name' => 'hero-f__options_tab',
    ]),

    acf_radio([
      'label' => 'Gradient Flood Background',
      'name' => 'hero-f__gradient-flood-active',
      'choices' => [
        '1' => 'Enabled (default)',
        '0' => 'Disabled'
      ],
      // 'return_format' => 'id',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Hero: Featured with video',
    'name' => 'module__hero-f',
    'key' => 'group_module_hero-f',
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
