<?php
namespace App\Theme;

// ACF Fields
$fields = [

  // Image
  acf_image([
    'label' => 'Image',
    'name' => 'promo-card-horizontal__image_id',
    'key' => 'field_image',
    'return_format' => 'id',
    'instructions' => 'Suggested image size: 1024 x 700 px ',
    'required' => 0,
    'preview_size'  => 'thumbnail',
    'wrapper' => array (
      'width' => '50',
    )
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
      'width' => '25',
    ),
    'default_value' => 'white',
    'choices' => [
      '#FFFFFF' => 'White',
      '#F7F7F7' => 'Light Gray',
      '#011C2C' => 'Dark Blue'
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
      'width' => '25',
    ),
    'default_value' => 'white',
    'choices' => [
      '#FFFFFF' => 'White',
      '#F7F7F7' => 'Light Gray',
      '#011C2C' => 'Dark Blue'
    ]
  ]),

    // Eyebrow
    // acf_text([
    //   'label' => 'Eyebrow',
    //   'name' => 'promo-card-horizontal__eyebrow',
    //   'key' => 'field_eyebrow',
    //   'instructions' => 'Recommended character count max: 42',
    //   'required' => 0,
    //   'maxlength' => '',
    //   'wrapper' => array (
    //     'width' => '100',
    //   )
    // ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'promo-card-horizontal__headline',
      'instructions' => 'Recommended character count max: 100',
      'required' => 1,
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
    // acf_link([
    //   'label' => 'CTA Button',
    //   'name' => 'promo-card-horizontal__cta',
    //   'key' => 'field_cta',
    //   'instructions' => 'Recommended character count max: 30',
    //   'required' => 1,
    //   'wrapper' => array (
    //     'width' => '25',
    //   ),
    // ]),



    acf_repeater([
      'label' => '',
      'name' => 'promo-card-horizontal__link_groups',
      'sub_fields' => [
        [
          // Headline
          'type' => 'group',
          'label' => 'CTA Block',
          'name' => 'group',
          'required' => 0,
          'sub_fields' => [
            [
              'type' => 'link',
              'label' => 'Link',
              'name' => 'link',
              'instructions' => 'Recommended character count max: 30',
              'required' => 0,
              'maxlength' => '',
              'wrapper' => array (
                'width' => '40',
              ),
            ],
            [
              'type' => 'radio',
              'label' => 'Type',
              'name' => 'type',
              'instructions' => '',
              'required' => 0,
              'maxlength' => '',
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
              'name' => 'icon',
              'instructions' => 'Note: mailto urls will always get a mailto icon unless you specify none.',
              'required' => 0,
              'maxlength' => '',
              'choices' => array(
                'default' => 'Default',
                'mailto' => 'Mailto',
                'external' => 'External',
                'download' => 'Download',
                'none' => 'None',
              ),
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
      'button_label'  => 'Add CTA Block',
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
