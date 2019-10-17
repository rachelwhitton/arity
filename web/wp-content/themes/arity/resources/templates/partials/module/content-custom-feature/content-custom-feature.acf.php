<?php
namespace App\Theme;

// ACF Fields
$fields = [
	// Custom content selector
	acf_select([
		'label' => 'Choose custom content',
    'name' => 'content-custom-feature__custom-content',
    'key' => 'field_custom-content',
    'required' => 0,
    'allow_null' => 0,
    'ui' => 1,
    'default_value' => 'custom-content-selector',
    'choices' => [
      'custom-content-selector' => 'Custom content selector',
      'marketplace-risk-graphic' => 'Marketplace risk graphic',
      'about-us-rotating-headline' => 'About us rotating headline',
      'about-us-data-grid' => 'About us data grid',
      'about-us-leadership' => 'About us leadership',
      'about-us-locations' => 'About us locations',
      'about-us-instagram' => 'About us Instagram',
      'arity-platform-graphic' => 'The Arity Platform'
    ]
  ]),
  // Section headline
  acf_text([
    'label' => 'Section Headline',
    'name' => 'content-custom-feature__arity-platform_section-headline',
    'key' => 'field_content-custom-feature_arity-platform_section-headline',
    'instructions' => '',
    'required' => 0,
    'wrapper' => array(
      'width' => '100',
    ),
    'conditional_logic' => [
      [
        [
          'name' => 'content-custom-feature__custom-content',
          'operator' => '==',
          'value' => 'arity-platform-graphic',
        ]
      ]
    ],
  ]),
  // Content blocks
  acf_repeater([
    'label' => 'Arity Platform Content Blocks',
    'name' => 'content-custom-feature__arity-platform_build-content-blocks',
    'key' => 'field_content-custom-feature_arity-platform_build-content-blocks',
    'instructions' => '',
    'required' => 0,
    'wrapper' => array(
      'width' => '100'
    ),
    'min' => 0,
    'max' => 0,
    'layout' => 'row',
    'button_label' => 'Add Block',
    'conditional_logic' => [
      [
        [
          'name' => 'content-custom-feature__custom-content',
          'operator' => '==',
          'value' => 'arity-platform-graphic',
        ]
      ]
    ],
    'sub_fields' => [
      acf_flexible_content([
        'key' => 'field_content-custom-feature_add-content-sections',
        'label' => 'Content Section',
        'name' => 'content-custom-feature__add-content-sections',
        'instructions' => '',
        'required' => 0,
        'wrapper' => array(
          'width' => '100',
        ),
        'display' => 'seamless',
        'button_label' => 'Add Section', 
        'layouts' => [
          [
            'key' => 'field_add-content-section_block',
            'name' => 'add-content-section__block',
            'label' => 'Content Block',
            'display' => 'block',
            'sub_fields' => [
              [
                'key' => 'field_arity-platform_block-eyebrow',
                'name' => 'arity-platform__block-eyebrow',
                'label' => 'Eyebrow',
                'type' => 'text',
                'instructions' => 'Limit to 42 characters',
                'required' => 0,
                'wrapper' => array(
                  'width' => '75',
                ),
              ],
              [
                'key' => 'field_arity-platform_block-headline',
                'name' => 'arity-platform__block-headline',
                'label' => 'Block Headline',
                'type' => 'text',
                'instructions' => 'Limit to 80 characters',
                'required' => 0,
                'wrapper' => array(
                  'width' => '100',
                ),
                'new_lines' => 'br',
              ],
              [
                'key' => 'field_arity-platform_block-body-copy',
                'name' => 'arity-platform__block-body-copy',
                'label' => 'Block Body Copy',
                'instructions' => 'Supports simple HTML markup, e.g., &lt;p&gt;, &lt;ul&gt;, and &lt;ol&gt; block elements; &lt;em&gt; and &lt;strong&gt; inline elements',
                'type' => 'textarea',
                'required' => 0,
                'wrapper' => array(
                  'width' => '100',
                ),
              ],
            ],
          ],
        ],
      ]),
    ],
  ]),
];

// ACF Field Group
acf_field_group([
	'title' => 'Module - Content: Custom feature',
	'name' => 'module__content-custom-feature',
	'key' => 'group_module_content-custom-feature',
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
