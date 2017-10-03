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
      <div class="hero-block__header"><?= $data['left_column_headline']; ?></div>
      <div class="hero-block__p type4">
        <?= $data['left_column_body_copy']; ?>
      </div>
    </div>
    <div class="hero-block__right-col">
      <div class="type0 hero-block__cta-headline"><?= $data['right_column_headline']; ?></div>
      <?php $i=0; foreach ($data['right_column_links'] as $cta) : $i++; ?>
        <?php if ($i != 1) : ?><br /><?php endif; ?>
        <?php component('cta', $cta['link']); ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>
