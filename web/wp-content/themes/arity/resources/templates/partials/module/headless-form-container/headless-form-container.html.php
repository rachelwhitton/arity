<?php
namespace App\Theme;

?>
<?php
/*
  Template Name:      Contact Form
  Template Type:      Module
  Description:        Contact form
  Last Updated:       11/04/2017
  Since:              1.1.0
*/

?>
<div <?php module_class('contact-form'); ?>>
  <div class="container">
    <div class="contact-form__indicates">
      <span class="required">*</span> indicates required field
    </div>
    <div class="contact-form__wrap">
      <?php component('form'); ?>
    </div>
  </div>
</div>
