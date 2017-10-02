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
      <h1 class="hero-block__title type2"><?= $data['headline']; ?></h1>
    </div>
  </div>
</div>
