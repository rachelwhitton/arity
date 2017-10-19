<?php

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
  if(empty($GLOBALS['h1_used'])) {
    $GLOBALS['h1_used'] = true;
    $data['h_el'] = 'h1';
  }
}

return $data;
