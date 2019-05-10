<?php

if (empty($data['--settings_layout'])) {
  $data['--settings_layout'] = false;
}

$data['classes'][] = 'hero-concise';
$data['classes'][] = 'hero-b';
$data['classes'][] = 'ar-module--no-margin';

if(!empty($data['background-color'])) {
	$data['classes'][] = 'hero-b__'.$data['background-color'].'-bg';
}

if(empty($data['h_el'])) {
  $data['h_el'] = 'h1';
}

return $data;
