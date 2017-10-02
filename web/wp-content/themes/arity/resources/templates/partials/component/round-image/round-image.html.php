<?php
namespace App\Theme;

/*
  Template Name:      Round Image
  Template Type:      Component
  Description:        Round background image included for big feature block
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

?>
<div <?php component_class('round-image'); ?>>
  <div class="round-image__inner">
    <?php element('image', [
      'id' => $data['image_id']
    ]); ?>
  </div>
</div>
