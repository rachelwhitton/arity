<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Text Block Module
  Template Type:      Module
  Description:        Basic text block module
  Last Updated:       02/15/2018
  Since:              1.6.0
*/

?>
<div <?php component_class('text-block'); ?>>
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
        <?php if(!empty($data['content'])) : ?>
          <?= $data['content']; ?>
        <?php endif; ?>

        <?php if(!empty($data['content-center'])) : ?>
          <?= $data['content-center']; ?>
        <?php endif; ?>
      </div>
      
    </div>
  </div>
</div>
