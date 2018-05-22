<?php

if (empty($data['left_headline']) &&
  empty($data['left_content'])
) {
  return false;
}

$data['classes'][] = 'action-bar-w-bkg';
$data['classes'][] = 'ar-module--no-margin';

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

if(!empty($data['bkg_image_id']) && empty($data['bkg_image'])) {
  $data['bkg_image'] = wp_get_attachment_image_src($data['bkg_image_id'], 'full');
  $data['bkg_image'] = $data['bkg_image'][0];
}

return $data;
