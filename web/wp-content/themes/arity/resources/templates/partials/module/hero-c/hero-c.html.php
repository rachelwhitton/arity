<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Hero C - Generic
  Template Type:      Module
  Description:        Hero module with text
  Last Updated:       09/15/2017
  Since:              1.0.0
*/

?>
<div <?php module_class('hero-c'); ?>>
  <div class="hero-c__block">
    <div class="container">
      <<?= $data['h_el']; ?> class="hero-block__title type2"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
    </div>
  </div>
</div>
