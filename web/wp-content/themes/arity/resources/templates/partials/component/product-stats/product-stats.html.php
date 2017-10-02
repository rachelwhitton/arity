<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Product Stats
  Template Type:      Component
  Description:        Highlight key figures/numbers separate from headline or body copy.
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

?>

<?php foreach ($data['stats'] as $stat) : ?>
  <div <?php component_class('product-stats'); ?>>
    <div class="type2 product-stats__value<?php if (!empty($stat['stat_color'])) : ?> <?= $stat['stat_color'] ?>--<?php endif; ?>"><?= $stat['value_before']; ?><span id="product-stats__value_<?= $stat['value_id']; ?>" data-animstart="<?= $stat['value_start']; ?>" data-animvalue="<?= $stat['value']; ?>" data-animdecimal="<?= $stat['value_decimals']; ?>"><?= $stat['value']; ?></span><?= $stat['value_after']; ?></div>
    <div class="type0 product-stats__p">
      <?= $stat['text_below']; ?>
    </div>
  </div>
<?php endforeach; ?>
