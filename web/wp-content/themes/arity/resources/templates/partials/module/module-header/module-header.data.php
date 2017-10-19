<?php

if (empty($data['headline'])) {
  return false;
}

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

return $data;
