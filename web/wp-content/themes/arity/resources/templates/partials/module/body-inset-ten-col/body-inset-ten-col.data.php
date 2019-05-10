<?php

$data['classes'][] = 'body-column';
$data['classes'][] = 'body-inset-ten-col';
$data['classes'][] = 'text-module-standard';

if (!empty($data['background-color'])) {
  $data['classes'][] = 'body-inset-ten-col__'.$data['background-color'].'-bg';
}

// if(empty($data['h_el'])) {
//   $data['h_el'] = 'h2';
// }

return $data;
