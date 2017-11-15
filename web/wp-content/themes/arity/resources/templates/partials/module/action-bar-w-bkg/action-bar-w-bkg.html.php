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
<div <?php module_class($data['classes']); ?>>
  <div class="container">
    <div class="action-bar-w-bkg__row">
      <?php if (!empty($data['left_headline']) || !empty($data['left_content'])) : ?>
        <div class="action-bar-w-bkg__left">
          <?php if (!empty($data['left_headline'])) : ?>
            <<?= $data['h_el']; ?> class="action-bar-w-bkg__headline"><?= $data['left_headline']; ?></<?= $data['h_el']; ?>>
          <?php endif; ?>
          <?= $data['left_content']; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <?php if(!empty($data['bkg_image_id'])) : ?>
    <div class="action-bar-w-bkg__bkg">
      <?php element('image', array(
        'id' => $data['bkg_image_id']
      )); ?>
    </div>
  <?php endif; ?>
</div>
