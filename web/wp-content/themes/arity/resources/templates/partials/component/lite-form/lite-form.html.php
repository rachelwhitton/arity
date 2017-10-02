<?php

namespace App\Theme;

/*
  Template Name:      Lite Form
  Template Type:      Component
  Description:        Small contact form with only a few fields
  Last Updated:       08/03/2017
  Since:              1.0.0
*/
?>
<div class="ar-component lite-form">
  <form id="form__sms" name="form__sms" class="lite-form-inner" action="https://test.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST">
    <input type=hidden name="oid" value="00Dc0000003vvzq">
    <input id="recordType" name="recordType" type="hidden" value="01216000000WeRH">
    <input name="lead_source" type="hidden" value="Web- Home Page">
    <input name="retURL" type="hidden" value="http://test12345.force.com/aritylead/ArityHomepageThankyou?Sender">
    <input name="debug" type="hidden" value="0">

    <script>
        var onRecaptchaSuccess = function(token) {
          formValidator.onSuccess(token);
        };
    </script>

    <?php if (!empty($data['headline'])) : ?>
      <div class="row">
        <div class="col lite-form-inner__col">
          <div class="type6"><?= $data['headline']; ?></div>
        </div>
      </div>
    <?php endif; ?>

    <div class="row">
      <div class="col lite-form-inner__col">
        <label for="first_name">First Name
                    <span class="required">*</span>&nbsp;&nbsp;
                    <span class="required" id="first_name_required" style="display:none;color:#FA364A;float:right;font-size:14px">Please enter first name</span>
                    <span class="required" id="first_name_valid" style="display:none;color:#FA364A;float:right;font-size:14px">Please enter a valid first name</span>
                  </label>
        <input id="first_name" maxlength="40" name="first_name" onkeyup="formValidator.onChange();" size="20" type="text">
      </div>
    </div>
    <div class="row">
      <div class="col lite-form-inner__col">
        <label for="last_name">Last Name
                      <span class="required">*</span>&nbsp;&nbsp;
                      <span class="required" id="last_name_required" style="display:none;color:#FA364A;float:right;font-size:14px">Please enter last name</span>
                      <span class="required" id="last_name_valid" style="display:none;color:#FA364A;float:right;font-size:14px">Please enter a valid last name</span>
                  </label>
        <input id="last_name" maxlength="80" name="last_name" onkeyup="formValidator.onChange();" size="20" type="text"><br>
      </div>
    </div>
    <div class="row">
      <div class="col lite-form-inner__col">
        <label for="email">Email
            <span class="required">*</span>&nbsp;&nbsp;
            <span class="required" id="email_required" style="display:none;color:#FA364A;float:right;font-size:14px">Please enter email</span>
            <span class="required" id="email_valid" style="display:none;color:#FA364A;float:right;font-size:14px">Please enter a valid email</span>
        </label>
        <input id="email" maxlength="80" name="email" onkeyup="formValidator.onChange();" size="20" type="text"><br>
      </div>
    </div>
    <div class="row">
      <div class="col lite-form-inner__col">
        <label for="phone">Phone&nbsp;&nbsp;<span class="required" id="phone_required" style="display:none;color:#FA364A;float:right; font-size:14px;">Phone is required when preferred method is set to phone</span><span class="required" id="phone_valid" style="display:none;color:#FA364A;float:right;font-size:14px">Please enter a valid phone</span></label>
        <input id="phone" maxlength="40" name="phone" onkeyup="formValidator.onChange();" size="20" type="text"><br>
      </div>
    </div>

    <div class="row">
      <div class="col lite-form-inner__col">
        <button id='submit_btn' class="ar-element button button--primary blue-button--">Submit</button>
        <br />
        <br />
        <div id='recaptcha' class="g-recaptcha" data-sitekey="6LemsC8UAAAAABhmM91zrsD0Paw7Uxa2MFChpoKY" data-callback="onRecaptchaSuccess" data-size="invisible" data-badge="inline"></div>
      </div>
    </div>
  </form>

</div>
