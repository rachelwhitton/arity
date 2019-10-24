<?php
namespace App\Theme;

/*
  Template Name:      Button
  Template Type:      Element
  Description:
  Last Updated:       10/23/2019
  Since:              2.3.1
*/
// echo 'Custom CTA <pre>';print_r($data);echo '</pre>';
?>

<a href="<?=$data['url'];?>" <?php element_class($data['classes']); ?><?php if (!empty($data['target'])) : ?> target="<?=$data['target'];?>"<?php endif; ?> data-analytics="<?=$data['analytics'];?>">
  <?php if (!empty($data['icon'])) : ?>
    <?php if ($data['icon'] != 'none') : ?>
      <svg class="button__icon icon-svg <?= $data['icon']; ?>" title="" role="img">
        <use xlink:href="#<?=$data['icon'];?>"></use>
      </svg>
    <?php endif; ?>
  <?php endif; ?>
  <span class="button__label"><?=$data['title'];?></span>
</a>
