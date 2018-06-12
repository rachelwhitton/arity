<?php
namespace App\Theme;

/*
  Template Name:      Horizontal Card with Split Background
  Template Type:      Module
  Description:        A horizontal 2 col card with a split background
  Last Updated:       06/12/2018
  Since:              2.2.1
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

            <?php if (!empty($data['location'])) : ?>
              <?= $data['location']; ?>
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

            <div class="promo-card-horizontal__ctas">
              <?php
                if (!empty($data['link_groups'])) :
              ?>
              <?php $i=0; foreach ($data['link_groups'] as $cta) : $i++; if(empty($cta['group']['link'])) continue; ?>
                <?php
                  if ($cta['group']['type'] == 'link'){
                    $a_classes = 'button button--link';
                    $b_classes = 'block_link__text';
                  }else{
                    $a_classes = 'button button--primary blue-button--';
                    $b_classes = '__text';
                  }

                  if (($cta['group']['type'] == 'button') && ($cta['group']['icon'] != 'none')) {
                    $a_classes .= ' has-icon--';
                  }

                  if(isLinkEmail($cta['group']['link']['url']) || $cta['group']['icon'] == "mailto") {
                    $cta['group']['icon'] = 'email';
                  }

                  if (($cta['group']['icon'] != 'external') && ($cta['group']['type'] == 'link')) {
                    $c_classes = 'button__icon';
                  }else{
                    $c_classes = 'button__icon';
                  }

                  if ($cta['group']['type'] == 'link' && $cta['group']['icon'] == 'default'){
                    $cta['group']['icon'] = 'arrow-right';
                  }

                  // if (($cta['group']['icon'] != 'none') && ($cta['group']['icon'] != 'external') && ($cta['group']['icon'] != 'link')) {
                  //   $a_classes .= ' block_link__icon';
                  // }
                ?>
                <p>
                  <a class="<?= $a_classes;?>" href="<?= $cta['group']['link']['url']; ?>"<?php if (!empty($cta['group']['link']['target'])) : ?> target="<?= $cta['group']['link']['target']; ?>"<?php endif; ?>>
                    <?php if($cta['group']['icon'] !='none') : ?>
                      <span class="<?= $c_classes;?>">
                        <svg class="icon-svg" title="" role="img">
                            <use xlink:href="#<?= $cta['group']['icon']; ?>"></use>
                        </svg>
                      </span>
                    <?php endif; ?>
                    <span class="<?= $b_classes;?>"><?= $cta['group']['link']['title']; ?></span>
                  </a>
                </p>
              <?php endforeach; ?>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="split-bg__bottom" style="background-color: <?= $data['bg-color_bot']; ?>"></div>
</div>
