<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Hero D - Generic
  Template Type:      Module
  Description:        Hero module with background image and title
  Last Updated:       11/04/2017
  Since:              1.1.0
*/

?>
<div <?php module_class('hero-d ar-module--no-margin'); ?>>
  <div class="hero-d__block">
    <div class="container">
      <?php if(!empty($data['headline'])) : ?>
        <<?= $data['h_el']; ?> class="hero-d__title"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
      <?php endif; ?>
      <?php if(!empty($data['text'])) : ?>
        <div class="hero-d__text">
          <?= $data['text']; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <?php if(!empty($data['bkg_image'])) : ?>
    <div class="hero-d__bkg" style="background-image:url('<?= $data['bkg_image']; ?>');"></div>
  <?php endif; ?>
</div>
