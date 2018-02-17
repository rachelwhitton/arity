<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Text Block Module
  Template Type:      Module
  Description:        Basic text block module
  Last Updated:       09/15/2017
  Since:              1.0.0
*/

?>
<div <?php module_class('text-block'); ?>>
  <div class="text-block__block <?= $data['--settings_alignment']; ?>">
    <div class="container">
      <?php if(!empty($data['eyebrow'])) : ?>
        <?php element('eyebrow', array(
          'classes' => 'eyebrow',
          'label' => $data['eyebrow']
        )); ?>
      <?php endif; ?>
      <?php if(!empty($data['headline'])) : ?>
        <?php element('headline', array(
          'classes' => 'text-block__title',
          'headline' => $data['headline'],
          'h-size' => $data['h-size']
        )); ?>
      <?php endif; ?>

      <div class="text-block__text">
        <?= $data['content']; ?>
      </div>
      
    </div>
  </div>
</div>
