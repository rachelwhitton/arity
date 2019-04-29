<?php
namespace App\Theme;

// ACF Fields
$fields = [

    acf_tab([
      'label' => 'Content',
      'name' => 'pardot-form__content_tab',
    ]),

    // Layout
    acf_select([
      'label' => 'Pardot form',
      'name' => 'pardot-form__content-chooser',
      'key' => 'pardot-form_content-chooser',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,
      'default_value' => 'layout__image',
      'choices' => [
        'layout__pardot-form' => 'Pardot Form Builder',
      ]
    ]),
    acf_text([
      'name' => 'pardot-form-post',
      'label' => 'Endpoint URL',
      'instructions' => 'Pardot form handler: form submission posts to this URL',
      'conditional_logic' => [
        [
          [
            'name' => 'pardot-form__content-chooser',
            'operator' => '==',
            'value' => 'layout__pardot-form'
          ]
        ]
      ],
    ]),
    acf_repeater([
        'name' => 'pardot-form',
        'label' => 'Form Fields',
        // 'instructions' => '',
        'min' => 0,
        'max' => 100,
        'layout' => 'block', // block, row or table
        'button_label' => 'Add Form Input',
        'sub_fields' => [
            acf_select([
              'name' => 'field_type',
              'label' => 'Field Type',
              //'instructions' => '',
              'choices' => [
                  'textbox' => 'Text box',
                  'textarea' => 'Text area',
                  'hidden' => 'Hidden field',
                  'select' => 'Select pulldown',
                  'radio' => 'Radio button',
                  'check' => 'Checkbox',
              ],
              'default_value' => [
                  'textbox',
              ],
            ]),
            // pardot-form-check
            acf_text([
              'name' => 'pardot-form-check-body',
              'label' => 'Checkbox section title',
              //'instructions' => '',
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
              'label' => 'Checkbox options',
              //'instructions' => '',
              'min' => 0,
              'max' => 1000,
              'layout' => 'block', // block, row or table
              'button_label' => 'Add checkbox input',
              'sub_fields' => [
                  acf_checkbox([
                      'name' => 'check-by-default',
                      'label' => 'Select by default',
                      //'instructions' => '',
                      'choices' => [
                          '1' => ''
                      ],
                  ]),
                  acf_text([
                      'name' => 'check-label',
                      'label' => 'Checkbox input label',
                      //'instructions' => '',
                  ]),
                  acf_text([
                    'name' => 'check-value',
                    'label' => 'Checkbox input value',
                    //'instructions' => '',
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
              //'instructions' => '',
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
              //'instructions' => '',
              'min' => 0,
              'max' => 1000,
              'layout' => 'block', // block, row or table
              'sub_fields' => [
                    acf_checkbox([
                      'name' => 'radio-by-default',
                      'label' => 'Select by Default',
                      //'instructions' => '',
                      'choices' => [
                          '1' => ''
                      ],
                  ]),
                  acf_text([
                      'name' => 'radio-label',
                      'label' => 'radio-label',
                      //'instructions' => '',
                  ]),
                  acf_text([
                    'name' => 'radio-value',
                    'label' => 'radio-value',
                    //'instructions' => '',
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
                //'instructions' => '',

                'min' => 0,
                'max' => 1000,
                'layout' => 'block', // block, row or table
                'sub_fields' => [
                      acf_checkbox([
                        'name' => 'select-by-default',
                        'label' => 'Select by Default',
                        //'instructions' => '',
                        'choices' => [
                            '1' => ''
                        ],
                    ]),
                    acf_text([
                        'name' => 'select-label',
                        'label' => 'select-label',
                        //'instructions' => '',
                    ]),
                    acf_text([
                      'name' => 'select-value',
                      'label' => 'select-value',
                      //'instructions' => '',
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
                //'instructions' => '',
            ]),
            acf_text([
              'name' => 'field_id',
              'label' => 'Field id',
              //'instructions' => '',
            ]),
            acf_text([
              'name' => 'field_value',
              'label' => 'Field value',
              //'instructions' => '',
            ]),
            acf_checkbox([
              'name' => 'field_required',
              'label' => 'field_required',
              //'instructions' => '',
              'choices' => [
                  '1' => ''
              ],
            ]),
            acf_text([
              'name' => 'field_error_required',
              'label' => 'field_error_required',
              //'instructions' => '',
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
              //'instructions' => '',
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
              'name' => 'pardot-form__content-chooser',
              'operator' => '==',
              'value' => 'layout__pardot-form'
            ]
          ]
        ],
    ]),
    
    acf_checkbox([
      'name' => 'pardot-form-use_captcha',
      'label' => 'pardot-form-use_captcha',
      //'instructions' => '',
      'choices' => [
          '1' => ''
      ],
      'conditional_logic' => [
        [
          [
            'name' => 'pardot-form__content-chooser',
            'operator' => '==',
            'value' => 'layout__pardot-form'
          ]
        ]
      ],
    ]),
    acf_text([
      'name' => 'pardot-form-btntext',
      'label' => 'pardot-form-btntext',
      //'instructions' => '',
      'conditional_logic' => [
        [
          [
            'name' => 'pardot-form__content-chooser',
            'operator' => '==',
            'value' => 'layout__pardot-form'
          ]
        ]
      ],
    ]),
    acf_text([
      'name' => 'pardot-form-thankyou-title',
      'label' => 'pardot-form-thankyou-title',
      //'instructions' => '',
      'conditional_logic' => [
        [
          [
            'name' => 'pardot-form__content-chooser',
            'operator' => '==',
            'value' => 'layout__pardot-form'
          ]
        ]
      ],
    ]),
    acf_text([
      'name' => 'pardot-form-thankyou-copy',
      'label' => 'pardot-form-thankyou-copy',
      //'instructions' => '',
      'conditional_logic' => [
        [
          [
            'name' => 'pardot-form__content-chooser',
            'operator' => '==',
            'value' => 'layout__pardot-form'
          ]
        ]
      ],
    ]),
    acf_text([
      'name' => 'pardot-form-thankyou-url',
      'label' => 'pardot-form-thankyou-url',
      //'instructions' => '',
      'conditional_logic' => [
        [
          [
            'name' => 'pardot-form__content-chooser',
            'operator' => '==',
            'value' => 'layout__pardot-form'
          ]
        ]
      ],
    ]),
    acf_text([
      'name' => 'pardot-form-thankyou-btncopy',
      'label' => 'pardot-form-thankyou-btncopy',
      //'instructions' => '',
      'conditional_logic' => [
        [
          [
            'name' => 'pardot-form__content-chooser',
            'operator' => '==',
            'value' => 'layout__pardot-form'
          ]
        ]
      ],
    ]),
    


    // body Vertical alignment
    acf_select([
      'label' => 'Body copy vertical align',
      'name' => 'pardot-form__vertical-align',
      'key' => 'pardot-form_vertical-align',
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
      'name' => 'pardot-form__headline',
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
      'name' => 'pardot-form__body_copy',
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
      'name' => 'pardot-form__link_groups',
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
      'name' => 'pardot-form__options_tab',
    ]),

    acf_select([
      'label' => 'Layout',
      'name' => 'pardot-form__layout',
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
      'name' => 'pardot-form__bkg_color',
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
      'name' => 'pardot-form__headline-alignment',
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
      'name' => 'pardot-form__module-headline',
      'key' => 'field_module-headline',
      'instructions' => 'Recommended character count max: 100',
      'required' => 0,
      'maxlength' => '',
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Pardot Form',
    'name' => 'module__pardot-form',
    'key' => 'group_module_pardot-form',
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
