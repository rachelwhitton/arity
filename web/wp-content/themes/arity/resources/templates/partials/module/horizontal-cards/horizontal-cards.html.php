<?php
namespace App\Theme;

/*
  Template Name:      Horizontal Cards
  Template Type:      Module
  Description:        A row of horizontal cards.
  Last Updated:       08/02/2017
  Since:              1.0.0
*/

?>
<div <?php module_class('horizontal-cards'); ?>>
  <?php if (!empty($data['headline'])) : ?>
    <div class="row">
      <div class="horizontal-cards__title">
        <<?= $data['h_el']; ?> class="type4 colors__text--white"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
      </div>
    </div>
  <?php endif; ?>
  <div class="row">
    <?php foreach ($data['cards'] as $card) : ?>
      <div class="horizontal-cards__col">
        <?php the_partial($card); ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>
