<?php

$data['classes'][] = 'contact-form-with-cta';

if (!empty($data['color_theme'] && $data['color_theme'] == 'dark')) {
  $data['classes'][] = $data['color_theme'].'--';
}

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

return $data;
