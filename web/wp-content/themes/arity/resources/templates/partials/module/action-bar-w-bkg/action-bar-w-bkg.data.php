<?php

if (empty($data['left_headline']) &&
  empty($data['left_content'])
) {
  return false;
}

$data['classes'][] = 'action-bar-w-bkg';

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

return $data;
