<?php

$data['classes'][] = 'promo';

if(!empty($data['padding'])){
  $data['classes'][] = 'promo--padding';
  if(!empty($data['padding'][0])){
    if($data['padding'][0]=='top'){
      $data['classes'][] = 'promo--padding-top';
    }else{
      $data['classes'][] = 'promo--padding-bottom';
    }
  }
  if(!empty($data['padding'][1])){
    if($data['padding'][1]=='top'){
      $data['classes'][] = 'promo--padding-top';
    }else{
      $data['classes'][] = 'promo--padding-bottom';
    }
  }
}

return $data;
