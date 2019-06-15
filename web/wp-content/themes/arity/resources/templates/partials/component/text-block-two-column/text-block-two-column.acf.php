<?php
namespace App\Theme;

// ACF Fields
$fields = [

    // Eyebrow
    acf_text([
      'label' => 'Eyebrow',
      'name' => 'text-block-two-column__eyebrow',
      'key' => 'field_eyebrow',
      'instructions' => 'Recommended character count max: 42',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '66',
      )
    ]),        
    
    // Header/Eyebrow Alignment
    acf_select([
      'label' => 'Layout',
      'name' => 'text-block-two-column__--settings_alignment',
      'key' => 'text-block-two-column_--settings_alignment',
      'instructions' => '<br/>',
      'required' => 0,
      'maxlength' => '',
      'allow_null' => 0,
      'ui' => 1,

      'wrapper' => array (
        'width' => '33',
      ),
      'default_value' => 'layout__left-align',
      'choices' => [
        'layout__left-align' => 'Left Align',
        'layout__center-align' => 'Center Align',
      ]
    ]),

    // Headline
    acf_text([
      'label' => 'Headline',
      'name' => 'text-block-two-column__headline',
      'key' => 'field_headline',
      'instructions' => 'Recommended character count max: 52',
      'required' => 0,
      'maxlength' => '',
      'wrapper' => array (
        'width' => '100',
      )
    ]),    

    // Two Column Tab for Left Column
    acf_tab([
      'label' => 'Left Column',
      'name' => 'text-block-two-column__left_column_tab',
    ]),

    // Left Column Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'text-block-two-column__left_column_body_copy',
      'instructions' => 'Recommended character count max: 280',
      'required' => 1,
      'new_lines' => 'wpautop'
    ]),

    // Two Column Tab for Right Column
    acf_tab([
      'label' => 'Right Column',
      'name' => 'text-block-two-column__right_column_tab',
    ]),

    // Right Column Body Copy
    acf_textarea([
      'label' => 'Body Copy',
      'name' => 'text-block-two-column__right_column_body_copy',
      'instructions' => 'Recommended character count max: 280',
      'required' => 1,
      'new_lines' => 'wpautop'
    ]),

    // Tab for Footnote
    acf_tab([
      'label' => 'Footnote',
      'name' => 'text-block-two-column__footnote_tab',
    ]),

    // Left Column Footnote Copy
    acf_textarea([
      'label' => 'Footnote',
      'name' => 'text-block-two-column__footnote',
      'instructions' => 'Recommended character count max: 100',
      'required' => 0,
      'new_lines' => 'wpautop'
    ]),

];

// ACF Field Group
acf_field_group([
    'title' => 'Component - Text Block: 2 Column',
    'name' => 'component__text-block-two-column',
    'key' => 'group_component_text-block-two-column',
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
