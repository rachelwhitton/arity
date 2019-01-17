<?php

$data['classes'][] = 'promo';

if(!empty($data['padding'])){
  $data['classes'][] = 'promo--padding';
  if(!empty($data['padding'][0])){
    if($data['padding'][0]=='top'){
      $data['classes'][] = 'promo--padding-top';
    }elseif($data['padding'][0]=='bottom'){
      $data['classes'][] = 'promo--padding-bottom';
    }else{
      $data['classes'][] = 'promo--remove-all-padding';
    }
  }
  if(!empty($data['padding'][1])){
    if($data['padding'][1]=='top'){
      $data['classes'][] = 'promo--padding-top';
    }elseif($data['padding'][1]=='bottom'){
      $data['classes'][] = 'promo--padding-bottom';
    }else{
      unset($data['classes']);
      $data['classes'] = array('promo', 'promo--padding', 'promo--remove-all-padding');
    }
  }
  if(!empty($data['padding'][2])){
    unset($data['classes']);
    $data['classes'] = array('promo', 'promo--padding', 'promo--remove-all-padding');
  }
}

return $data;
