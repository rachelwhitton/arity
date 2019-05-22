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
      'layout__form' => 'Form',
      'layout__pardot-form' => 'Pardot Form',
    ]
  ]),
  acf_text([
    'name' => 'pardot-form-post',
    'label' => 'pardot-form-post',
  //'instructions' => 'Add the employee name.',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__pardot-form'
        ]
      ]
    ],
  ]),
  acf_repeater([
    'name' => 'pardot-form',
    'label' => 'Form Fields',
  //'instructions' => 'Add the employees.',
    'min' => 0,
    'max' => 100,
    'layout' => 'block', // block, row or table
    'sub_fields' => [
      acf_select([
        'name' => 'field_type',
        'label' => 'Field Type',
        //'instructions' => 'Select the background color.',
        'choices' => [
          'textbox' => 'textbox',
          'textarea' => 'textarea',
          'hidden' => 'hidden',
          'select' => 'select',
          'radio' => 'radio',
          'check' => 'check',
        ],
        'default_value' => [
          'textbox',
        ],
      ]),
      // pardot-form-check
      acf_text([
        'name' => 'pardot-form-check-body',
        'label' => 'pardot-form-check-body',
        //'instructions' => 'Add the employee name.',
        'conditional_logic' => [
          [
            [
              'name' => 'field_type',
              'operator' => '==',
              'value' => 'check'
            ]
          ]
        ],
      ]),
      acf_repeater([
        'name' => 'pardot-form-check',
        'label' => 'check Fields',
        //'instructions' => 'Add the employees.',
        'min' => 0,
        'max' => 1000,
        'layout' => 'block', // block, row or table
        'sub_fields' => [
          acf_checkbox([
            'name' => 'check-by-default',
            'label' => 'Select by Default',
            //'instructions' => 'Select the border color.',
            'choices' => [
              '1' => ''
            ],
          ]),
          acf_text([
            'name' => 'check-label',
            'label' => 'check-label',
            //'instructions' => 'Add the employee name.',
          ]),
          acf_text([
            'name' => 'check-value',
            'label' => 'check-value',
            //'instructions' => 'Add the employee name.',
          ]),
        ],
        'conditional_logic' => [
          [
            [
              'name' => 'field_type',
              'operator' => '==',
              'value' => 'check'
            ]
          ]
        ],
      ]),
      // pardot-form-radio
      acf_text([
        'name' => 'pardot-form-radio-body',
        'label' => 'pardot-form-radio-body',
        //'instructions' => 'Add the employee name.',
        'conditional_logic' => [
          [
            [
              'name' => 'field_type',
              'operator' => '==',
              'value' => 'radio'
            ]
          ]
        ],
      ]),
      acf_repeater([
        'name' => 'pardot-form-radio',
        'label' => 'Select Fields',
        //'instructions' => 'Add the employees.',
        'min' => 0,
        'max' => 1000,
        'layout' => 'block', // block, row or table
        'sub_fields' => [
          acf_checkbox([
            'name' => 'radio-by-default',
            'label' => 'Select by Default',
            //'instructions' => 'Select the border color.',
            'choices' => [
              '1' => ''
            ],
          ]),
          acf_text([
            'name' => 'radio-label',
            'label' => 'radio-label',
            //'instructions' => 'Add the employee name.',
          ]),
          acf_text([
            'name' => 'radio-value',
            'label' => 'radio-value',
            //'instructions' => 'Add the employee name.',
          ]),
        ],
        'conditional_logic' => [
          [
            [
              'name' => 'field_type',
              'operator' => '==',
              'value' => 'radio'
            ]
          ]
        ],
      ]),
      // pardot-form-select
      acf_repeater([
        'name' => 'pardot-form-select',
        'label' => 'Select Fields',
        //'instructions' => 'Add the employees.',
        'min' => 0,
        'max' => 1000,
        'layout' => 'block', // block, row or table
        'sub_fields' => [
          acf_checkbox([
            'name' => 'select-by-default',
            'label' => 'Select by Default',
            //'instructions' => 'Select the border color.',
            'choices' => [
              '1' => ''
            ],
          ]),
          acf_text([
            'name' => 'select-label',
            'label' => 'select-label',
            //'instructions' => 'Add the employee name.',
          ]),
          acf_text([
            'name' => 'select-value',
            'label' => 'select-value',
            //'instructions' => 'Add the employee name.',
          ]),
        ],
        'conditional_logic' => [
          [
            [
              'name' => 'field_type',
              'operator' => '==',
              'value' => 'select'
            ]
          ]
        ],
      ]),

      acf_text([
        'name' => 'field_label',
        'label' => 'Field label',
        //'instructions' => 'Add the employee name.',
      ]),
      acf_text([
        'name' => 'field_id',
        'label' => 'Field id',
        //'instructions' => 'Add the employee name.',
      ]),
      acf_text([
        'name' => 'field_value',
        'label' => 'Field value',
        //'instructions' => 'Add the employee name.',
      ]),
      acf_checkbox([
        'name' => 'field_required',
        'label' => 'field_required',
        //'instructions' => 'Select the border color.',
        'choices' => [
          '1' => ''
        ],
      ]),
      acf_text([
        'name' => 'field_error_required',
        'label' => 'field_error_required',
        //'instructions' => 'Add the employee name.',
        'conditional_logic' => [
          [
            [
              'name' => 'field_required',
              'operator' => '==',
              'value' => '1'
            ]
          ]
        ],
      ]),
      acf_text([
        'name' => 'field_error_invalid',
        'label' => 'field_error_invalid',
        //'instructions' => 'Add the employee name.',
        'conditional_logic' => [
          [
            [
              'name' => 'field_required',
              'operator' => '==',
              'value' => '1'
            ]
          ]
        ],
      ]),
    ],
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__pardot-form'
        ]
      ]
    ],
  ]),

  acf_checkbox([
    'name' => 'pardot-form-use_captcha',
    'label' => 'pardot-form-use_captcha',
    //'instructions' => 'Select the border color.',
    'choices' => [
      '1' => ''
    ],
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__pardot-form'
        ]
      ]
    ],
  ]),
  acf_text([
    'name' => 'pardot-form-btntext',
    'label' => 'pardot-form-btntext',
    //'instructions' => 'Add the employee name.',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__pardot-form'
        ]
      ]
    ],
  ]),
  acf_text([
    'name' => 'pardot-form-thankyou-title',
    'label' => 'pardot-form-thankyou-title',
    //'instructions' => 'Add the employee name.',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__pardot-form'
        ]
      ]
    ],
  ]),
  acf_text([
    'name' => 'pardot-form-thankyou-copy',
    'label' => 'pardot-form-thankyou-copy',
    //'instructions' => 'Add the employee name.',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__pardot-form'
        ]
      ]
    ],
  ]),
  acf_text([
    'name' => 'pardot-form-thankyou-url',
    'label' => 'pardot-form-thankyou-url',
    //'instructions' => 'Add the employee name.',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__pardot-form'
        ]
      ]
    ],
  ]),
  acf_text([
    'name' => 'pardot-form-thankyou-btncopy',
    'label' => 'pardot-form-thankyou-btncopy',
    //'instructions' => 'Add the employee name.',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__pardot-form'
        ]
      ]
    ],
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
    'label' => 'Image shadow',
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
    'label' => 'Video URL',
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

  // Form URL
  acf_text([
    'label' => 'Endpoint URL',
    'name' => 'content-image-block__form-posturl',
    'instructions' => 'Pardot form handler: Form submission posts to this URL',
    'required' => 0,
    'maxlength' => '',
    'default_value' => '',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__form'
        ]
      ]
    ],
    'wrapper' => array (
      'width' => '1000',
    )
  ]),
  // Form OID
  /*
  acf_text([
  'label' => 'Form OID',
  'name' => 'content-image-block__form-oid',
  'required' => 0,
  'maxlength' => '',
  'default_value' => '00Df4000001TyK5',
  'conditional_logic' => [
  [
  [
  'name' => 'content-image-block__content-chooser',
  'operator' => '==',
  'value' => 'layout__form'
  ]
  ]
  ],
  'wrapper' => array (
  'width' => '1000',
  )
  ]),
  // Form lead source
  acf_text([
  'label' => 'Lead source',
  'instructions' => 'The website from where the form submission originates (almost always ‘Arity.com’)',
  'name' => 'content-image-block__form-leadsource',
  'required' => 0,
  'maxlength' => '',
  'default_value' => 'Arity.com',
  'conditional_logic' => [
  [
  [
  'name' => 'content-image-block__content-chooser',
  'operator' => '==',
  'value' => 'layout__form'
  ]
  ]
  ],
  'wrapper' => array (
  'width' => '1000',
  )
  ]),
  */
  // Form first name
  acf_text([
    'label' => 'First name field ID',
    'instructions' => 'Pardot form handler: ID maps to Default: ‘First Name’',
    'name' => 'content-image-block__form-fname',
    'required' => 0,
    'maxlength' => '',
    'default_value' => '',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__form'
        ]
      ]
    ],
    'wrapper' => array (
      'width' => '1000',
    )
  ]),
  // Form last name
  acf_text([
    'label' => 'Last name field ID',
    'instructions' => 'Pardot form handler: ID maps to Default: ‘Last Name’',
    'name' => 'content-image-block__form-lname',
    'required' => 0,
    'maxlength' => '',
    'default_value' => '',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__form'
        ]
      ]
    ],
    'wrapper' => array (
      'width' => '1000',
    )
  ]),
  // Form email
  acf_text([
    'label' => 'Email field ID',
    'instructions' => 'Pardot form handler: ID maps to Default: ‘Email’',
    'name' => 'content-image-block__form-email',
    'required' => 0,
    'maxlength' => '',
    'default_value' => '',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__form'
        ]
      ]
    ],
    'wrapper' => array (
      'width' => '1000',
    )
  ]),
  // Form company
  acf_text([
    'label' => 'Company field ID',
    'instructions' => 'Pardot form handler: ID maps to Default: ‘Company’',
    'name' => 'content-image-block__form-company',
    'required' => 0,
    'maxlength' => '',
    'default_value' => '',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__form'
        ]
      ]
    ],
    'wrapper' => array (
      'width' => '1000'
    )
  ]),
  // Form industry
  acf_text([
    'label' => 'Industry field ID',
    'instructions' => 'Pardot form handler: ID maps to Custom: ‘What industry do you work in’',
    'name' => 'content-image-block__form-industry',
    'required' => 0,
    'maxlength' => '',
    'default_value' => '',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__form'
        ]
      ]
    ],
    'wrapper' => array (
      'width' => '1000',
    )
  ]),
  // Form contact by email consent
  acf_text([
    'label' => 'Contact by email consent field ID',
    'instructions' => 'Pardot form handler: ID maps to Custom: ‘I would like to get emails from Arity’',
    'name' => 'content-image-block__form-contactme',
    'required' => 0,
    'maxlength' => '',
    'default_value' => '',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__form'
        ]
      ]
    ],
    'wrapper' => array (
      'width' => '1000',
    )
  ]),
  // Form button text
  acf_text([
    'label' => 'CTA button label',
    'instructions' => 'Typically the CTA will be labelled ‘Download’',
    'name' => 'content-image-block__form-btntext',
    'required' => 0,
    'maxlength' => '',
    'default_value' => 'Download',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__form'
        ]
      ]
    ],
    'wrapper' => array (
      'width' => '1000',
    )
  ]),
  // Form Download URL
  acf_text([
    'label' => 'Download URL',
    'instructions' => 'The URL to the downloadable content',
    'name' => 'content-image-block__form-downloadurl',
    'required' => 0,
    'maxlength' => '',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__form'
        ]
      ]
    ],
    'wrapper' => array (
      'width' => '1000',
    )
  ]),
  // Form post submit CTA
  acf_text([
    'label' => 'Post-submit CTA message',
    'instructions' => 'The call-to-action that is shown once the user submits the form',
    'name' => 'content-image-block__form-thankyou',
    'required' => 0,
    'maxlength' => '',
    'default_value' => 'Click on this button to download your document',
    'conditional_logic' => [
      [
        [
          'name' => 'content-image-block__content-chooser',
          'operator' => '==',
          'value' => 'layout__form'
        ]
      ]
    ],
    'wrapper' => array (
      'width' => '1000',
    )
  ]),

  // Dat viz URL
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
  //iframe height at Xlarge
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
  //iframe height at large
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
  //iframe height at medium
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
  //iframe height at small
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
    'label' => 'Body copy vertical align',
    'name' => 'content-image-block__vertical-align',
    'key' => 'content-image-block_vertical-align',
    'instructions' => '',
    'required' => 0,
    'maxlength' => '',
    'allow_null' => 0,
    'ui' => 1,
    'default_value' => 'Top',
    'choices' => [
      'Top' => 'Top',
      'Center' => 'Center'
    ],
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
          ],
          [
            'type' => 'checkbox',
            'name' => 'optIn',
            'label' => '',
            'required' => false,
            'choices' => [
              'optIn' => 'Show Opt-In Form.'
            ],
          ],
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
