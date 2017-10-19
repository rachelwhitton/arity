<?php

$data['classes'][] = 'content-image-block';

// Background Color Class
if (!empty($data['bkg_color'])) {
  $data['classes'][] = 'colors__bg--'.$data['bkg_color'];
}

// Layout Class
if (!empty($data['layout'])) {
  $data['classes'][] = 'content-image-block--'.$data['layout'];
}

$data['headline'] = App\Theme\wrapSymbols($data['headline']);

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

return $data;
