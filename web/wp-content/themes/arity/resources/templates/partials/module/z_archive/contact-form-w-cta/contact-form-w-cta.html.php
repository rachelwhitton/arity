<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Contact Form and CTA
  Template Type:      Module
  Description:        Page block with two columns - Contact Form on left - Stacked CTA on Right
  Last Updated:       08/03/2017
  Since:              1.0.0
*/
?>
<div <?php module_class($data['classes']); ?> id="contact">
  <div class="container">
    <?php if (!empty($data['headline'])) : ?>
      <div class="row">
        <div class="contact-form-with-cta__col wide--">
          <<?= $data['h_el']; ?> class="type3 contact-form-with-cta__headline"><?= $data['headline']; ?></<?= $data['h_el']; ?>>
        </div>
      </div>
    <?php endif; ?>
    <div class="row">
      <div class="contact-form-with-cta__col contact-form-with-cta__col--right">
        <?php component('image-copy-stack', [
          'headline' => $data['right_column_headline'],
          'body_copy' => $data['right_column_body_copy'],
          'image_id' => $data['right_column_image_id'],
          'cta' => $data['right_column_cta']
        ]); ?>
      </div>
      <div class="contact-form-with-cta__col contact-form-with-cta__col--left">
        <?php component('lite-form', [
          'headline' => $data['left_column_headline']
        ]); ?>
      </div>
    </div>
  </div>
</div>
