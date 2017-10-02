<?php

if (empty($data['headline'])) {
  return false;
}

if (empty($data['body_copy'])) {
  return false;
}

return $data;
