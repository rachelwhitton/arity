<?php

if (empty($data['center_headline']) &&
  empty($data['center_content'])
) {
  return false;
}

$data['classes'][] = 'action-bar-one-col-cta';
$data['classes'][] = 'ar-module--no-margin';
$data['classes'][] = $data['content-image-block__bkg_color'];

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

return $data;
