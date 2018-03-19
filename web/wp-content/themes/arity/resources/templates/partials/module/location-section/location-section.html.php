<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Location Section
  Template Type:      Module
  Description:        Location module (based off promo section)
  Last Updated:       03/14/2018
  Since:              1.6.4
*/

?>

<div <?php module_class($data['classes']); ?>>
  <div class="container">
    <div class="row">
      <div class="location-section__col anim-ready anim-block-1 narrow--">
        <div class="location-section__col-group">
          <?php if(!empty($data['eyebrow'])) : ?>
            <?php element('eyebrow', array(
              'classes' => 'eyebrow',
              'label' => $data['eyebrow']
            )); ?>
          <?php endif; ?>

          <?php if (!empty($data['headline'])) : ?>
            <?php element('headline', array(
            'classes' => 'location-section__title',
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
          <?php element('button', array_merge($data['cta'], [
              'classes' => 'button--primary'
            ])); ?>
          <?php endif; ?>
        </div>
      </div>

      <?php if (!empty($data['image_id'])) : ?>
        <div class="location-section__col anim-ready anim-block-2 wide-- location-section__img-box">
          <?php element('image', [
            'id' => $data['image_id']
          ]); ?>

          <a href="<?= $data['location-link']; ?>" target="_blank" class="address__block" role="presentation" title="">
            <span class="address__linktext"> <?= $data['location']; ?> </span>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
