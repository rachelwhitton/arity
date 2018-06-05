<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Block: Feature solution
  Template Type:      Module
  Description:        Formerly known as feature-solution-block
  Last Updated:       06/05/2018
  Since:              2.1.0
*/

?>
<div <?php module_class('block-feature-solution'); ?>>
  <div class="container">
    <?php if (!empty($data['headline'])) : ?>
      <<?= $data['h_el']; ?> class="block-feature-solution__headline"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
    <?php endif; ?>
    <div class="row">
      <?php foreach ($data['blocks'] as $block) : ?>
        <div class="block-feature-solution__col">
          <?php component('feature-solution', $block['component__feature-solution']); ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
