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
$data['classes'][] = 'hero-a';

if (empty($data['image_id'])) {
  $data['classes'][] = 'hero-a--wo-image';
} else {
  $data['classes'][] = 'hero-a--image';
}

if (empty($data['background-video'])) {
  $data['classes'][] = 'hero-a--wo-bg-video';
} else {
  $data['classes'][] = 'hero-a--bg-video';
}

if( $data['dotted'] || (empty($data['image_id']) && empty($data['background-video'])) ){
  $data['classes'][] = 'hero-a--dotted';
}else{
  $data['classes'][] = 'hero-a--no-dots';
}

if (!empty($data['animation'])) {
  $data['classes'][] = 'dots-anim-ready';
  $data['classes'][] = 'anim-reverse';
  $data['animation'] = true;
}

$data['classes'][] = 'ar-module--no-margin';

return $data;
