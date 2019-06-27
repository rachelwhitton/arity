<?php
namespace App\Theme;

// ACF Fields
$fields = [
	// Title of anchor block
	acf_text([
		'label' => 'Anchor block headline',
    'name' => 'about-us-instagram__anchor-text',
    'instructions' => 'Recommended character count max: 60',
    'required' => 1,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

	// CTA of anchor block, with options
  acf_repeater([
    'label' => '',
    'name' => 'about-us-instagram__link_groups',
    'sub_fields' => [
      [
        // Headline
        'type' => 'group',
        'label' => 'CTA',
        'name' => 'group',
        'required' => 0,
        'sub_fields' => [
          [
            'type' => 'link',
            'label' => 'Link',
            'name' => 'cta__link',
            'instructions' => 'Recommended character count max: 30',
            'required' => 1,
            'maxlength' => '',
            'wrapper' => array (
              'width' => '40',
            ),
          ],
          [
            'type' => 'radio',
            'label' => 'Type',
            'name' => 'cta__type',
            'instructions' => '',
            'required' => 0,
            'maxlength' => '',
            'default_value' => 'button',
            'choices' => array(
              'button' => 'Button',
              'link' => 'Link',
            ),
            'wrapper' => array (
              'width' => '30',
            ),
          ],
          [
            'type' => 'select',
            'label' => 'Icon',
            'name' => 'cta__icon_button',
            'instructions' => '',
            'required' => 0,
            'maxlength' => '',
            'default_value' => 'default',
            'choices' => array(
              'none' => 'none (default)',
              'external' => 'external',
            ),
            'conditional_logic' => [
              [
                [
                  'name' => 'cta__type',
                  'operator' => '==',
                  'value' => 'button'
                ]
              ]
            ],
            'wrapper' => array (
              'width' => '30',
            ),
          ],
          [
            'type' => 'select',
            'label' => 'Icon',
            'name' => 'cta__icon_link',
            'instructions' => 'Note: links with a mailto url will always get an \'mailto\' icon no matter what you select here.',
            'required' => 0,
            'maxlength' => '',
            'default_value' => 'default',
            'choices' => array(
              'arrow' => 'arrow (default)',
              'external' => 'external',
              'download' => 'download',
              'mailto' => 'mailto',
              'none' => 'none',
            ),
            'conditional_logic' => [
              [
                [
                  'name' => 'cta__type',
                  'operator' => '==',
                  'value' => 'link'
                ]
              ]
            ],
            'wrapper' => array (
              'width' => '30',
            ),
          ],
        ],
      ]
    ],
    'min'         => 0,
    'max'         => 1,
    'layout'      => 'block',
    'button_label'  => 'Add CTA',
  ]),

  // Add Instagram images
  acf_repeater([
		'label' => 'Instagram images',
		'name' => 'about-us-instagram__images',
		'sub_fields' => [
			// image
      acf_image([
        'label' => 'Images',
        'name' => 'image_id',
        'key' => 'field_image_id',
        'return_format' => 'id',
        'instructions' => 'Suggested image dimensions: <br>1080 &times; 1080 px<br>Optimized images should be no more than 250 KB',
        'required' => 1,
        'preview_size'  => 'thumbnail',
        'wrapper' => array (
          'width' => '33',
        ),
        'min' => 5,
        'max' => 5,
        'layout' => 'block',
      ]),
      // caption
      acf_text([
    		'label' => 'Alt text',
    		'name' => 'alt_text',
    		'key' => 'field_alt-text',
    		// 'instructions' => 'Recommended character count max: 120',
    		'required' => 1,
    		'maxlength' => '',
    		'wrapper' => array(
    			'width' => '66',
    		),
      ]),
		],
		'button_label' => 'Add image',
	]),
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - About Us: Instagram',
    'name' => 'module__about-us-instagram',
    'key' => 'group_module_about-us-instagram',
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