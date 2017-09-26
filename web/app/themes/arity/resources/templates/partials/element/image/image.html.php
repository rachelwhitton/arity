<?php
namespace App\Theme;

/*
Template Name:      Image
Template Type:      Element
Description:
Last Updated:       08/02/2017
Since:              1.0.0
*/
?>
<span <?php element_class('image'); ?>>
  <?php if (!empty($data['id'])) : ?>
    <?= wp_get_attachment_image($data['id'], $data['size'], null, $data['attrs']); ?>
  <?php else : ?>
    <img <?= arrayToAttrs($data['attrs']); ?>>
  <?php endif; ?>
</span>
