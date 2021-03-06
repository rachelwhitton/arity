<?php
namespace App\Theme;

/*
  Template Name:      Hero Block Two Column
  Template Type:      Component
  Description:        Two column content block within the "Hero B" type module
  Last Updated:       08/02/2017
  Since:              1.0.0
*/

?>
<div <?php component_class('hero-block hero-block--two-col'); ?>>
  <div class="row">
    <div class="hero-block__left-col">
      <<?= $data['h_el']; ?> class="hero-block__header"><?= $data['left_column_headline']; ?></<?= $data['h_el']; ?>>
      <div class="hero-block__p type0">
        <?= $data['left_column_body_copy']; ?>
      </div>
    </div>
    <div class="hero-block__right-col">
      <?php if(!empty($data['--settings_right-column-vertical-alignment']) && $data['--settings_right-column-vertical-alignment'] == 'middle') : ?>
        <div class="align-vertical-middle">
      <?php endif; ?>
      <<?= updateElImportance($data['h_el'], 2); ?> class="hero-block__cta-headline"><?= $data['right_column_headline']; ?></<?= updateElImportance($data['h_el'], 2); ?>>
      <?php if(!empty($data['right_column_links'])) : ?>
        <?php $i=0; foreach ($data['right_column_links'] as $cta) : $i++; ?>
          <p>
            <?php element('button', array_merge($cta['link'], [
              'classes' => 'button--primary blue-button--'
            ])); ?>
          </p>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php if(!empty($data['--settings_right-column-vertical-alignment']) && $data['--settings_right-column-vertical-alignment'] == 'middle') : ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
