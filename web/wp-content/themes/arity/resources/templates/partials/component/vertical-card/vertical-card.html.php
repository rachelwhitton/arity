<?php
namespace App\Theme;

/*
  Template Name:      Vertical Card
  Template Type:      Component
  Description:        A card is used to apply a container around a related grouping of information and that serves as an entry point to more detailed information.
  Last Updated:       12/06/2017
  Since:              1.2.1
*/

?>
<?php if (!empty($data['cta']) && $data['button_style'] == 'yellow') : ?>
<a href="<?= $data['cta']['url']; ?>"<?php if (!empty($data['cta']['target'])) : ?> target="<?= $data['cta']['target']; ?>"<?php endif; ?> <?php component_class('card card--vertical'); ?>>
  <?php else : ?>
  <div <?php component_class('card card--vertical'); ?>>
    <?php endif; ?>
    <div class="card__inner">
      <?php if (!empty($data['image_id'])) : ?>
        <div class="card__top">
          <?php template('partials/element/image/image', array(
            'id' => $data['image_id']
          )); ?>
        </div>
      <?php endif; ?>
      <?php if ($data['button_style'] == 'blue') : ?>
        <div class="card__bottom blue-link-padding">
      <?php else : ?>
        <div class="card__bottom">
      <?php endif; ?>
        <?php if (!empty($data['subhead'])) : ?>
          <h3 class="card__title"><?= $data['subhead']; ?></h3>
        <?php endif; ?>
        <?= $data['body_copy']; ?>
        <?php if (!empty($data['cta']) && $data['button_style'] == 'blue') : ?>
          <div class="ar-element card__button stack__link">
            <a class="button button--link" href="<?= $data['cta']['url']; ?>"<?php if (!empty($data['cta']['target'])) : ?> target="<?= $data['cta']['target']; ?>"<?php endif; ?>
              data-analytics="<?= $data['subhead']; ?>">
              <span class="button__icon arrow-right--" role="presentation">
                <svg class="icon-svg" title="" role="img">
                    <use xlink:href="#arrow-right"></use>
                </svg>
              </span>
              <span class="button__label"><?= $data['cta']['title']; ?></span>
            </a>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?php if (!empty($data['cta']) && $data['button_style'] == 'yellow') : ?>
      <div class="ar-element button card__button button--hover-icon">
        <span class="button__icon arrow-right--" role="presentation">
          <svg class="icon-svg" title="" role="img">
              <use xlink:href="#arrow-right"></use>
          </svg>
        </span>
        <span class="button__label"><?= $data['cta']['title']; ?></span>
      </div>
    <?php endif; ?>

    <?php if (!empty($data['cta']) && $data['button_style'] == 'yellow') : ?>
</a>
<?php else : ?>
  </div>
<?php endif; ?>
