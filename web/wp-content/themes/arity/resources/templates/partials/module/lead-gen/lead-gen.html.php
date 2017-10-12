<?php
namespace App\Theme;

?>
<?php
/*
Template Name:      LeadGen Form
Template Type:      Module
Description:        Page block with long form - Lead Gen
Last Updated:       08/01/2017
Since:              1.0.0
*/

?>
<div <?php module_class('leadgen-form'); ?>>
  <div class="container">
    <div class="leadgen-form__col">
      <?php if (!empty($data['headline'])) : ?>
        <h3><?= $data['headline']; ?></h3>
      <?php endif; ?>

      <form id="app__form__form" name="app__form__form" class="leadgen-form-inner" action="https://test.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST">
        <input type=hidden name="oid" value="00Dc0000003vvzq">
        <input id="recordType" name="recordType" type="hidden" value="01216000000WeRH">
        <input name="lead_source" type="hidden" value="Web- All Other">
        <input name="retURL" type="hidden" value="http://test12345.force.com/aritylead/ArityWebLeadThankyou?Sender">
        <input name="debug" type="hidden" value="0">

        <script>
            var onRecaptchaSuccess = function(token) {
              formValidator.onSuccess(token);
            };
        </script>

        <div class="leadgen-form-inner__row">
          <div class="col leadgen-form-inner__col two-col--">
            <label for="first_name">First Name
              <span class="required">*</span>&nbsp;&nbsp;
              <span class="required" id="first_name_required" style="display:none;color:#FA364A;float:right; font-size:14px;">Please enter first name</span>
              <span class="required" id="first_name_valid" style="display:none;color:#FA364A;float:right;font-size:14px">Please enter a valid first name</span>
            </label>
            <input id="first_name" maxlength="40" name="first_name" onkeyup="formValidator.onChange();" size="20" type="text">
          </div>
          <div class="col leadgen-form-inner__col two-col--">
            <label for="last_name">Last Name
              <span class="required">*</span>&nbsp;&nbsp;
              <span class="required" id="last_name_required" style="display:none;color:#FA364A;float:right; font-size:14px;">Please enter last name</span>
              <span class="required" id="last_name_valid" style="display:none;color:#FA364A;float:right;font-size:14px">Please enter a valid last name</span>
            </label>
            <input id="last_name" maxlength="80" name="last_name" onkeyup="formValidator.onChange();" size="20" type="text"><br>
          </div>
        </div>
        <div class="leadgen-form-inner__row">
          <div class="col leadgen-form-inner__col">
            <label for="company">Company</label>
            <input id="company" maxlength="40" name="company" size="20" type="text">
          </div>
        </div>

        <div class="leadgen-form-inner__row">
          <div class="col leadgen-form-inner__col">
            <label for="email">Email<span class="required">*</span>&nbsp;&nbsp;<span class="required" id="email_required" style="display:none;color:#FA364A;float:right; font-size:14px;">Please enter email</span><span class="required" id="email_valid" style="display:none;color:#FA364A;float:right;font-size:14px">Please enter a valid email</span></label>
            <input id="email" maxlength="80" name="email" onkeyup="formValidator.applyRules();formValidator.onChange();" size="20" type="text"><br>
          </div>
        </div>
        <div class="leadgen-form-inner__row">
          <div class="col leadgen-form-inner__col">
            <label for="phone">Phone&nbsp;&nbsp;<span class="required" id="phone_required" style="display:none;color:#FA364A;float:right; font-size:14px;">Phone is required when preferred method is set to phone</span><span class="required" id="phone_valid" style="display:none;color:#FA364A;float:right;font-size:14px">Please enter a valid phone</span></label>
            <input id="phone" maxlength="40" name="phone" onkeyup="formValidator.applyRules();formValidator.onChange();" size="20" type="text"><br>
          </div>
        </div>

        <div class="leadgen-form-inner__row">
          <div class="col leadgen-form-inner__check-col">
            <label>Industry</label>
          </div>
        </div>
        <div class="leadgen-form-inner__row">
          <div class="col leadgen-form-inner__check-col">
            <span class="checkbox-li"><input id="cb1" name="00N1600000F4WrJ" type="checkbox" value="Insurance"><label class="checkradio" for="cb1"><span></span> Insurance</label>
            </span>
          </div>
          <div class="col leadgen-form-inner__check-col">
            <span class="checkbox-li"><input id="cb2" name="00N1600000F4WrJ" type="checkbox" value="OEM"><label class="checkradio" for="cb2"><span></span> OEM</label>
            </span>
          </div>
          <div class="col leadgen-form-inner__check-col">
            <span class="checkbox-li"><input id="cb3" name="00N1600000F4WrJ" type="checkbox" value="Shared Mobility"><label class="checkradio" for="cb3"><span></span> Shared Mobility</label>
            </span>
          </div>
          <div class="col leadgen-form-inner__check-col">
            <span class="checkbox-li"><input id="cb4" name="00N1600000F4WrJ" type="checkbox" value="Gig Economy"><label class="checkradio" for="cb4"><span></span> Gig Economy</label>
            </span>
          </div>
          <div class="col leadgen-form-inner__check-col">
            <span class="checkbox-li"><input id="cb5" name="00N1600000F4WrJ" type="checkbox" value="Auto Aftermarket"><label class="checkradio" for="cb5"><span></span> Auto Aftermarket</label>
            </span>
          </div>
          <div class="col leadgen-form-inner__check-col">
            <span class="checkbox-li"><input id="cb6" name="00N1600000F4WrJ" type="checkbox" value="Government"><label class="checkradio" for="cb6"><span></span> Government</label>
            </span>
          </div>
          <div class="col leadgen-form-inner__check-col">
            <span class="checkbox-li"><input id="cb7" name="00N1600000F4WrJ" type="checkbox" value="Other"><label class="checkradio" for="cb7"><span></span> Other</label>
            </span>
          </div>
        </div>

        <div class="leadgen-form-inner__row">
          <div class="col leadgen-form-inner__check-col">
            <label>Preferred Method of Contact</label>
          </div>
        </div>

        <div class="leadgen-form-inner__row">

          <div class="col leadgen-form-inner__check-col">
            <span class="radio-li"><input checked="checked" id="r1" name="00N1600000F4WrE" onchange="formValidator.onChange();" type="radio" value="Email"><label class="checkradio" for="r1"><span></span> Email</label>&nbsp;&nbsp;</span>
          </div>
          <div class="col leadgen-form-inner__check-col">
            <span class="radio-li"><input id="r2" name="00N1600000F4WrE" onchange="formValidator.onChange();" type="radio" value="Phone"><label class="checkradio" for="r2"><span></span> Phone</label>&nbsp;&nbsp;</span>
          </div>
          <div class="col leadgen-form-inner__check-col">
            <span class="radio-li"><input id="r3" name="00N1600000F4WrE" onchange="formValidator.onChange();" type="radio" value="No Preference"><label class="checkradio" for="r3"><span></span> No Preference</label>
            </span>
          </div>
        </div>

        <div class="leadgen-form-inner__row">
          <div class="col leadgen-form-inner__check-col">
            <button id='submit_btn' class="submit-btn">Submit</button>
            <br /><br />
            <div id='recaptcha' class="g-recaptcha" data-sitekey="6LemsC8UAAAAABhmM91zrsD0Paw7Uxa2MFChpoKY" data-callback="onRecaptchaSuccess" data-size="invisible" data-badge="inline"></div>
          </div>
        </div>

      </form>

    </div>

  </div>
</div>
