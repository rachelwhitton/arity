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
      'name' => 'hero-a__headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 100 <br/><br/>HOMEPAGE: limit characters to 60',
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
      'instructions' => 'Suggested image size: 890 x 890 px<br/><br/>HOMEPAGE: Suggested Image size: 940 x 600* px<br/>*The copy will determine where the image is cut off. Make the image shorter or taller to achieve different effects.',
      'required' => 0,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '50',
      )
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
      'name' => 'content-image-block__options_tab',
    ]),

    acf_radio([
      'label' => 'Textured Dot Background',
      'name' => 'hero-a__dotted',
      'instructions' => '(Disabling only works when you have added an image to the hero.)',
      'choices' => [
        '1' => 'Enabled (default)',
        '0' => 'Disabled'
      ],
      // 'return_format' => 'id',
      'wrapper' => array (
        'width' => '50',
      ),
    ]),

    acf_checkbox([
      'label' => 'Homepage Animation',
      'name' => 'hero-a__animation',
      'instructions' => 'Do you want the Arity branding animated on the homepage? <br/> (This will replace the static image with animated dots and dashes.)',
      'choices' => [
        '1' => 'Yes'
      ],
      'return_format' => 'id',
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
