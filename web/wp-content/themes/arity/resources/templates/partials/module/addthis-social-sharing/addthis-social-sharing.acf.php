<?php
namespace App\Theme;

// ACF Fields
$fields = [

  acf_checkbox([
      'name' => 'addthis-social-sharing__enable',
      'label' => 'Enable AddThis Social Sharing',
      //'instructions' => 'Select to enable AddThis social sharing',
      'choices' => [
          '1' => ''
      ]
    ])

];

// ACF Field Group
acf_field_group([
  'title' => 'Module - AddThis Social Sharing Widget',
  'name' => 'module__addthis-social-sharing',
  'key' => 'group_module_addthis-social-sharing',
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