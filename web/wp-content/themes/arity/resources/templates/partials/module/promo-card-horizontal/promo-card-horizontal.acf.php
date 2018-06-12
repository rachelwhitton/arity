<?php
namespace App\Theme;

// ACF Fields
$fields = [

  acf_tab([
    'label' => 'Content',
    'name' => 'promo__content_tab',
  ]),


    // Image
    acf_image([
      'label' => 'Image',
      'name' => 'promo-card-horizontal__image_id',
      'key' => 'field_image',
      'return_format' => 'id',
      'instructions' => 'Suggested image size: 1110 x 760 px',
      'required' => 1,
      'preview_size'  => 'thumbnail',
      'wrapper' => array (
        'width' => '100',
      )
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'promo-card-horizontal__headline',
      'instructions' => 'Recommended character count max: 100',
      'required' => 0,
      'maxlength' => '',
    ]),

    // Location
    acf_text([
      'label' => 'Date / Location',
      'name' => 'promo-card-horizontal__location',
      'instructions' => 'Recommended character count max: 100',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      )
    ]),

    // Textarea
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'promo-card-horizontal__body-copy',
      'key' => 'field_body_copy',
      'instructions' => 'Recommended character count max: 200',
      'required' => 0,
      'new_lines' => 'wpautop'
    ]),

    // CTA
    acf_link([
      'label' => 'CTA Button',
      'name' => 'promo-card-horizontal__cta',
      'key' => 'field_cta',
      'instructions' => 'Recommended character count max: 30',
      'required' => 0,
      'wrapper' => array (
        'width' => '100',
      ),
    ]),

    // acf_repeater([
    //   'label' => '',
    //   'name' => 'promo-card-horizontal__link_groups',
    //   'sub_fields' => [
    //     [
    //       // Headline
    //       'type' => 'group',
    //       'label' => 'CTA',
    //       'name' => 'group',
    //       'required' => 0,
    //       'sub_fields' => [
    //         [
    //           'type' => 'link',
    //           'label' => 'Link',
    //           'name' => 'link',
    //           'instructions' => 'Recommended character count max: 30',
    //           'required' => 0,
    //           'maxlength' => '',
    //           'wrapper' => array (
    //             'width' => '40',
    //           ),
    //         ],
    //         [
    //           'type' => 'radio',
    //           'label' => 'Type',
    //           'name' => 'type',
    //           'instructions' => '',
    //           'required' => 0,
    //           'maxlength' => '',
    //           'choices' => array(
    //             'button' => 'Button',
    //             'link' => 'Link',
    //           ),
    //           'wrapper' => array (
    //             'width' => '30',
    //           ),
    //         ],
    //         [
    //           'type' => 'select',
    //           'label' => 'Icon',
    //           'name' => 'icon',
    //           'instructions' => 'Note: mailto urls will always get a mailto icon unless you specify none.',
    //           'required' => 0,
    //           'maxlength' => '',
    //           'choices' => array(
    //             'default' => 'Default',
    //             'mailto' => 'Mailto',
    //             'external' => 'External',
    //             'download' => 'Download',
    //             'none' => 'None',
    //           ),
    //           'wrapper' => array (
    //             'width' => '30',
    //           ),
    //         ]
    //       ],
    //     ]
    //   ],
    //   'min'         => 0,
    //   'max'         => 2,
    //   'layout'      => 'block',
    //   'button_label'  => 'Add CTA',
    // ]),

    acf_tab([
      'label' => 'Options',
      'name' => 'promo-card-horizontal__options_tab',
    ]),

    acf_select([
      'label' => 'Image / Content Layout',
      'name' => 'promo-card-horizontal__layout',
      'key' => 'field_layout',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 1,
      'ui' => 1,
      'wrapper' => array (
        'width' => '100',
      ),
      'default_value' => 'image-align-right',
      'choices' => [
        'image-align-left' => 'Image Left, Content Right',
        'image-align-right' => 'Image Right, Content Left'
      ]
    ]),

    // Layout
    acf_select([
      'label' => 'Full or Split Background',
      'name' => 'promo-card-horizontal__--settings_alignment',
      'key' => 'promo-card-horizontal_--settings_alignment',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,
      'default_value' => 'layout__full-bg',
      'choices' => [
        'layout__full-bg' => 'Full Background',
        'layout__half-bg' => 'Split Background',
      ]
    ]),

    // Split Background Top
    acf_select([
      'label' => 'Background Color -- Top',
      'name' => 'promo-card-horizontal__bg-color_top',
      'key' => 'field_bg-color_top',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,
      'wrapper' => array (
        'width' => '50',
      ),
      'default_value' => 'promo-card-horizontal--white-bg',
      'choices' => [
        'promo-card-horizontal--white-bg' => 'White',
        'promo-card-horizontal--light-gray-bg' => 'Light Gray',
        'promo-card-horizontal--navy-bg' => 'Navy'
      ],
      'conditional_logic' => [
        [
          [
            'name' => 'promo-card-horizontal__--settings_alignment',
            'operator' => '==',
            'value' => 'layout__half-bg'
          ]
        ]
      ]
    ]),

    // Split Background Top
    acf_select([
      'label' => 'Background Color -- Bottom',
      'name' => 'promo-card-horizontal__bg-color_bot',
      'key' => 'field_bg-color_bot',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,
      'wrapper' => array (
        'width' => '50',
      ),
      'default_value' => 'split-bg__bottom--light-gray-bg',
      'choices' => [
        'split-bg__bottom--white-bg' => 'White',
        'split-bg__bottom--light-gray-bg' => 'Light Gray',
        'split-bg__bottom--navy-bg' => 'Navy'
      ],
      'conditional_logic' => [
        [
          [
            'name' => 'promo-card-horizontal__--settings_alignment',
            'operator' => '==',
            'value' => 'layout__half-bg'
          ]
        ]
      ]
    ]),

    // Full Background Color
    acf_select([
      'label' => 'Background Color',
      'name' => 'promo-card-horizontal__bg-color',
      'key' => 'field_bg-color',
      'instructions' => '',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,
      'wrapper' => array (
        'width' => '100',
      ),
      'default_value' => 'promo-card-horizontal--light-gray-bg',
      'choices' => [
        'promo-card-horizontal--white-bg' => 'White',
        'promo-card-horizontal--light-gray-bg' => 'Light Gray',
        'promo-card-horizontal--navy-bg' => 'Navy'
      ],
      'conditional_logic' => [
        [
          [
            'name' => 'promo-card-horizontal__--settings_alignment',
            'operator' => '==',
            'value' => 'layout__full-bg'
          ]
        ]
      ]
    ]),




];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Promo: Card horizontal',
    'name' => 'module__promo-card-horizontal',
    'key' => 'group_module_promo-card-horizontal',
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
