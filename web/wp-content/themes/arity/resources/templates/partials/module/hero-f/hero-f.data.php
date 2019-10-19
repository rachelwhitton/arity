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
$data['classes'][] = 'hero-f';

$data['classes'][] = 'ar-module--no-margin';

return $data;
