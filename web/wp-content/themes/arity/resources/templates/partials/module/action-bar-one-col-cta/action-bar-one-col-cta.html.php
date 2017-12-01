<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Action Bar
  Template Type:      Module
  Description:        Full width bar with side-by-side links
  Last Updated:       09/15/2017
  Since:              1.0.0
*/

?>
<div <?php module_class($data['classes']); ?>>
  <div class="container action-bar-one-col-cta__block--bkg">
    <div class="action-bar-one-col__row">
      <?php if (!empty($data['center_headline']) || !empty($data['center_content'])) : ?>
        <div class="action-bar-one-col-cta__content">
          <<?= $data['h_el']; ?> class="action-bar-one-col-cta__headline"><?= $data['center_headline']; ?></<?= $data['h_el']; ?>>
          <?= $data['center_content']; ?>
          <?php $i=0; foreach ($data['center_links'] as $cta) : $i++; ?>
            <p>
              <?php element('button', array_merge($cta['link'], [
                'classes' => 'button--primary white-blue-border-button--'
              ])); ?>
            </p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
