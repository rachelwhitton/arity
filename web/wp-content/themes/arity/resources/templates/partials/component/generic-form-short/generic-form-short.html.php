<?php
namespace App\Theme;
?>
<?php
/*
  Template Name:      Smart City Form
  Template Type:      Module
  Description:        smart-city form with option to choose two colors.
  Last Updated:       02/02/2018
  Since:              1.5.0
*/
?>

<div class="email-form__form">
  <form action="<?= $data['form_url']; ?>" method="POST">
    <?php if(!empty($data['is_salesforce'])) : ?>
      <input type="hidden" name="oid" value="<?= $data['form_oid']; ?>">
      <input type="hidden" name="retURL" value="<?= $data['form_return_url']; ?>">
      <input type="hidden" name="lead_source" value="Arity.com" id="lead_source" />
    <?php endif; ?>

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
    <?php
      $interested_id = '00Nf4000009v5NK';
      if(!empty(WP_ENV) && WP_ENV != 'production') {
        // Testing
        $interested_id = '00Nf4000009v5NK';
      }
    ?>

    <select style="visibility:hidden" type="hidden" id="<?=$interested_id; ?>" multiple="multiple" name="<?=$interested_id; ?>" title="Interested In">
      <option selected value="Government"/>
      <option selected value="Smart Cities"/>
    </select>

    <div class="btn-group">
      <button type="submit" class="button button--primary white-blue-button--">Submit</button>
    </div>

    <?php if(!empty($data['use_captcha'])) : ?>
      <div class="g-recaptcha" data-size="invisible" data-badge="inline"></div>
    <?php endif; ?>
  </form>
</div>
