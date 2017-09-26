<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Text with Icon
  Template Type:      Component
  Description:        Text with icon floated to the left
  Last Updated:       08/03/2017
  Since:              1.0.0
*/

// var_dump($data);
?>
<div <?php component_class('text-icon'); ?>>
  <?php if (!empty('headline')) : ?>
    <div class="text-icon__icon">
      <svg class="icon-svg" title="" role="img">
        <use xlink:href="#<?= $data['icon']; ?>"/>
      </svg>
    </div>
  <?php endif; ?>
  <div class="text-icon__point">
    <?php if (!empty('headline')) : ?>
      <div class="text-icon__headline type0"><?= $data['headline']; ?></div>
    <?php endif; ?>
    <?php if (!empty('body_copy')) : ?>
      <div class="text-icon__p">
        <?= apply_filters('the_content', $data['body_copy']); ?>
      </div>
    <?php endif; ?>
  </div>
</div>
