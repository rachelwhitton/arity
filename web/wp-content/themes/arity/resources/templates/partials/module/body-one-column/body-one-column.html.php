<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      1 Column Body
  Template Type:      Module
  Description:        Body block with one column
  Last Updated:       09/15/2017
  Since:              1.0.0
*/

?>
<div <?php module_class('body-column body-one-column text-module-advanced'); ?>>
  <div class="container">
    <?php if (!empty($data['headline'])) : ?>
      <<?= $data['h_el']; ?> class="type0 typeBold body-column__headline"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
    <?php endif; ?>
    <div class="row">
      <div class="body-one-column__col default-styles">
        <?= apply_filters('the_content', $data['content']); ?>
      </div>
    </div>
  </div>
</div>
