<?php
namespace App\Theme;
var_dump($data);
?>
<?php
/*
  Template Name:      Geeric Form Long
  Template Type:      Module
  Description:        long generic form with country selector dropdowns.
  Last Updated:       02/02/2018
  Since:              1.5.0
*/
?>

<div <?php module_class($data['classes']); ?>>
  <div class="container">
    <?php if (!empty($data['headline'])) : ?>
    <div class="email-form__title">
      <h3 class="email-form__title__headline"><?= $data['headline']; ?></h3>
    </div>
    <?php endif; ?>
    <div class="email-form__content">
      <?= apply_filters('the_content', $data['description']); ?>
    </div>
    <?php the_partials($data['content']); ?>
  </div>
</div>
