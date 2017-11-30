<?php if(!empty($data['is_salesforce'])) : ?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
 function timestamp() { var response = document.getElementById("g-recaptcha-response"); if (response == null || response.value.trim() == "") {var elems = JSON.parse(document.getElementsByName("captcha_settings")[0].value);elems["ts"] = JSON.stringify(new Date().getTime());document.getElementsByName("captcha_settings")[0].value = JSON.stringify(elems); } } setInterval(timestamp, 500);
</script>
<?php endif; ?>

<form action="<?= $data['form_url']; ?>" method="POST">

  <?php if(!empty($data['is_salesforce'])) : ?>
    <input type=hidden name='captcha_settings' value='{"keyname":"Arity_reCAPTCHA","fallback":"true","orgId":"<?= $data['form_oid']; ?>","ts":""}'>
    <input type=hidden name="oid" value="<?= $data['form_oid']; ?>">
    <input type=hidden name="retURL" value="<?= $data['form_return_url']; ?>">
    <input type="hidden" name="lead_source" id="lead_source" value="Arity.com">
  <?php endif; ?>

  <div class="form-group required">
    <label class="form-group-label" for="first_name">First name</label>
    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="" required>
    <div class="form-group-feedback"></div>
  </div>

  <div class="form-group required">
    <label class="form-group-label" for="last_name">Last name</label>
    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="" required>
  </div>

  <div class="form-group required">
    <label class="form-group-label" for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="" required>
  </div>

  <div class="form-group">
    <label class="form-group-label" for="company">Company</label>
    <input type="text" class="form-control" name="company" id="company" placeholder="">
  </div>

  <div class="form-group">
    <label class="form-group-label" for="phone">Phone</label>
    <input type="tel" class="form-control" name="phone" id="phone" placeholder="">

    <div class="form-check form-check-inline hidden-conditional" id="preferred-method" aria-hidden="true">
      <label class="form-check-label">I prefer you to:</label>
      <label class="form-check-label">
        <input class="form-check-input" type="radio" name="00N3B000001I8ya" id="00N3B000001I8ya_1" value="Phone" tabindex="-1"> call me
      </label>
      <label class="form-check-label">
        <input class="form-check-input" type="radio" name="00N3B000001I8ya" id="00N3B000001I8ya_2" value="Email" checked="checked" tabindex="-1"> email me
      </label>
    </div>
  </div>

  <div class="form-group">
    <label class="form-group-label" for="00N3B000001I8yV">What industry do you work in?</label>
    <select class="form-control custom-select" name="00N3B000001I8yV" id="00N3B000001I8yV">
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
    <label class="form-group-label" for="comments">Comments</label>
    <textarea class="form-control" name="comments" id="comments" rows="3"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>

  <?php if(!empty($data['use_captcha'])) : ?>
    <div class="g-recaptcha" data-sitekey="6LemsC8UAAAAABhmM91zrsD0Paw7Uxa2MFChpoKY"></div>
    <?php /* <div class="g-recaptcha" data-sitekey="6LemsC8UAAAAABhmM91zrsD0Paw7Uxa2MFChpoKY" data-size="invisible" data-badge="inline"></div> */ ?>
  <?php endif; ?>
</form>
