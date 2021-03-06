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


<div <?php module_class($data['classes']); ?>>
  <div class="hero-b__block">
    <div class="container <?= $data['--settings_alignment']; ?>">
    <?php if ($data['--settings_layout'] == 'one-column') : ?>
      <?php component('hero-block-one-column', $data); ?>
    <?php else : ?>
      <?php component('hero-block-two-column', $data); ?>
    <?php endif; ?>
    </div>
  </div>
  <?php if (!empty($data['background-color']) && $data['background-color'] == 'light-gray') : ?>
    <div class="hero-b__block background background__light-gray-bg"></div>
  <?php endif; ?>
  <?php component('hero-image', [
    'image_id' => $data['image_id'],
    'overlay' => $data['dotted']
  ]); ?>
</div>
