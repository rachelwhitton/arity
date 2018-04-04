<?php
namespace App\Theme;
?>
<?php
/*
  Template Name:      Generic Form Short
  Template Type:      Module
  Description:        short generic form.
  Last Updated:       02/02/2018
  Since:              1.5.0
*/

  $form_oid = '00Df4000001TyK5';
  if(!empty(WP_ENV) && WP_ENV != 'production') {
    // Testing
    $form_oid = '00Dq0000000CQhG';
  }


?>

<div class="generic-form__wrap generic-form__form">
  <form action="<?= $data['form_url']; ?>" method="POST">

    <div class="form-group form-group-1 form-group--required">
      <label class="form-group-label" for="input_first_name">First name</label>
      <input type="text" class="form-control" name="first_name" id="input_first_name" placeholder="" required>
      <div class="form-control-feedback" data-error="required">Please enter first name</div>
      <div class="form-control-feedback" data-error="invalid">Please enter a valid name</div>
    </div>

    <div class="form-group form-group-2 form-group--required">
      <label class="form-group-label" for="input_last_name">Last name</label>
      <input type="text" class="form-control" name="last_name" id="input_last_name" placeholder="" required>
      <div class="form-control-feedback" data-error="required">Please enter last name</div>
      <div class="form-control-feedback" data-error="invalid">Please enter a valid name</div>
    </div>

    <div class="form-group form-group-3 form-group--required">
      <label class="form-group-label" for="input_email">Email</label>
      <input type="email" class="form-control" name="email" id="input_email" placeholder="" required>
      <div class="form-control-feedback" data-error="required">Please enter email</div>
      <div class="form-control-feedback" data-error="invalid">Please enter a valid email</div>
    </div>

    <div class="form-group form-group-4 form-group--required">
      <label class="form-group-label" for="input_email">Company</label>
      <input type="text" class="form-control" name="company" id="input_company" placeholder="" required>
      <div class="form-control-feedback" data-error="required">Please enter your company</div>
      <div class="form-control-feedback" data-error="invalid">Please enter a valid company</div>
    </div>

    <div class="btn-group">
      <button type="submit" class="button button--primary white-blue-button--">Submit</button>
    </div>

    <?php if(!empty($data['is_salesforce'])) : ?>
      <input type="hidden" name="oid" value="<?= $form_oid; ?>">
      <input type="hidden" name="retURL" value="<?= $data['form_return_url']; ?>">
      <input type="hidden" name="lead_source" value="Arity.com" id="lead_source" />

      <select style="visibility:hidden" id="lead_source" name="lead_source">
        <option selected value="Conference / Trade Show"/>
      </select><br>
    <?php endif; ?>

    <?php if(!empty($data['use_captcha'])) : ?>
      <div class="g-recaptcha" data-size="invisible" data-badge="inline"></div>
    <?php endif; ?>
  </form>
</div>
