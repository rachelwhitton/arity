<?php
namespace App\Theme;

// ACF Fields
$fields = [

	// This module provides a wrapper for custom feature content
	// acf_message([
	//   'label' => '',
	//   'name' => 'content-custom-feature__custom-feature-message',
	//   'instructions' => '',
	//   'message' => ''
	// ]),
	
	// Custom content selector
	acf_select([
		'label' => 'Choose custom content',
    'name' => 'content-custom-feature__custom-content',
    'key' => 'field_custom-content',
    'required' => 0,
    'allow_null' => 0,
    'ui' => 1,
    'default_value' => 'custom-content-selector',
    'choices' => [
      'custom-content-selector' => 'Custom content selector',
      'marketplace-risk-graphic' => 'Marketplace risk graphic',
      'about-us-data-grid' => "About Us data grid"
    ]
	]),
	// acf_flexible_content([
	// 	'label' => '',
	// 	'name' => 'content-custom-feature__custom-content',
	// 	'key' => 'field_content',
	// 	'instructions' => '',
	// 	'required' => 0,
	// 	'min' => 1,
	// 	'button_label' => 'Add custom content'
	// ]),

];

// ACF Field Group
acf_field_group([
	'title' => 'Module - Content: Custom feature',
	'name' => 'module__content-custom-feature',
	'key' => 'group_module_content-custom-feature',
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