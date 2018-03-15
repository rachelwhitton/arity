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

  <div <?php component_class('card card--single'); ?>>
    <div class="card__inner">
        
        <?php if (!empty($data['subhead'])) : ?>
          <h3 class="card__title"><?= $data['subhead']; ?></h3>
        <?php endif; ?>

        <?= $data['body_copy']; ?>

        <?php if ( !empty($data['cta']) ) : ?>
          <div class="ar-element button card__button stack__link button--link">
            <span class="button__icon arrow-right--" role="presentation">
              <svg class="icon-svg" title="" role="img">
                  <use xlink:href="#arrow-right"></use>
              </svg>
            </span>
            <a href="<?= $data['cta']['url']; ?>"<?php if (!empty($data['cta']['target'])) : ?> target="<?= $data['cta']['target']; ?>"<?php endif; ?>
              data-analytics="<?= $data['subhead']; ?>">
              <span class="button__label"><?= $data['cta']['title']; ?></span>
            </a>
          </div>
        <?php endif; ?>
      

    </div>
  </div>

