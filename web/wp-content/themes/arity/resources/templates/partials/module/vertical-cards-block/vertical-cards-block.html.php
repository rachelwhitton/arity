<?php
namespace App\Theme;

/*
  Template Name:      Vertical Cards Block
  Template Type:      Module
  Description:        A row of vertical cards in block
  Last Updated:       12/01/2017
  Since:              1.2.0-alpha.1
*/

?>
<div class="vertical-cards-block">
  <div class="vertical-cards-block__row">
    <div class="vertical-cards-block__content">
      <?php if (!empty($data['headline'])) : ?>
        <div class="row">
          <div class="vertical-cards__title boldTitle">
            <<?= $data['h_el']; ?> class="type0 colors__text--white"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
          </div>
        </div>
      <?php endif; ?>
      <div class="row center">
        <?php foreach ($data['cards'] as $card) : ?>
          <div class="vertical-cards__col">
            <?php the_partial($card); ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
