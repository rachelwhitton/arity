<?php
namespace App\Theme;
?>
<?php
/*
  Template Name:      Email Form
  Template Type:      Module
  Description:        Email-only form with option to choose two colors.
  Last Updated:       12/15/2017
  Since:              1.2.7
*/
?>

<div class="ar-module email-form">
  <div class="container">
    <div class="email-only-container">
      <form action="<?= $data['form_url']; ?>" method="POST">

        <div class="form-group">
          <?php if (!empty($data['headline'])) : ?>
            <label class="form-group-email-only-label" for="email"><?= $data['headline']; ?></label>
          <?php endif; ?>
          <div class="email-only-input">
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address">
            <div class="form-control-feedback" data-error="invalid">Please enter a valid email</div>
          </div>
        </div>
        <div class="email-only-button-group">
          <button type="submit" class="button button--primary white-blue-button-- email-only-button--">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
