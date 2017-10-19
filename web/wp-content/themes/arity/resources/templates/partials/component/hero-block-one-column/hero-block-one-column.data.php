<?php

if (empty($data['headline'])) {
  return false;
}

if (empty($data['body_copy'])) {
  return false;
}

if(empty($data['h_el'])) {
  $data['h_el'] = 'h1';
}

return $data;
