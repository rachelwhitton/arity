<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      1 Column Body Intro
  Template Type:      Module
  Description:        Body Intro block with one column
  Last Updated:       12/02/2017
  Since:              1.2.0-alpha.1
*/

?>
<div <?php module_class('body-intro'); ?>>
  <div class="container body-intro__block--bkg">
    <div class="body-intro__row">
      <div class="body-intro__content">
        <div class="body-intro__sub-container">
          <?php if (!empty($data['headline'])) : ?>
            <<?= $data['h_el']; ?> class="type0 typeBold body-column__headline"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
          <?php endif; ?>
          <?= apply_filters('the_content', $data['content']); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div <?php module_class('body-intro__line'); ?>>
  <div class="container line-container">
    <div class="line"></div>
  </div>
</div>
