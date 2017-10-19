<?php

if (empty($data['--settings_layout'])) {
  $data['--settings_layout'] = false;
}

$data['classes'][] = 'hero-b';

if(empty($data['h_el'])) {
  $data['h_el'] = 'h1';
}

return $data;
