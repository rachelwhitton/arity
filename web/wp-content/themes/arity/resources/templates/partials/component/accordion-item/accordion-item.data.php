<?php

if(empty($data['h_el'])) {
  $data['h_el'] = 'h4';
}

$data['aid'] = rand(1, 1000000);

return $data;
