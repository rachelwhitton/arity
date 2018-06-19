<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Action Bar w/ Bkg
  Template Type:      Module
  Description:        Full width bar with text, headline and background image
  Last Updated:       09/15/2017
  Since:              1.1.0
*/

?>
<!-- <div id="action-bar-w-bkg" <?php module_class($data['classes']); ?>>
  <div class="action-bar-w-bkg__block container">
    <div class="action-bar-w-bkg__row">
      <?php if (!empty($data['left_headline']) || !empty($data['left_content'])) : ?>
        <div class="action-bar-w-bkg__content">
          <?php if (!empty($data['left_headline'])) : ?>
            <<?= $data['h_el']; ?> class="action-bar-w-bkg__headline"><?= $data['left_headline']; ?></<?= $data['h_el']; ?>>
          <?php endif; ?>
          <?= $data['left_content']; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <?php if(!empty($data['bkg_image'])) : ?>
    <div class="action-bar-w-bkg__bkg" style="background-image:url('<?= $data['bkg_image']; ?>');"></div>
  <?php endif; ?>
</div> -->

<div id="action-bar-w-bkg" <?php module_class($data['classes']); ?>>
  <div class="container">
    <div class="row">
      <div class="action-bar-w-bkg__col action-bar-w-bkg__content-col">
        <div class="content">
          <?php if (!empty($data['left_headline']) || !empty($data['left_content'])) : ?>
            <?php if (!empty($data['left_headline'])) : ?>
              <<?= $data['h_el']; ?> class="action-bar-w-bkg__headline"><?= $data['left_headline']; ?></<?= $data['h_el']; ?>>
            <?php endif; ?>
            <?= $data['left_content']; ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="action-bar-w-bkg__col action-bar-w-bkg__img-col">
        <?php if(!empty($data['bkg_image'])) : ?>
          <?php template('partials/element/image/image', array(
            'id' => $data['bkg_image_id']
          )); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
