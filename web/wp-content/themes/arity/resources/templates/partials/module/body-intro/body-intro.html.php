<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      1 Column Body Intro
  Template Type:      Module
  Description:        Body Intro block with one column
  Last Updated:       12/05/2017
  Since:              1.2.0
*/

?>
<div <?php module_class('body-intro'); ?>>
  <div class="container body-intro__block--bkg">
    <div class="body-intro__row">
      <div class="body-intro body-eight-column-centered">
        <?php if (!empty($data['headline'])) : ?>
          <<?= $data['h_el']; ?> class="type0 typeBold body-column__headline"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
        <?php endif; ?>
        <?= apply_filters('the_content', $data['content']); ?>
      </div>
    </div>
  </div>
</div>
