<?php
namespace App\Theme;

/*
  Template Name:      Vertical Card
  Template Type:      Component
  Description:        A card is used to apply a container around a related grouping of information and that serves as an entry point to more detailed information.
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

?>
<?php if (!empty($data['cta'])) : ?>
<a href="<?= $data['cta']['url']; ?>"<?php if (!empty($data['cta']['target'])) : ?> target="<?= $data['cta']['target']; ?>"<?php endif; ?> <?php component_class('card card--vertical-stack'); ?>>
<?php else : ?>
<div <?php component_class('card card--vertical-stack'); ?>>
<?php endif; ?>
  <div class="card__inner">
    <?php if (!empty($data['image_id'])) : ?>
      <div class="card__top">
        <?php template('partials/element/image/image', array(
          'id' => $data['image_id']
        )); ?>
      </div>
    <?php endif; ?>
    <div class="card__bottom">
      <?php if (!empty($data['subhead'])) : ?>
        <h3 class="card__title"><?= $data['subhead']; ?></h3>
      <?php endif; ?>
      <?= $data['body_copy']; ?>
      <?php if (!empty($data['cta']) && $data['button'] == 'blue') : ?>
        <div class="ar-element button card__button stack__link button--link">
          <span class="button__icon arrow-right--" role="presentation">
            <svg class="icon-svg" title="" role="img">
                <use xlink:href="#arrow-right"></use>
            </svg>
          </span>
          <span class="button__label"><?= $data['cta']['title']; ?></span>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <?php if (!empty($data['cta']) && $data['button'] == 'yellow') : ?>
    <div class="ar-element button card__button button--hover-icon">
      <span class="button__icon arrow-right--" role="presentation">
        <svg class="icon-svg" title="" role="img">
            <use xlink:href="#arrow-right"></use>
        </svg>
      </span>
      <span class="button__label"><?= $data['cta']['title']; ?></span>
    </div>
  <?php endif; ?>

<?php if (!empty($data['cta'])) : ?>
</a>
<?php else : ?>
</div>
<?php endif; ?>
