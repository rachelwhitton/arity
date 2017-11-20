<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Feature Solution Block
  Template Type:      Module
  Description:
  Last Updated:       08/15/2017
  Since:              1.0.0
*/

?>
<div <?php module_class('feature-solution-block'); ?>>
  <div class="container">
    <?php if (!empty($data['headline'])) : ?>
      <<?= $data['h_el']; ?> class="type0 typeBold feature-solution-block__headline"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
    <?php endif; ?>
    <div class="row">
      <?php foreach ($data['blocks'] as $block) : ?>
        <div class="feature-solution-block__col">
          <?php component('feature-solution', $block['component__feature-solution']); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
