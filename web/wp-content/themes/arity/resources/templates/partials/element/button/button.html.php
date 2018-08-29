<?php
namespace App\Theme;

/*
  Template Name:      Button
  Template Type:      Element
  Description:
  Last Updated:       08/15/2017
  Since:              1.0.0
*/
//echo 'Custom CTA <pre>';print_r($data);echo '</pre>';
?>

<a href="<?= $data['url']; ?>" <?php element_class($data['classes']); ?><?php if (!empty($data['target'])) : ?> target="<?= $data['target']; ?>"<?php endif; ?> data-analytics="<?= $data['analytics']; ?>">
  <?php if (!empty($data['icon'])) : ?>
    <span class="button__icon">
      <svg class="icon-svg <?= $data['icon']; ?>" title="" role="img">
        <use xlink:href="#<?= $data['icon']; ?>"></use>
      </svg>
    </span>
  <?php endif; ?>
  <span class="button__label"><?= $data['title']; ?></span>
</a>
