<?php

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

$data['classes'][] = 'block-highlights';
$data['classes'][] = $data['bg-color'];


if($data['bg-color']=="block-highlights--navy-bg") {
  $data['highlights-classes'][] = 'highlight-block--navy-bg';
}else{
  $data['highlights-classes'][] = '';
}

return $data;
