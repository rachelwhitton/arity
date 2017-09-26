<?php

if (!empty($data['image_id'])) {
  $data['size'] = 'full';
  $data['background-image'] = wp_get_attachment_image_src($data['image_id'], $data['size'])[0];
}

return $data;
