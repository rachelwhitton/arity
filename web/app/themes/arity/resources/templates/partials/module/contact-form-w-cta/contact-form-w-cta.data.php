<?php

$data['classes'][] = 'contact-form-with-cta';

if (!empty($data['color_theme'] && $data['color_theme'] == 'dark')) {
  $data['classes'][] = $data['color_theme'].'--';
}

return $data;
