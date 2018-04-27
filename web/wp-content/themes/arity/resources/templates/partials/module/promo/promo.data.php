<?php

$data['classes'][] = 'promo';

if(!empty($data['padding'])){
  $data['classes'][] = 'promo--padding';
  if(!empty($data['padding'][0])){
    $data['classes'][] = 'promo--padding-top';
  }
  if(!empty($data['padding'][1])){
    $data['classes'][] = 'promo--padding-bottom';
  }
}

return $data;
