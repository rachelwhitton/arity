<?php
namespace App\Theme;
?>
<?php
/*
  Template Name:      Accordion
  Template Type:      Module
  Description:        Set of accordion categories in a full-width block.
  Last Updated:       12/07/2017
  Since:              1.2.2
*/
?>
<div class="accordion-wrapper">
  <div class="container accordion-container">
    <div id="accordion" class="accordion" role="tablist">
      <?php if (!empty($data['headline'])) : ?>
        <<?= $data['h_el']; ?> class="accordion-header"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
      <?php endif; ?>
      <div class="items-wrapper">
        <?php foreach ($data['items'] as $item) : ?>
          <?php the_partial($item); ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
