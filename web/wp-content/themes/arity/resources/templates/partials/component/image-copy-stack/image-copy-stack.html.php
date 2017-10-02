<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Image/Copy Stack
  Template Type:      Component
  Description:        Headline, image, copy, cta stack
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

?>
<div class="ar-component image-copy-stack">
  <?php if (!empty($data['headline'])) : ?>
    <div class="image-copy-stack__headline type6">
      <?= $data['headline']; ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($data['image_id'])) : ?>
    <?php element('image', [
      'id' => $data['image_id']
    ]); ?>
  <?php endif; ?>
  <?php if (!empty($data['body_copy'])) : ?>
    <div class="image-copy-stack__p type0">
      <?= apply_filters('the_content', $data['body_copy']); ?>
    </div>
  <?php endif; ?>
  <?php if (!empty($data['cta'])) : ?>
    <?php component('cta', $data['cta']); ?>
  <?php endif; ?>
</div>
