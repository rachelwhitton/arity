<?php
namespace App\Theme;

/*
  Template Name:      2 Column Body
  Template Type:      Module
  Description:        Body block with two columns
  Last Updated:       08/01/2017
  Since:              1.0.0
*/

?>
<div <?php module_class('body-two-column body-two-column--contact'); ?>>
  <div class="row">
    <div class="body-two-column__col left--">
      <div class="ar-component lite-form">
        <?php if (!empty($data['left_column_headline'])) : ?>
          <div class="row">
            <div class="col lite-form-inner__col">
              <h3 class="lite-form__title type0"><?= $data['left_column_headline']; ?></h3>
            </div>
          </div>
        <?php endif; ?>
        <p>
          <a href="<?= home_url('contact/'); ?>" class="button--primary button ar-element">
              <span class="button__label">Get in touch</span>
          </a>
        </p>
      </div>
    </div>
    <div class="body-two-column__col right--">
      <?php if (!empty($data['right_column_headline'])) : ?>
        <<?= $data['h_el']; ?> class="colors__text--white type0 body-two-column__title hidden-lg-up"><?= $data['right_column_headline']; ?></<?= $data['h_el']; ?>>
      <?php endif; ?>
      <?= $data['right_column_body_copy']; ?>
    </div>
  </div>
</div>
