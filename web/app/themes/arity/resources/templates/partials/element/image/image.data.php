<?php

// Id or src is required to be a valid image
if (empty($data['id']) && empty($data['attrs'])) {
  trigger_error("An id or src must be passed to the image element.");
  return false;
}

// Make the full the default image size if nothing is passed
if (!empty($data['id']) && empty($data['size'])) {
  $data['size'] = 'full';
}

// Attrs must be an array
if (empty($data['attrs'])) {
  $data['attrs'] = array();
}

// Build Attribute class
if (!empty($data['classes'])) {
  if (empty($data['attrs']['class'])) {
    $data['attrs']['class'] = '';
  }
  $data['classes'] = array_merge(explode(' ', $data['attrs']['class']), $data['classes']);
  $data['classes'] = array_unique($data['classes']);
  $data['attrs']['class'] = join(' ', $data['classes']);
  unset($data['classes']);
}

return $data;
