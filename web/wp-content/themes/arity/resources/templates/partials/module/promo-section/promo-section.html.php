<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Promo Section
  Template Type:      Module
  Description:        Product or feature highlight ("River")
  Last Updated:       02/28/2018
  Since:              1.6.4
*/

?>

<div <?php module_class('promo-section'); ?> style="background-color:<?= $data['bkg_color']; ?>">
  <div class="container">
    <div class="row">
      <?php if (!empty($data['image_id'])) : ?>
        <div class="promo-section__col wide-- content-image-block__img-box">
          <?php element('image', [
            'id' => $data['image_id']
          ]); ?>
        </div>
      <?php endif; ?>
      <div class="promo-section__col narrow--">
        <div class="promo-section__col-group">
          <?php if (!empty($data['headline'])) : ?>
            <?php element('headline', array(
            'classes' => 'promo-section__title',
            'headline' => $data['headline']
          )); ?>
          <?php endif; ?>
          <?php if (!empty($data['body_copy'])) : ?>
          <div class="type0">
            <?= apply_filters('the_content', $data['body_copy']); ?>
          </div>
          <?php endif; ?>
          <?php if (!empty($data['cta'])) : ?>
          <?php $data['cta']['analytics'] = $data['headline']; ?>
          <p>
            <?php element('button', array_merge($data['cta'], [
              'classes' => 'button--primary promo-section__arrow-link' ,
              'icon' => 'arrow-right'
            ])); ?>
          </p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
