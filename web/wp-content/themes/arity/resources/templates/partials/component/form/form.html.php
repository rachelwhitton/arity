<form class="form" action="<?= $data['form_url']; ?>" method="POST">
  <div class="form-group required">
    <label class="form-group-label" for="first_name">First name</label>
    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="" required autofocus>
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
  </div>

  <div class="form-group">
    <label class="form-group-label" for="question1">What industry do you work in?</label>
    <select class="form-control custom-select" name="question1" id="question1">
      <option value="">Select an industry</option>
      <option value="option 1">Option 1</option>
      <option value="option 2">Option 2</option>
      <option value="option 3">Option 3</option>
    </select>
  </div>

  <div class="form-group">
    <label class="form-group-label" for="comments">Comments</label>
    <textarea class="form-control" name="comments" id="comments" rows="3"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
  <div class="g-recaptcha" data-sitekey="6LemsC8UAAAAABhmM91zrsD0Paw7Uxa2MFChpoKY" data-size="invisible" data-badge="inline"></div>
</form>
