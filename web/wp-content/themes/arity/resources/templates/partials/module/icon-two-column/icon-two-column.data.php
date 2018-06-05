<?php

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

// Classes
$data['classes'][] = 'body-column';
$data['classes'][] = 'icon-two-column';
$data['classes'][] = 'block-content-icon-pair';

return $data;
