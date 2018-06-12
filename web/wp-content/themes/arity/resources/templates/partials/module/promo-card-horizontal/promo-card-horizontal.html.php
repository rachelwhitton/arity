<?php
namespace App\Theme;

/*
  Template Name:      Horizontal Card with Split Background
  Template Type:      Module
  Description:        A horizontal 2 col card with a split background
  Last Updated:       3/01/2017
  Since:              1.6.4
*/

?>
<div <?php module_class('promo-card-horizontal'); ?> style="background-color: <?= $data['bg-color_top']; ?>">
  <div class="container">
    <div class="row">

      <div class="card card--horizontal-split promo-card-horizontal__col">
        <div class="card__inner">
          <?php if (!empty($data['image_id'])) : ?>
            <div class="card__top">
              <?php template('partials/element/image/image', array(
                'id' => $data['image_id']
              )); ?>
            </div>
          <?php endif; ?>
          <div class="card__bottom">
            <?php if(!empty($data['eyebrow'])) : ?>
              <?php element('eyebrow', array(
                'classes' => 'eyebrow',
                'label' => $data['eyebrow']
              )); ?>
            <?php endif; ?>

            <?php if (!empty($data['headline'])) : ?>
              <?php element('headline', array(
              'classes' => 'promo-card-horizontal__title',
              'headline' => $data['headline']
            )); ?>
            <?php endif; ?>

            <?php if(!empty($data['body-copy'])) : ?>
              <div class="promo-card-horizontal__body-copy">
                <?= $data['body-copy']; ?>
              </div>
            <?php endif; ?>

            <?php if (!empty($data['cta'])) : ?>
                <?php
                  $data['cta']['classes'] = array('button--primary', 'blue-button--');
                  element('button', $data['cta']);
                ?>
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="split-bg__bottom" style="background-color: <?= $data['bg-color_bot']; ?>"></div>
</div>
