<?php

if (empty($data['blocks'])) {
  return false;
}

if(empty($data['h_el'])) {
  $data['h_el'] = 'h2';
}

return $data;
