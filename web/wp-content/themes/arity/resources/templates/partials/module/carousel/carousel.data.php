<?php

$data['classes'][] = 'block-carousel-cont';
$data['classes'][] = 'ar-module__no-margin';

// foreach ($data['carousel-items'] as $item) {
// 	$item['img-classes'][] = 'd-block';
// 	$item['img-classes'][] = 'w-100';
// }

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

return $data;
