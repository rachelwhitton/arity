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
  <div class="container">
    <div class="action-bar__row">
      <?php if (!empty($data['left_headline']) || !empty($data['left_content'])) : ?>
        <div class="action-bar__left">
          <div class="action-bar__headline"><?= $data['left_headline']; ?></div>
          <?= $data['left_content']; ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($data['right_headline']) || !empty($data['right_content'])) : ?>
        <div class="action-bar__center">&nbsp;</div>
        <div class="action-bar__right">
          <div class="action-bar__headline"><?= $data['right_headline']; ?></div>
          <?= $data['right_content']; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
