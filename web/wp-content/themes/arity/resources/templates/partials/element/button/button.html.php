<?php
namespace App\Theme;

/*
  Template Name:      Button
  Template Type:      Element
  Description:
  Last Updated:       08/15/2017
  Since:              1.0.0
*/

?>

<a href="<?= $data['url']; ?>" <?php element_class($data['classes']); ?><?php if (!empty($data['target'])) : ?> target="<?= $data['target']; ?>"<?php endif; ?>>
  <?php if (!empty($data['icon'])) : ?>
    <svg class="icon-svg" title="" role="img">
      <use xlink:href="#<?= $data['icon']; ?>"/>
    </svg>
  <?php endif; ?>
  <span class="button__label"><?= $data['title']; ?></span>
</a>