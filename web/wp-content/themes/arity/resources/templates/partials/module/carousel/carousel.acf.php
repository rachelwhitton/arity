<?php
namespace App\Theme;

// ACF Fields
$fields = [
	// carousel ID
	acf_text([
		'label' => 'Carousel ID',
		'name' => 'carousel__carousel-id',
		'key' => 'field_carousel-id',
		'instructions' => 'Enter a unique ID for this carousel. Use only letters, numerals, and hyphen (-) or underscore (_).<br>Do not begin an ID with a numeral.',
		'required' => 1,
		'maxlength' => '',
		'wrapper' => array(
			'width' => '100',
		),
	]),
	// carousel items
	acf_repeater([
		'label' => 'Carousel slides',
		'name' => 'carousel__carousel-items',
		'sub_fields' => [
			// image
      acf_image([
        'label' => 'Images',
        'name' => 'image_id',
        'key' => 'field_image_id',
        'return_format' => 'id',
        'instructions' => 'Suggested image size: <br>2400 &times; 1286 px',
        'required' => 1,
        'preview_size'  => 'thumbnail',
        'wrapper' => array (
          'width' => '33',
        ),
      ]),
      // caption
      acf_text([
    		'label' => 'Captions',
    		'name' => 'image_caption',
    		'key' => 'field_image-caption',
    		'instructions' => 'Recommended character count max: 120',
    		'required' => 0,
    		'maxlength' => '',
    		'wrapper' => array(
    			'width' => '66',
    		),
      ]),
		],
		'button_label' => 'Add slide',
	]),
];

acf_field_group([
	'title' => 'Module - Block: Carousel',
	'name' => 'module__carousel',
  'key' => 'group_module_carousel',
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
