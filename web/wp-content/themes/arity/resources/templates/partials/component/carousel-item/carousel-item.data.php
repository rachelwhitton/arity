<?php

$data['attrs'] = array(
	'class' => 'd-block w-100 c-img',
	'alt' => get_post_meta($data['image_id'], '_wp_attachment_image_alt', true)
);
// Make full the default image size if nothing is passed
if (!empty($data['image_id']) && empty($data['size'])) {
  $data['size'] = 'full';
}

return $data;
