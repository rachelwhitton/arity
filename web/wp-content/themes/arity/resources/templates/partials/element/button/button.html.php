<?php
namespace App\Theme;

/*
  Template Name:      Button
  Template Type:      Element
  Description:
  Last Updated:       08/15/2017
  Since:              1.0.0
*/
// echo 'Custom CTA <pre>';print_r($data);echo '</pre>';
?>

<a href="<?= $data['url']; ?>" <?php element_class($data['classes']); ?><?php if (!empty($data['target'])) : ?> target="<?= $data['target']; ?>"<?php endif; ?> data-analytics="<?= $data['analytics']; ?>">
  <?php if (!empty($data['icon'])) : ?>
    <?php if ($data['icon'] != 'none') : ?>
    <span class="button__icon">
      <?php
      if ($data['icon'] === 'external' || $data['icon'] === 'download') {
        $inline = ' style="width: 22px; height: 22px; top: -2px;"';
      } else {
        $inline = '';
      }
      ?>
      <svg class="icon-svg <?= $data['icon']; ?>" title="" role="img"<?= $inline; ?>>
        <use xlink:href="#<?= $data['icon']; ?>"></use>
      </svg>
    </span>
    <?php endif; ?>
  <?php endif; ?>
  <span class="button__label"><?= $data['title']; ?></span>
</a>
