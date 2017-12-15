<form action="<?= $data['form_url']; ?>" method="POST">

  <?php if(!empty($data['is_salesforce'])) : ?>
    <input type=hidden name="oid" value="<?= $data['form_oid']; ?>">
    <input type=hidden name="retURL" value="<?= $data['form_return_url']; ?>">
    <input type="hidden" name="lead_source" id="lead_source" value="Arity.com">
  <?php endif; ?>

  <div class="form-group form-group--required">
    <label class="form-group-label" for="first_name">First name</label>
    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="" required>
    <div class="form-control-feedback" data-error="required">Please enter first name</div>
    <div class="form-control-feedback" data-error="invalid">Please enter a valid first name</div>
  </div>

  <div class="form-group form-group--required">
    <label class="form-group-label" for="last_name">Last name</label>
    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="" required>
    <div class="form-control-feedback" data-error="required">Please enter last name</div>
    <div class="form-control-feedback" data-error="invalid">Please enter a valid last name</div>
  </div>

  <div class="form-group form-group--required">
    <label class="form-group-label" for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="" required>
    <div class="form-control-feedback" data-error="required">Please enter email</div>
    <div class="form-control-feedback" data-error="invalid">Please enter a valid email</div>
  </div>

  <div class="form-group">
    <label class="form-group-label" for="company">Company</label>
    <input type="text" class="form-control" name="company" id="company" placeholder="">
  </div>

  <div class="form-group">
    <label class="form-group-label" for="phone">Phone</label>
    <input type="tel" class="form-control" name="phone" id="phone" placeholder="">
    <div class="form-control-feedback" data-error="invalid">Please enter a valid phone</div>

    <?php
      $preferred_id = '00Nf4000009v5NO';
      if(!empty(WP_ENV) && WP_ENV != 'production') {
        // Testing
        $preferred_id = '00N3B000001I8ya';
      }
    ?>
    <div class="form-conditional" aria-hidden="true" data-conditional="phone" data-conditional-logic="not-empty">
      <div class="form-group form-group--inline">
        <label class="form-group-label">I prefer you to:</label>
        <label class="form-group-label" for="<?= $preferred_id; ?>_1">
          <input class="form-control custom-radio conditional-check-when-not-empty" type="radio" name="<?= $preferred_id; ?>" id="<?= $preferred_id; ?>_1" value="Phone" tabindex="-1"> call me
        </label>
        <label class="form-group-label" for="<?= $preferred_id; ?>_2">
          <input class="form-control custom-radio conditional-check-when-empty" type="radio" name="<?= $preferred_id; ?>" id="<?= $preferred_id; ?>_2" value="Email" checked="checked" tabindex="-1"> email me
        </label>
      </div>
    </div>
  </div>

  <?php
    $industry_id = '00Nf4000009v5NK';
    if(!empty(WP_ENV) && WP_ENV != 'production') {
      // Testing
      $industry_id = '00N3B000001I8yV';
    }
  ?>
  <div class="form-group">
    <label class="form-group-label" for="<?=$industry_id; ?>">What industry do you work in?</label>
    <select class="form-control custom-select" name="<?=$industry_id; ?>" id="<?=$industry_id; ?>">
      <option value="">Select an industry</option>
      <option value="Insurance">Insurance</option>
      <option value="OEM">OEM</option>
      <option value="Shared Mobility">Shared Mobility</option>
      <option value="Gig Economy">Gig Economy</option>
      <option value="Auto Aftermarket">Auto Aftermarket</option>
      <option value="Government">Government</option>
      <option value="Other">Other</option>
    </select>
  </div>

  <div class="form-group">
    <label class="form-group-label" for="description">Comments</label>
    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>

  <?php if(!empty($data['use_captcha'])) : ?>
    <div class="g-recaptcha" data-size="invisible" data-badge="inline"></div>
  <?php endif; ?>
</form>
