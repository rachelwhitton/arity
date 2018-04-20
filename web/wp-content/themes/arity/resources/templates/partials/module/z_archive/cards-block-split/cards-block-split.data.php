<?php

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

$data['classes'][] = 'cards-block-split';
$data['bottom-classes'][] = 'split-bg__bottom';

if($data['--settings_alignment']=="layout__half-bg") {
  $data['classes'][] = 'cards-block-split--half-bg';
  $data['classes'][] = $data['bg-color_top'];
  $data['bottom-classes'][] = $data['bg-color_bot'];
}else{
  $data['classes'][] = 'cards-block-split--full-bg';
  $data['classes'][] = $data['bg-color'];
}

return $data;
