<?php

if(empty($data['h_el'])) {
  $data['h_el'] = 'h1';
}

if(!empty($data['bkg_image_id']) && empty($data['bkg_image'])) {
  $data['bkg_image'] = wp_get_attachment_image_src($data['bkg_image_id'], 'full');
  $data['bkg_image'] = $data['bkg_image'][0];
}

return $data;
