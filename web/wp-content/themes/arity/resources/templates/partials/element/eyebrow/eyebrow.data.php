<?php

// Label is required
if (empty($data['label'])) {
  return false;
}

$classes[] = 'eyebrow';
$classes[] = 'type5';

if (empty($data['classes'])) {
  $data['classes'] = [];
}
$data['classes'] = array_merge($classes, $data['classes']);

if (empty($data['h_el'])) {
  $data['h_el'] = 'h3';
}

return $data;
?>
