<?php
namespace App\Theme;

/*
  Template Name:      2 Column Body
  Template Type:      Module
  Description:        Body block with two columns
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

?>
<div <?php module_class('body-two-column body-two-column--contact'); ?>>
  <div class="row">
    <div class="body-two-column__col left--">
      <?php component('lite-form', [
        'headline' => $data['left_column_headline']
      ]); ?>
    </div>
    <div class="body-two-column__col right--">
      <?php if (!empty($data['right_column_headline'])) : ?>
        <div class="colors__text--white type6 hidden-lg-up"><?= $data['right_column_headline']; ?></div>
      <?php endif; ?>
      <?= $data['right_column_body_copy']; ?>
    </div>
  </div>
</div>
