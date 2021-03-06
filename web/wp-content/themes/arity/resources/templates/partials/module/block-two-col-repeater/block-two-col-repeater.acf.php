<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'block-two-col-repeater__eyebrow',
      'key' => 'field_eyebrow',
      'instructions' => 'Recommended character count max: 42',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Headline
    acf_text([
      'label' => 'Main Headline',
      'name' => 'block-two-col-repeater__main_headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 60',
      'required' => 1,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Body Copy
    acf_textarea([
      'label' => 'Subhead',
      'name' => 'block-two-col-repeater__subhead',
      'key' => 'field_body_copy',
      'instructions' => 'Recommended character count max: 150',
      'required' => 1,
      'new_lines' => 'wpautop',
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // Repeater: Block Two Column Components
    acf_repeater([
      'label' => '2-Column Blocks',
      'name' => 'block-two-col-repeater__blocks',

      'sub_fields' => [

        acf_tab([
          'label' => 'Content',
          'name' => 'block-two-col-component__content_tab',
        ]),

      // Layout
      acf_select([
        'label' => 'Media type',
        'name' => 'block-two-col-component__content-chooser',
        'key' => 'block-two-col-component_content-chooser',
        'instructions' => '',
        'required' => 0,
        'maxlength' => '',
        'allow_null' => 0,
        'ui' => 1,
        'default_value' => 'layout__image',
        'choices' => [
          'layout__image' => 'Image',
          'layout__video' => 'Video',
          'layout__datavis' => 'Data Visualization',
        ]
      ]),

      // Headline
      acf_text([
        'label' => 'Block Headline',
        'name' => 'block-two-col-component__headline',
        'key' => 'field_headline',
        'instructions' => 'Recommended character count max: 60',
        'required' => 0,
        'maxlength' => '',
        'wrapper' => array (
          'width' => '50',
        ),
      ]),

      // Image
      acf_image([
        'label' => 'Image',
        'name' => 'block-two-col-component__image_id',
        'key' => 'field_image',
        'return_format' => 'id',
        'instructions' => 'Suggested image size: 1144 x 780 px ',
        'required' => 1,
        'preview_size'  => 'thumbnail',
        'conditional_logic' => [
          [
            [
              'name' => 'block-two-col-component__content-chooser',
              'operator' => '==',
              'value' => 'layout__image'
            ]
          ]
        ],
        'wrapper' => array (
          'width' => '25',
        ),
      ]),

      // Images has shadow?
      acf_radio([
        'label' => 'Image Shadow',
        'name' => 'block-two-col-component__shadow',
        'instructions' => '',
        'default_value' => '1',
        'choices' => [
          '1' => 'Enabled (default)',
          '0' => 'Disabled'
        ],
        // 'return_format' => 'id',
        'wrapper' => array (
          'width' => '25',
        ),
        'conditional_logic' => [
          [
            [
              'name' => 'block-two-col-component__content-chooser',
              'operator' => '==',
              'value' => 'layout__image'
            ]
          ]
        ],
      ]),

      // Video Url
      acf_text([
        'label' => 'Video Url',
        'name' => 'block-two-col-component__url',
        'instructions' => 'Supports Vimeo or Youtube',
        'required' => 1,
        'maxlength' => '',
        'conditional_logic' => [
          [
            [
              'name' => 'block-two-col-component__content-chooser',
              'operator' => '==',
              'value' => 'layout__video'
            ]
          ]
        ],
        'wrapper' => array (
          'width' => '50',
        )
      ]),

      // datavis Url
      acf_file([
        'name' => 'visualization',
        'label' => 'Upload visualization',
        'instructions' => 'Add the <strong>zip</strong> file. Zip file should not exceed 2MB.',
        'required' => 0,
        'library' => 'all',
        'mime_types' => 'zip',
        'return_format' => 'array',
        'conditional_logic' => [
          [
            [
              'name' => 'block-two-col-component__content-chooser',
              'operator' => '==',
              'value' => 'layout__datavis'
            ]
          ]
        ],
        //'min_size' => '400 KB',
        //'max_size' => 5, // MB if entered as int
      ]),
      acf_text([
        'label' => 'iframe URL',
        'name' => 'block-two-col-component__url-iframe',
        'instructions' => 'iframe URL will overwrite zip file.',
        'required' => 0,
        'maxlength' => '',
        'conditional_logic' => [
          [
            [
              'name' => 'block-two-col-component__content-chooser',
              'operator' => '==',
              'value' => 'layout__datavis'
            ]
          ]
        ],
        'wrapper' => array (
          'width' => '1000',
        )
      ]),
      //iframe height at Xlarge
      acf_text([
        'label' => 'Iframe height at xlarge devices',
        'name' => 'block-two-col-component__url-height-xlarge',
        'instructions' => 'Specify iframe height in pixels',
        'required' => 0,
        'maxlength' => '',
        'conditional_logic' => [
          [
            [
              'name' => 'block-two-col-component__content-chooser',
              'operator' => '==',
              'value' => 'layout__datavis'
            ]
          ]
        ],
        'wrapper' => array (
          'width' => '1000',
        )
      ]),
       //iframe height at large
       acf_text([
        'label' => 'Iframe height at large devices',
        'name' => 'block-two-col-component__url-height-large',
        'instructions' => 'Specify iframe height in pixels',
        'required' => 0,
        'maxlength' => '',
        'conditional_logic' => [
          [
            [
              'name' => 'block-two-col-component__content-chooser',
              'operator' => '==',
              'value' => 'layout__datavis'
            ]
          ]
        ],
        'wrapper' => array (
          'width' => '1000',
        )
      ]),
       //iframe height at medium
       acf_text([
        'label' => 'Iframe height at medium devices',
        'name' => 'block-two-col-component__url-height-medium',
        'instructions' => 'Specify iframe height in pixels',
        'required' => 0,
        'maxlength' => '',
        'conditional_logic' => [
          [
            [
              'name' => 'block-two-col-component__content-chooser',
              'operator' => '==',
              'value' => 'layout__datavis'
            ]
          ]
        ],
        'wrapper' => array (
          'width' => '1000',
        )
      ]),
       //iframe height at small
       acf_text([
        'label' => 'Iframe height at small devices',
        'name' => 'block-two-col-component__url-height-small',
        'instructions' => 'Specify iframe height in pixels',
        'required' => 0,
        'maxlength' => '',
        'conditional_logic' => [
          [
            [
              'name' => 'block-two-col-component__content-chooser',
              'operator' => '==',
              'value' => 'layout__datavis'
            ]
          ]
        ],
        'wrapper' => array (
          'width' => '1000',
        )
      ]),

      // Body Copy
      acf_textarea([
        'label' => 'Body Copy',
        'name' => 'block-two-col-component__body_copy',
        'key' => 'field_body_copy',
        'instructions' => 'Recommended character count max: 300',
        'required' => 1,
        'new_lines' => 'wpautop',
        'wrapper' => array (
          'width' => '100',
        ),
      ]),

      // Choose your own CTA
      acf_repeater([
        'label' => '',
        'name' => 'block-two-col-component__link_groups',
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
                'instructions' => 'Note: links with a mailto url will always get an \'mailto\' icon no matter what you select here.',
                'required' => 0,
                'maxlength' => '',
                'default_value' => 'default',
                'choices' => array(
                  'none' => 'none (default)',
                  'external' => 'external',
                  'download' => 'download',
                  'mailto' => 'mailto'
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
              ]
            ],
          ]
        ],
        'min'          => 0,
        'max'          => 2,
        'layout'       => 'block',
        'button_label' => 'Add CTA',
      ]),

      acf_tab([
        'label' => 'Options',
        'name' => 'block-two-col-component__options_tab',
      ]),

      acf_select([
        'label' => 'Layout',
        'name' => 'block-two-col-component__layout',
        'key' => 'field_layout',
        'instructions' => '',
        'required' => 0,
        'maxlength' => '',
        'allow_null' => 1,
        'ui' => 1,
        'wrapper' => array (
          'width' => '25',
        ),
        'default_value' => 'default',
        'choices' => [
          'default' => 'Alternating Image Right/Image Left Layouts',
          'right' => 'Image Right, Content Left',
          'left' => 'Image Left, Content Right'
        ]
      ]),

      acf_select([
        'label' => 'Background Color',
        'name' => 'block-two-col-component__bkg_color',
        'key' => 'field_bkg_color',
        'instructions' => '',
        'required' => 0,
        'maxlength' => '',
        'allow_null' => 1,
        'ui' => 1,
        'wrapper' => array (
          'width' => '25',
        ),
        'default_value' => 'default',
        'choices' => [
          'default' => 'Alternating Light Gray/White',
          'white' => 'White',
          'lightgray' => 'Light Gray',
          'navy' => 'Navy'
        ]
      ]),
    ],
    'min'          => 1,
    'max'          => 100,
    'layout'       => 'block',
    'button_label' => 'Add 2 Column Block',
  ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Block: 2 column repeater',
    'name' => 'module__block-two-col-repeater',
    'key' => 'group_module_block-two-col-repeater',
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
