<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Hero B - 2 Column
  Template Type:      Module
  Description:        Hero module with background image and blue block - Two Columns
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

?>
<div <?php module_class('hero-b'); ?>>
  <div class="hero-b__block">
    <div class="container">
    <?php if ($data['--settings_layout'] == 'one-column') : ?>
      <?php component('hero-block-one-column', $data); ?>
    <?php else : ?>
      <?php component('hero-block-two-column', $data); ?>
    <?php endif; ?>
    </div>
  </div>
  <?php component('hero-image', [
    'image_id' => $data['image_id']
  ]); ?>
</div>
