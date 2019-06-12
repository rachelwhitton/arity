<?php
namespace App\Theme;

// ACF Fields
$fields = [

  acf_tab([
    'label' => 'Content',
    'name' => 'block-two-column-narrow__content_tab',
  ]),

  // Image
  acf_image([
    'label' => 'Image',
    'name' => 'block-two-column-narrow__image_id',
    'key' => 'field_image',
    'return_format' => 'id',
    'instructions' => 'Suggested image size: 1144 x 780 px ',
    'required' => 1,
    'preview_size'  => 'thumbnail',
    'wrapper' => array (
      'width' => '25',
    ),
  ]),

  // Images has shadow?
  acf_radio([
    'label' => 'Image shadow',
    'name' => 'block-two-column-narrow__shadow',
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

  ]),

  
  
  
  // body Vertical alignment
  acf_select([
    'label' => 'Body copy vertical align',
    'name' => 'block-two-column-narrow__vertical-align',
    'key' => 'block-two-column-narrow_vertical-align',
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
    'name' => 'block-two-column-narrow__headline',
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
    'name' => 'block-two-column-narrow__body_copy',
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
    'name' => 'block-two-column-narrow__link_groups',
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
    'name' => 'block-two-column-narrow__options_tab',
  ]),

  acf_select([
    'label' => 'Layout',
    'name' => 'block-two-column-narrow__layout',
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
    'name' => 'block-two-column-narrow__bkg_color',
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
    'name' => 'block-two-column-narrow__headline-alignment',
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
    'name' => 'block-two-column-narrow__module-headline',
    'key' => 'field_module-headline',
    'instructions' => 'Recommended character count max: 100',
    'required' => 0,
    'maxlength' => '',
  ]),

];

// ACF Field Group
acf_field_group([
  'title' => 'Module - Block: 2 column narrow',
  'name' => 'module__block-two-column-narrow',
  'key' => 'group_module_block-two-column-narrow',
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
