<?php

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

$data['classes'][] = 'block-cards';
$data['bottom-classes'][] = 'split-bg__bottom';

if($data['--settings_alignment']=="layout__half-bg") {
  $data['classes'][] = 'block-cards--half-bg';
  $data['classes'][] = $data['bg-color_top'];
  $data['bottom-classes'][] = $data['bg-color_bot'];
}else{
  $data['classes'][] = 'block-cards--full-bg';
  $data['classes'][] = $data['bg-color'];
}

return $data;
