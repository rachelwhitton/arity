<?php

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

$data['classes'][] = 'vertical-cards-block';
$data['classes'][] = 'block-cards-image';
$data['classes'][] = $data['bg-color'];

return $data;
