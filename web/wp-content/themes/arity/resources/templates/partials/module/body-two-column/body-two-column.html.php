<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      2 Column Body
  Template Type:      Module
  Description:        Body block with two columns
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

?>
<div <?php module_class('body-column body-two-column'); ?>>
  <div class="container">
    <?php if (!empty($data['headline'])) : ?>
      <div class="type4 typeBold body-column__headline"><?= $data['headline']; ?></div>
    <?php endif; ?>
    <div class="row">
      <div class="body-two-column__col left--">
        <?php the_partials($data['left_column']); ?>
      </div>
      <div class="body-two-column__col right--">
        <?php the_partials($data['right_column']); ?>
      </div>
    </div>
  </div>
</div>
