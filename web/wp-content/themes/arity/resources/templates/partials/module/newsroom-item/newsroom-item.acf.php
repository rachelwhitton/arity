<?php
namespace App\Theme;

// ACF Fields
$fields = [
    // Vertical Card
    acf_repeater([
      'label' => '',
      'name' => 'newsroom-item__items',
      'sub_fields' => [
        acf_text([
            'name' => 'headline',
            'label' => 'Headline',
            'instructions' => 'Add the item\'s headline.',
            'required' => true,
        ]),
        acf_text([
          'name' => 'link',
          'label' => 'Link to news item',
          'instructions' => 'Add the item\'s URL.',
          'required' => true,
        ]),
        acf_textarea([
            'name' => 'description',
            'label' => 'Description',
            'instructions' => 'Add the item\'s description text.',
            'required' => true,
        ]),
        acf_text([
          'name' => 'publication',
          'label' => 'Publication',
          'instructions' => 'Add the item\'s publication source.',
          'required' => true,
        ]),
        acf_date_picker([
          'name' => 'publication-date',
          'label' => 'Publication Date',
          'instructions' => 'Add the publication date.',
          'required' => true,
          'display_format' => 'F d, Y',
          'return_format' => 'F d, Y',
      ]),
    ],
      'layout'      => 'block',
            'button_label'  => 'Add Item',
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Module - Newsroom Item',
    'name' => 'module__newsroom-item',
    'key' => 'group_module_newsroom-item',
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
