<?php
namespace App\Theme;

// ACF Fields
$fields = [

  // Center Tab
  acf_tab([
    'label' => 'Center Column',
    'name' => 'action-bar-one-col-cta__center_column_tab',
  ]),

  // Center Headline
  acf_text([
    'label' => 'Headline',
    'name' => 'action-bar-one-col-cta__center_headline',
    'key' => 'field_center_headline',
    'instructions' => 'Recommended character count max: 70',
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  // Center Content
  acf_wysiwyg([
    'label' => 'Content',
    'name' => 'action-bar-one-col-cta__center_content',
    'key' => 'field_center_content',
    'instructions' => 'Recommended character count max: 200',
    'toolbar' => 'basic',
    'media_upload' => 0,
    'required' => 0,
    'maxlength' => '',
    'wrapper' => array (
      'width' => '100',
    ),
  ]),

  // Choose your own CTA
  acf_repeater([
    'label' => '',
    'name' => 'action-bar-one-col-cta__link_groups',
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

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Action Bar: 1 column',
    'name' => 'module__action-bar-one-col-cta',
    'key' => 'group_module_action-bar-one-col-cta',
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
