<?php

if (empty($data['headline'])) {
  return false;
}

if (empty($data['body_copy'])) {
  return false;
}

if(empty($data['h_el'])) {
  $data['h_el'] = 'h3';
}

if(empty($data['eyebrow'])) {
  $data['h_el'] = 'h2';
}

return $data;
