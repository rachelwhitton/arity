<?php

$data['classes'][] = 'block-two-column';

if($data['content-chooser']=='layout__datavis'){
  $data['classes'][] = 'content-datavis-block';
}else{
  $data['classes'][] = 'content-image-block';
}

// Background Color Class
if (!empty($data['bkg_color'])) {
  $data['classes'][] = 'colors__bg--'.$data['bkg_color'];
}

// Layout Class
if (!empty($data['layout'])) {
  if($data['content-chooser']=='layout__datavis'){
    $data['classes'][] = 'content-datavis-block--'.$data['layout'];
  }else{
    $data['classes'][] = 'content-image-block--'.$data['layout'];
  }
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
