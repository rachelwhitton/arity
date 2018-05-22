<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Hero C - Generic
  Template Type:      Module
  Description:        Hero module with text
  Last Updated:       09/15/2017
  Since:              1.0.0
*/

?>
<div <?php module_class('hero-c ar-module--no-margin'); ?>>
  <div class="hero-c__block">
    <div class="container">
      <<?= $data['h_el']; ?> class="hero-c__title type2"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
      <?php if(!empty($data['text'])) : ?>
        <div class="hero-c__text">
          <?= $data['text']; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
