<?php
namespace App\Theme;
?>
<?php
/*
  Template Name:      Email Form
  Template Type:      Module
  Description:        Email-only form with option to choose two colors.
  Last Updated:       01/03/2018
  Since:              1.4.0
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
      <?= apply_filters('the_content', $data['content']); ?>
    </div>

    <div class="email-form__form">
      <form action="<?= $data['form_url']; ?>" method="POST">
        <div class="form-group form-group--required">
          <label class="form-group-label" for="first_name">First name</label>
          <input type="text" class="form-control" name="first_name" id="first_name" autocapitalize="words" placeholder="" required>
          <div class="form-control-feedback" data-error="required">Please enter first name</div>
          <div class="form-control-feedback" data-error="invalid">Please enter a valid first name</div>
        </div>

        <div class="form-group form-group--required">
          <label class="form-group-label" for="last_name">Last name</label>
          <input type="text" class="form-control" name="last_name" id="last_name" autocapitalize="words" placeholder="" required>
          <div class="form-control-feedback" data-error="required">Please enter last name</div>
          <div class="form-control-feedback" data-error="invalid">Please enter a valid last name</div>
        </div>

        <div class="form-group form-group--required">
          <label class="form-group-label" for="email">Email</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="" required>
          <div class="form-control-feedback" data-error="required">Please enter email</div>
          <div class="form-control-feedback" data-error="invalid">Please enter a valid email</div>
        </div>

        <div class="btn-group">
          <button type="submit" class="button button--primary white-blue-button--">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
