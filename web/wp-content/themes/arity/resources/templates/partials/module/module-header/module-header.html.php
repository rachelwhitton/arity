<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Feature Content
  Template Type:      Component
  Description:        Eyebrown, Headline, Copy, CTA Stack
  Last Updated:       08/01/2017
  Since:              1.0.0
*/
?>
<div <?php module_class('module-header'); ?>>
  <div class="container">
    <div class="row">
      <?php if (!empty($data['headline'])) : ?>
        <div class="type3 module-header__headline wide">
          <<?= $data['h_el']; ?> class="module-header__headline-headline"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
