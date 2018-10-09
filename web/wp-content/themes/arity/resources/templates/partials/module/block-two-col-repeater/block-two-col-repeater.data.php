<?php

$data['classes'][] = 'block-two-column-repeater';

if (empty($data['headline-alignment'])) {
  $data['headline-alignment'] = 'center';
}

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

return $data;
