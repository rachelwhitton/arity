<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Text Block - 2 Column Component
  Template Type:      Component
  Description:        Basic 2 column text block component
  Last Updated:       06/13/201
  Since:              2.3.1
*/

?>



<div <?php component_class('text-block-two-column'); ?>>
  <div class="text-block-two-column__block <?= $data['--settings_alignment']; ?>">
    <div class="container">
      <div class="text-block-two-column__header row">
        <div class="col">
        <?php if(!empty($data['eyebrow'])) : ?>
          <?php element('eyebrow', array(
            'classes' => 'eyebrow',
            'label' => $data['eyebrow']
          )); ?>
        <?php endif; ?>
        <?php if(!empty($data['headline'])) : ?>
          <?php element('headline', array(
            'classes' => 'text-block-two-column__headline',
            'headline' => $data['headline']
          )); ?>
        <?php endif; ?>
        </div>
      </div>

      <div class="text-block-two-column__text row">
        <div class="text-block-two-column__text-column">  
          <?php if(!empty($data['left_column_body_copy'])) : ?>
            <?= $data['left_column_body_copy']; ?>
          <?php endif; ?>
        </div>
        <div class="text-block-two-column__text-column">
          <?php if(!empty($data['right_column_body_copy'])) : ?>
            <?= $data['right_column_body_copy']; ?>
          <?php endif; ?>
        </div>
        <?php if(!empty($data['footnote'])) : ?>
            <div class="text-block-two-column__footnote">
            <?= $data['footnote']; ?>
            </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
