<?php
namespace App\Theme;

// ACF Fields
$fields = [

    acf_tab([
      'label' => 'Content',
      'name' => 'content-image-block__content_tab',
    ]),

    // Layout
    acf_select([
      'label' => 'Media type',
      'name' => 'content-image-block__content-chooser',
      'key' => 'content-image-block_content-chooser',
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

    // Image
    acf_image([
      'label' => 'Image',
      'name' => 'content-image-block__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => 'Suggested image size: 1144 x 780 px ',
      'required' => 1,
      'preview_size'  => 'thumbnail',
      'conditional_logic' => [
        [
          [
            'name' => 'content-image-block__content-chooser',
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
      'name' => 'content-image-block__shadow',
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
            'name' => 'content-image-block__content-chooser',
            'operator' => '==',
            'value' => 'layout__image'
          ]
        ]
      ],
    ]),

    // Video Url
    acf_text([
      'label' => 'Video Url',
      'name' => 'content-image-block__url',
      'instructions' => 'Supports Vimeo or Youtube',
      'required' => 1,
      'maxlength' => '',
      'conditional_logic' => [
        [
          [
            'name' => 'content-image-block__content-chooser',
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
            'name' => 'content-image-block__content-chooser',
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
      'name' => 'content-image-block__url-iframe',
      'instructions' => 'iframe URL will overwrite zip file.',
      'required' => 0,
      'maxlength' => '',
      'conditional_logic' => [
        [
          [
            'name' => 'content-image-block__content-chooser',
            'operator' => '==',
            'value' => 'layout__datavis'
          ]
        ]
      ],
      'wrapper' => array (
        'width' => '1000',
      )
    ]),
    //iframe hright at Xlarge
    acf_text([
      'label' => 'Iframe height at xlarge devices',
      'name' => 'content-image-block__url-height-xlarge',
      'instructions' => 'Specify iframe height in pixels',
      'required' => 0,
      'maxlength' => '',
      'conditional_logic' => [
        [
          [
            'name' => 'content-image-block__content-chooser',
            'operator' => '==',
            'value' => 'layout__datavis'
          ]
        ]
      ],
      'wrapper' => array (
        'width' => '1000',
      )
    ]),
     //iframe hright at large
     acf_text([
      'label' => 'Iframe height at large devices',
      'name' => 'content-image-block__url-height-large',
      'instructions' => 'Specify iframe height in pixels',
      'required' => 0,
      'maxlength' => '',
      'conditional_logic' => [
        [
          [
            'name' => 'content-image-block__content-chooser',
            'operator' => '==',
            'value' => 'layout__datavis'
          ]
        ]
      ],
      'wrapper' => array (
        'width' => '1000',
      )
    ]),
     //iframe hright at medium
     acf_text([
      'label' => 'Iframe height at medium devices',
      'name' => 'content-image-block__url-height-medium',
      'instructions' => 'Specify iframe height in pixels',
      'required' => 0,
      'maxlength' => '',
      'conditional_logic' => [
        [
          [
            'name' => 'content-image-block__content-chooser',
            'operator' => '==',
            'value' => 'layout__datavis'
          ]
        ]
      ],
      'wrapper' => array (
        'width' => '1000',
      )
    ]),
     //iframe hright at small
     acf_text([
      'label' => 'Iframe height at small devices',
      'name' => 'content-image-block__url-height-small',
      'instructions' => 'Specify iframe height in pixels',
      'required' => 0,
      'maxlength' => '',
      'conditional_logic' => [
        [
          [
            'name' => 'content-image-block__content-chooser',
            'operator' => '==',
            'value' => 'layout__datavis'
          ]
        ]
      ],
      'wrapper' => array (
        'width' => '1000',
      )
    ]),
    // body Vertical alignment
    acf_select([
      'label' => 'Body copy Vertical Align',
      'name' => 'content-image-block__vertial-align',
      'key' => 'content-image-block_vertial-align',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,
      'default_value' => 'Center',
      'choices' => [
        'Top' => 'Top',
        'Center' => 'Center'
      ],
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

    // Choose your own CTA
    acf_repeater([
      'label' => '',
      'name' => 'content-image-block__link_groups',
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
      'min'         => 0,
      'max'         => 2,
      'layout'      => 'block',
      'button_label'  => 'Add CTA',
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
      'default_value' => 'right',
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
      'default_value' => 'white',
      'choices' => [
        'white' => 'White',
        'lightgray' => 'Light Gray',
        'navy' => 'Navy'
      ]
    ]),

    acf_select([
      'label' => '"Module" Headline Alignment',
      'name' => 'content-image-block__headline-alignment',
      'key' => 'field_headline-alignment',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 1,
      'ui' => 1,
      'wrapper' => array (
        'width' => '25',
      ),
      'default_value' => 'center',
      'choices' => [
        'left' => 'Left',
        'center' => 'Centered'
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
