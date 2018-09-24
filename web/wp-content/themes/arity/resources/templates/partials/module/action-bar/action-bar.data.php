<?php

if (empty($data['left_headline']) &&
  empty($data['left_content']) &&
  empty($data['center_headline']) &&
  empty($data['center_content']) &&
  empty($data['right_headline']) &&
  empty($data['right_content'])
) {
  return false;
}

if (empty($data['bkg_color'])){
  $bgcolor = 'colors__bg--blue';
}else{
  $bgcolor = $data['bkg_color'];
}

$data['classes'][] = 'action-bar';
$data['classes'][] = $bgcolor;
$data['classes'][] = 'ar-module--no-margin';

if ($data['right_headline'] || $data['right_content']) {
  $data['classes'][] = 'has-divider';
}

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

return $data;
