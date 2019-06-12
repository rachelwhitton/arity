<?php

$data['classes'][] = 'block-two-column';
$data['classes'][] = 'block-two-column-narrow';


// Background Color Class
if (!empty($data['bkg_color'])) {
  $data['classes'][] = 'colors__bg--'.$data['bkg_color'];
}

if (!empty($data['layout'])) {
  $data['classes'][] = 'block-two-column-narrow--'.$data['layout'];
}

if (empty($data['headline-alignment'])) {
  $data['headline-alignment'] = '';
}

if(!empty($data['shadow'])){
  $data['img-classes'] = 'img-shadow';
}else{
  $data['img-classes'] = '';
}

$data['headline'] = App\Theme\wrapSymbols($data['headline']);

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

return $data;
