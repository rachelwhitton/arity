<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Error Content
  Template Type:      Module
  Description:        Body block for error pages
  Last Updated:       09/21/2017
  Since:              1.0.0
*/
?>
<div <?php module_class('error-content'); ?>>
  <div class="container">
    <div class="row">
      <?php if (!empty($data['headline'])) : ?>
        <div class="error-content__title"><h1 class="error-content__headline"><?= $data['headline']; ?></h1></div>
      <?php endif; ?>
      <div class="error-content__content">
        <?= apply_filters('the_content', $data['content']); ?>
      </div>
    </div>
  </div>
</div>
