<?php

if (empty($data['center_headline']) &&
  empty($data['center_content'])
) {
  return false;
}

$data['classes'][] = 'action-bar-one-col-cta';
$data['classes'][] = 'ar-module--no-margin';

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

return $data;
