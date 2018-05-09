<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Text with Image
  Template Type:      Component
  Description:        Text with image floated to the left
  Last Updated:       05/10/2018
  Since:              1.9.0
*/
?>
<div <?php component_class('text-icon'); ?>>
  <?php if (!empty($data['image_id'])) : ?>
    <div class="text-icon__image">
      <?php element('image', [
        'id' => $data['image_id']
      ]); ?>
    </div>
  <?php endif; ?>
  <div class="text-icon__point">
    <?php if (!empty('headline')) : ?>
      <<?= $data['h_el']; ?> class="text-icon__headline type4"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
    <?php endif; ?>
    <?php if (!empty('body_copy')) : ?>
      <div class="text-icon__p type4">
        <?= apply_filters('the_content', $data['body_copy']); ?>
      </div>
    <?php endif; ?>
  </div>
</div>
