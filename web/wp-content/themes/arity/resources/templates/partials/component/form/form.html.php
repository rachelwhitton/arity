<form action="<?= $data['form_url']; ?>" method="POST">

  <?php // if(!empty($data['is_salesforce'])) : ?>
  <?php if(!empty($data['is_pardot'])) : ?>
    <input type=hidden name="oid" value="<?= $data['form_oid']; ?>">
    <input type=hidden name="retURL" value="<?= $data['form_return_url']; ?>">
    <input type="hidden" name="lead_source" id="input_lead_source" value="Arity.com">
  <?php endif; ?>

  <div class="form-group form-group--required">
    <label class="form-group-label" for="input_first_name">First name</label>
    <input type="text" class="form-control" name="first_name" id="input_first_name" placeholder="" required>
    <div class="form-control-feedback" data-error="required">Please enter first name</div>
    <div class="form-control-feedback" data-error="invalid">Please enter a valid name</div>
  </div>

  <div class="form-group form-group--required">
    <label class="form-group-label" for="input_last_name">Last name</label>
    <input type="text" class="form-control" name="last_name" id="input_last_name" placeholder="" required>
    <div class="form-control-feedback" data-error="required">Please enter last name</div>
    <div class="form-control-feedback" data-error="invalid">Please enter a valid name</div>
  </div>

  <div class="form-group form-group--required">
    <label class="form-group-label" for="input_email">Email</label>
    <input type="email" class="form-control" name="email" id="input_email" placeholder="" required>
    <div class="form-control-feedback" data-error="required">Please enter email</div>
    <div class="form-control-feedback" data-error="invalid">Please enter a valid email</div>
  </div>

  <div class="form-group">
    <label class="form-group-label" for="input_company">Company</label>
    <input type="text" class="form-control" name="company" id="input_company" placeholder="">
  </div>

  <div class="form-group">
    <label class="form-group-label" for="input_phone">Phone</label>
    <input type="tel" class="form-control" name="phone" id="input_phone" placeholder="">
    <div class="form-control-feedback" data-error="invalid">Please enter a valid phone</div>

    <?php
      $preferred_id = '00Nf4000009v5NO';
      if(!empty(WP_ENV) && WP_ENV != 'production') {
        // Testing
        // $preferred_id = '00N3B000001I8ya';
        $preferred_id = '00Nf4000009v5NO';
      }
    ?>
    <div class="form-conditional" aria-hidden="true" data-conditional="phone" data-conditional-logic="not-empty">
      <div class="form-group form-group--inline">
        <label class="form-group-label">I prefer you to:</label>
        <label class="form-group-label" for="input_<?= $preferred_id; ?>_1">
          <input class="form-control custom-radio conditional-check-when-not-empty" type="radio" name="<?= $preferred_id; ?>" id="input_<?= $preferred_id; ?>_1" value="Phone" tabindex="-1"> call me
        </label>
        <label class="form-group-label" for="input_<?= $preferred_id; ?>_2">
          <input class="form-control custom-radio conditional-check-when-empty" type="radio" name="<?= $preferred_id; ?>" id="input_<?= $preferred_id; ?>_2" value="Email" checked="checked" tabindex="-1"> email me
        </label>
      </div>
    </div>
  </div>

  <?php
    $industry_id = '00Nf4000009v5NK';
    if(!empty(WP_ENV) && WP_ENV != 'production') {
      // Testing
      // $industry_id = '00N3B000001I8yV';
      $industry_id = '00Nf4000009v5NK';
    }
  ?>
  <div class="form-group form-group--required">
    <label class="form-group-label" for="input_<?=$industry_id; ?>">What industry do you work in?</label>
    <select class="form-control custom-select" name="<?=$industry_id; ?>" id="input_<?=$industry_id; ?>" required>
      <option value="">Select an industry</option>
      <option value="Auto Aftermarket" <?=strtolower($_GET['industry'])=='auto aftermarket'?'selected':''?>>Auto Aftermarket</option>
      <option value="Automotive Solutions" <?=strtolower($_GET['industry'])=='automotive solutions'?'selected':''?>>Automotive Solutions</option>
      <option value="Financial Services" <?=strtolower($_GET['industry'])=='financial services'?'selected':''?>>Financial Services</option>
      <option value="Gig Economy" <?=strtolower($_GET['industry'])=='gig economy'?'selected':''?>>Gig Economy</option>
      <option value="Government" <?=strtolower($_GET['industry'])=='government'?'selected':''?>>Government</option>
      <option value="Insurance" <?=strtolower($_GET['industry'])=='insurance'?'selected':''?>>Insurance</option>
      <option value="OEM" <?=strtolower($_GET['industry'])=='oem'?'selected':''?>>OEM</option>
      <option value="Shared Mobility" <?=strtolower($_GET['industry'])=='shared mobility'?'selected':''?>>Shared Mobility</option>
      <option value="Smart Cities" <?=strtolower($_GET['industry'])=='smart cities'?'selected':''?>>Smart Cities</option>
      <option value="Other" <?=strtolower($_GET['industry'])=='other'?'selected':''?>>Other</option>
    </select>
    <div class="form-control-feedback" data-error="required">Please select an industry</div>
  </div>

  <div class="form-group">
    <label class="form-group-label" for="input_description">Comments</label>
    <textarea class="form-control" name="description" id="input_description" rows="3"></textarea>
  </div>

  <label class="checkbox_container">By checking this box, I am providing express consent to receive marketing communications from Arity at the email address provided.
  <input id="00Nf400000RFoMR" name="00Nf400000RFoMR" type="checkbox" value="1" checked="checked" />
      <span class="checkmark"></span>
  </label>
  
  <button type="submit" class="btn btn-primary">Submit</button>

  <?php if(!empty($data['use_captcha'])) : ?>
    <div class="g-recaptcha" data-size="invisible" data-badge="inline"></div>
  <?php endif; ?>
</form>
