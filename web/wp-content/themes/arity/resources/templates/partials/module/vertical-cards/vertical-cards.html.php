<?php
namespace App\Theme;

/*
  Template Name:      Vertical Cards
  Template Type:      Module
  Description:        A row of vertical cards.
  Last Updated:       08/02/2017
  Since:              1.0.0
*/

?>
<div <?php module_class('vertical-cards'); ?>>
  <?php if (!empty($data['headline'])) : ?>
    <div class="row">
      <div class="vertical-cards__title">
        <<?= $data['h_el']; ?> class="type4 colors__text--white"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
      </div>
    </div>
  <?php endif; ?>
  <div class="row">
    <?php foreach ($data['cards'] as $card) : ?>
      <div class="vertical-cards__col">
        <?php the_partial($card); ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>
