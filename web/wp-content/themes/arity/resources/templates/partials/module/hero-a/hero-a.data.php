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
$data['classes'][] = 'hero-a';

if (empty($data['image_id'])) {
  $data['classes'][] = 'hero-a--wo-image';
} else {
  $data['classes'][] = 'hero-a--image';
}

return $data;
