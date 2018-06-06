<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      2 Column Icon
  Template Type:      Module
  Description:        Icon block with two columns
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

?>
<div <?php module_class($data['classes']); ?>>
  <div class="container">
    <?php if (!empty($data['headline'])) : ?>
      <<?= $data['h_el']; ?> class="type0 typeBold body-column__headline icons-headline"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
    <?php endif; ?>
    <div class="row">
      <div class="body-two-column__col half-stack--">
        <?php the_partials($data['left_column']); ?>
      </div>
      <div class="body-two-column__col half-stack--">
        <?php the_partials($data['right_column']); ?>
      </div>
    </div>
  </div>
</div>
