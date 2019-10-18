<?php

// Headline is required.
if (empty($data['headline'])) {
  return false;
}

// Body Copy is required.
if (empty($data['body_copy'])) {
  return false;
}

if(empty($data['h_el'])) {
  $data['h_el'] = 'h1';
}

// Classes
$data['classes'][] = 'hero-elaborated';
$data['classes'][] = 'hero-e';

if (empty($data['image_id'])) {
  $data['classes'][] = 'hero-e--wo-image';
} else {
    $data['classes'][] = 'hero-e--image';
}

if($data['dotted'] || empty($data['image_id'])){
  $data['classes'][] = 'hero-e--dotted';
}else{
  $data['classes'][] = 'hero-e--no-dots';
}

if (!empty($data['animation'])) {
  $data['classes'][] = 'dots-anim-ready';
  $data['classes'][] = 'anim-reverse';
  $data['animation'] = true;
}

$data['classes'][] = 'ar-module--no-margin';

return $data;
