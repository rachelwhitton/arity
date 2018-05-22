<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Content and Image Block
  Template Type:      Module
  Description:        Product or feature highlight ("River")
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

?>

<div <?php module_class($data['classes']); ?>>
  <?php if (!empty($data['module-headline'])) : ?>
    <div class="container">
      <div class="row">
        <div class="<?= $data['headline-alignment']; ?>">
          <?php if(!empty($data['eyebrow'])) : ?>
            <?php element('eyebrow', array(
              'classes' => 'eyebrow',
              'label' => $data['eyebrow']
            )); ?>
          <?php endif; ?>

          <?php if (!empty($data['module-headline'])) : ?>
            <?php element('headline', array(
            'classes' => 'content-image-block__title',
            'headline' => $data['module-headline']
          )); ?>
          <?php endif; ?>

          <?php if(!empty($data['subhead'])) : ?>
            <div class="block-highlights__subhead">
              <?= $data['subhead']; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
  <div class="container">
    <div class="row">
      <?php if (!empty($data['image_id'])) : ?>
        <div class="content-image-block__col wide-- content-image-block__img-box">
          <?php element('image', [
            'id' => $data['image_id'],
            'classes' => 'img-shadow'
          ]); ?>
        </div>
      <?php endif; ?>
      <div class="content-image-block__col narrow--">
        <div class="content-image-block__col-group">
          <?php if (!empty($data['headline'])) : ?>
            <<?= $data['h_el']; ?> class="content-image-block__headline type3"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
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
              'classes' => 'blue-link content-image-block__arrow-link' ,
              'icon' => 'arrow-right'
            ])); ?>
          </p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
