<?php
namespace App\Theme;

// ACF Fields
$fields = [

  // Left Tab
  acf_tab([
    'label' => 'Left Column',
    'name' => 'action-bar__left_column_tab',
  ]),

  // Left Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'action-bar__left_headline',
    'key' => 'field_left_headline',
    'instructions' => 'Recommended character count max: 70',
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  // Left Content
  acf_wysiwyg([
    'label' => 'Content',
    'name' => 'action-bar__left_content',
    'key' => 'field_left_content',
    'instructions' => 'Recommended character count max: 200',
    'toolbar' => 'basic',
    'media_upload' => 0,
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  //left links
  acf_repeater([
    'label' => '',
    'name' => 'action-bar__left_link_groups',
    'sub_fields' => [
      [
        // Headline
        'type' => 'group',
        'label' => 'CTA',
        'name' => 'group_l',
        'required' => 0,
        'sub_fields' => [
          [
            'type' => 'link',
            'label' => 'Link',
            'name' => 'link_l',
            'instructions' => 'Recommended character count max: 25',
            'required' => 1,
            'maxlength' => '',
            'wrapper' => array (
              'width' => '40',
            ),
          ],
          [
            'type' => 'radio',
            'label' => 'Type',
            'name' => 'type_l',
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
            'name' => 'icon_l_button',
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
                  'name' => 'type_l',
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
            'name' => 'icon_l_link',
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
                  'name' => 'type_l',
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
    'label' => 'Right Column',
    'name' => 'action-bar__right_column_tab',
  ]),

  // Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'action-bar__right_headline',
    'key' => 'field_right_headline',
    'instructions' => 'Recommended character count max: 70',
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  // Right Content
  acf_wysiwyg([
    'label' => 'Content',
    'name' => 'action-bar__right_content',
    'key' => 'field_right_content',
    'instructions' => 'Recommended character count max: 200',
    'toolbar' => 'basic',
    'media_upload' => 0,
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  // Right links
  acf_repeater([
    'label' => '',
    'name' => 'action-bar__right_link_groups',
    'sub_fields' => [
      [
        // Headline
        'type' => 'group',
        'label' => 'CTA',
        'name' => 'group_r',
        'required' => 0,
        'sub_fields' => [
          [
            'type' => 'link',
            'label' => 'Link',
            'name' => 'link_r',
            'instructions' => 'Recommended character count max: 25',
            'required' => 1,
            'maxlength' => '',
            'wrapper' => array (
              'width' => '40',
            ),
          ],
          [
            'type' => 'radio',
            'label' => 'Type',
            'name' => 'type_r',
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
            'name' => 'icon_r_button',
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
                  'name' => 'type_r',
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
            'name' => 'icon_r_link',
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
                  'name' => 'type_r',
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
];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Action Bar: 2 column',
    'name' => 'module__action-bar',
    'key' => 'group_module_action-bar',
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
