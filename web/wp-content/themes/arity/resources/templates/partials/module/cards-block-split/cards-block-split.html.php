<?php
namespace App\Theme;

/*
  Template Name:      Cards Block with Split Background
  Template Type:      Module
  Description:        A row of cards with a split background
  Last Updated:       12/01/2017
  Since:              1.6.4
*/

?>
<div <?php module_class('cards-block-split'); ?> style="background-color: <?= $data['bg-color_top']; ?>">
  <?php if (!empty($data['headline'])) : ?>
    <div class="container">
      <div class="row">
        <div class="cards-block-split__header anim-ready">
          <?php if(!empty($data['eyebrow'])) : ?>
            <?php element('eyebrow', array(
              'classes' => 'eyebrow',
              'label' => $data['eyebrow']
            )); ?>
          <?php endif; ?>

          <?php if (!empty($data['headline'])) : ?>
            <?php element('headline', array(
            'classes' => 'cards-block-split__title',
            'headline' => $data['headline']
          )); ?>
          <?php endif; ?>

          <?php if(!empty($data['subhead'])) : ?>
            <div class="cards-block-split__subhead">
              <?= $data['subhead']; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="container">
    <div class="row">
      <?php $count = 0; ?>
      <?php foreach ($data['cards'] as $card) : ?>
        <?php $count++; ?>
        <div class="cards-block-split__col anim-ready anim-block-<?php echo $count; ?>">
          <?php the_partial($card); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="split-bg__bottom" style="background-color: <?= $data['bg-color_bot']; ?>"></div>
</div>
