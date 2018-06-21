<?php

$data['classes'][] = 'promo-card-horizontal';
$data['bottom-classes'][] = 'split-bg__bottom';

if($data['--settings_alignment']=="layout__half-bg") {
  $data['classes'][] = 'promo-card-horizontal--half-bg';
  $data['classes'][] = $data['bg-color_top'];
  $data['bottom-classes'][] = $data['bg-color_bot'];
}else{
  $data['classes'][] = 'promo-card-horizontal--full-bg';
  $data['classes'][] = $data['bg-color'];
}

// Layout Class
if (!empty($data['layout'])) {
  $data['classes'][] = 'promo-card-horizontal--'.$data['layout'];
}

if(!empty($data['image_id']) && empty($data['bkg_image'])) {
  $data['bkg_image'] = wp_get_attachment_image_src($data['image_id'], 'full');
  $data['bkg_image'] = $data['bkg_image'][0];
}

return $data;
