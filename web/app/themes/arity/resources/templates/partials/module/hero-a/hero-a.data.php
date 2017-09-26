<?php

// Headline is required.
if (empty($data['headline'])) {
  return false;
}

// Body Copy is required.
if (empty($data['body_copy'])) {
  return false;
}

// Classes
$data['classes'][] = 'hero-a';

if (empty($data['image_id'])) {
  $data['classes'][] = 'hero-a--wo-image';
} else {
  $data['classes'][] = 'hero-a--image';
}

return $data;
