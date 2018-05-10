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
<div id="body-two-column" <?php module_class('body-column body-two-column'); ?>>
  <div class="container">
    <?php if (!empty($data['headline'])) : ?>
      <<?= $data['h_el']; ?> class="type0 typeBold body-column__headline"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
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
