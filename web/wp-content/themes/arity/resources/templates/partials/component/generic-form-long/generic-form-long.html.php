<?php
namespace App\Theme;
var_dump($data);
?>
<?php
/*
  Template Name:      Generic Form Long
  Template Type:      Module
  Description:        long generic form with country selector dropdowns.
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


    <label for="state_code">State/Province</label>
    <select  id="state_code" name="state_code"><option value="">--None--</option>
    <option value="AC">AC</option>
    <option value="AG">AG</option>
    <option value="AG">AG</option>
    <option value="AL">AL</option>
    <option value="AL">AL</option>
    <option value="AK">AK</option>
    <option value="AB">AB</option>
    <option value="AL">AL</option>
    <option value="AP">AP</option>
    <option value="AM">AM</option>
    <option value="AN">AN</option>
    <option value="AN">AN</option>
    <option value="AP">AP</option>
    <option value="34">34</option>
    <option value="AO">AO</option>
    <option value="AR">AR</option>
    <option value="AZ">AZ</option>
    <option value="AR">AR</option>
    <option value="AR">AR</option>
    <option value="AP">AP</option>
    <option value="AS">AS</option>
    <option value="AT">AT</option>
    <option value="ACT">ACT</option>
    <option value="AV">AV</option>
    <option value="BA">BA</option>
    <option value="BC">BC</option>
    <option value="BS">BS</option>
    <option value="BA">BA</option>
    <option value="BT">BT</option>
    <option value="11">11</option>
    <option value="BL">BL</option>
    <option value="BN">BN</option>
    <option value="BG">BG</option>
    <option value="BI">BI</option>
    <option value="BR">BR</option>
    <option value="BO">BO</option>
    <option value="BZ">BZ</option>
    <option value="BS">BS</option>
    <option value="BR">BR</option>
    <option value="BC">BC</option>
    <option value="CA">CA</option>
    <option value="CA">CA</option>
    <option value="CL">CL</option>
    <option value="CM">CM</option>
    <option value="CB">CB</option>
    <option value="CI">CI</option>
    <option value="CW">CW</option>
    <option value="CE">CE</option>
    <option value="CT">CT</option>
    <option value="CZ">CZ</option>
    <option value="CN">CN</option>
    <option value="CE">CE</option>
    <option value="CH">CH</option>
    <option value="CT">CT</option>
    <option value="CS">CS</option>
    <option value="CH">CH</option>
    <option value="CH">CH</option>
    <option value="71">71</option>
    <option value="50">50</option>
    <option value="CE">CE</option>
    <option value="CO">CO</option>
    <option value="CL">CL</option>
    <option value="CO">CO</option>
    <option value="CO">CO</option>
    <option value="CT">CT</option>
    <option value="CO">CO</option>
    <option value="CS">CS</option>
    <option value="CR">CR</option>
    <option value="KR">KR</option>
    <option value="CN">CN</option>
    <option value="DN">DN</option>
    <option value="DD">DD</option>
    <option value="DE">DE</option>
    <option value="DL">DL</option>
    <option value="DC">DC</option>
    <option value="DF">DF</option>
    <option value="DL">DL</option>
    <option value="D">D</option>
    <option value="DG">DG</option>
    <option value="EN">EN</option>
    <option value="ES">ES</option>
    <option value="DF">DF</option>
    <option value="FM">FM</option>
    <option value="FE">FE</option>
    <option value="FI">FI</option>
    <option value="FL">FL</option>
    <option value="FG">FG</option>
    <option value="FC">FC</option>
    <option value="FR">FR</option>
    <option value="35">35</option>
    <option value="G">G</option>
    <option value="62">62</option>
    <option value="GE">GE</option>
    <option value="GA">GA</option>
    <option value="GA">GA</option>
    <option value="GO">GO</option>
    <option value="GO">GO</option>
    <option value="GR">GR</option>
    <option value="GT">GT</option>
    <option value="44">44</option>
    <option value="45">45</option>
    <option value="GR">GR</option>
    <option value="52">52</option>
    <option value="GJ">GJ</option>
    <option value="46">46</option>
    <option value="HR">HR</option>
    <option value="HI">HI</option>
    <option value="13">13</option>
    <option value="23">23</option>
    <option value="41">41</option>
    <option value="HG">HG</option>
    <option value="HP">HP</option>
    <option value="91">91</option>
    <option value="42">42</option>
    <option value="43">43</option>
    <option value="ID">ID</option>
    <option value="IL">IL</option>
    <option value="IM">IM</option>
    <option value="IN">IN</option>
    <option value="IA">IA</option>
    <option value="IS">IS</option>
    <option value="JA">JA</option>
    <option value="JK">JK</option>
    <option value="JH">JH</option>
    <option value="32">32</option>
    <option value="36">36</option>
    <option value="22">22</option>
    <option value="KS">KS</option>
    <option value="KA">KA</option>
    <option value="KY">KY</option>
    <option value="KL">KL</option>
    <option value="KY">KY</option>
    <option value="KE">KE</option>
    <option value="KK">KK</option>
    <option value="AQ">AQ</option>
    <option value="LD">LD</option>
    <option value="LS">LS</option>
    <option value="SP">SP</option>
    <option value="LT">LT</option>
    <option value="LE">LE</option>
    <option value="LC">LC</option>
    <option value="LM">LM</option>
    <option value="21">21</option>
    <option value="LK">LK</option>
    <option value="LI">LI</option>
    <option value="LO">LO</option>
    <option value="LD">LD</option>
    <option value="LA">LA</option>
    <option value="LH">LH</option>
    <option value="LU">LU</option>
    <option value="92">92</option>
    <option value="MC">MC</option>
    <option value="MP">MP</option>
    <option value="MH">MH</option>
    <option value="ME">ME</option>
    <option value="MN">MN</option>
    <option value="MB">MB</option>
    <option value="MN">MN</option>
    <option value="MA">MA</option>
    <option value="MD">MD</option>
    <option value="MS">MS</option>
    <option value="MA">MA</option>
    <option value="MT">MT</option>
    <option value="MT">MT</option>
    <option value="MS">MS</option>
    <option value="MO">MO</option>
    <option value="MH">MH</option>
    <option value="VS">VS</option>
    <option value="ML">ML</option>
    <option value="ME">ME</option>
    <option value="ME">ME</option>
    <option value="MI">MI</option>
    <option value="MI">MI</option>
    <option value="MI">MI</option>
    <option value="MG">MG</option>
    <option value="MN">MN</option>
    <option value="MS">MS</option>
    <option value="MO">MO</option>
    <option value="MZ">MZ</option>
    <option value="MO">MO</option>
    <option value="MN">MN</option>
    <option value="MT">MT</option>
    <option value="MB">MB</option>
    <option value="MO">MO</option>
    <option value="NL">NL</option>
    <option value="NA">NA</option>
    <option value="NA">NA</option>
    <option value="NE">NE</option>
    <option value="15">15</option>
    <option value="NV">NV</option>
    <option value="NB">NB</option>
    <option value="NL">NL</option>
    <option value="NH">NH</option>
    <option value="NJ">NJ</option>
    <option value="NM">NM</option>
    <option value="NSW">NSW</option>
    <option value="NY">NY</option>
    <option value="64">64</option>
    <option value="NC">NC</option>
    <option value="ND">ND</option>
    <option value="NT">NT</option>
    <option value="NT">NT</option>
    <option value="NO">NO</option>
    <option value="NS">NS</option>
    <option value="NL">NL</option>
    <option value="NU">NU</option>
    <option value="NU">NU</option>
    <option value="OA">OA</option>
    <option value="OR">OR</option>
    <option value="OY">OY</option>
    <option value="OG">OG</option>
    <option value="OH">OH</option>
    <option value="OK">OK</option>
    <option value="OT">OT</option>
    <option value="ON">ON</option>
    <option value="OR">OR</option>
    <option value="OR">OR</option>
    <option value="PD">PD</option>
    <option value="PA">PA</option>
    <option value="PA">PA</option>
    <option value="PB">PB</option>
    <option value="PR">PR</option>
    <option value="PR">PR</option>
    <option value="PV">PV</option>
    <option value="PA">PA</option>
    <option value="PE">PE</option>
    <option value="PG">PG</option>
    <option value="PU">PU</option>
    <option value="PE">PE</option>
    <option value="PC">PC</option>
    <option value="PI">PI</option>
    <option value="PI">PI</option>
    <option value="PT">PT</option>
    <option value="PN">PN</option>
    <option value="PZ">PZ</option>
    <option value="PO">PO</option>
    <option value="PE">PE</option>
    <option value="PY">PY</option>
    <option value="PB">PB</option>
    <option value="PB">PB</option>
    <option value="63">63</option>
    <option value="QC">QC</option>
    <option value="QLD">QLD</option>
    <option value="QE">QE</option>
    <option value="QR">QR</option>
    <option value="RG">RG</option>
    <option value="RJ">RJ</option>
    <option value="RA">RA</option>
    <option value="RC">RC</option>
    <option value="RE">RE</option>
    <option value="RI">RI</option>
    <option value="RI">RI</option>
    <option value="RN">RN</option>
    <option value="RJ">RJ</option>
    <option value="RN">RN</option>
    <option value="RS">RS</option>
    <option value="RM">RM</option>
    <option value="RO">RO</option>
    <option value="RR">RR</option>
    <option value="RN">RN</option>
    <option value="RO">RO</option>
    <option value="SA">SA</option>
    <option value="SL">SL</option>
    <option value="SC">SC</option>
    <option value="SP">SP</option>
    <option value="SK">SK</option>
    <option value="SS">SS</option>
    <option value="SV">SV</option>
    <option value="SE">SE</option>
    <option value="61">61</option>
    <option value="37">37</option>
    <option value="31">31</option>
    <option value="14">14</option>
    <option value="51">51</option>
    <option value="SI">SI</option>
    <option value="SK">SK</option>
    <option value="SI">SI</option>
    <option value="SO">SO</option>
    <option value="SO">SO</option>
    <option value="SO">SO</option>
    <option value="SA">SA</option>
    <option value="SC">SC</option>
    <option value="SD">SD</option>
    <option value="SR">SR</option>
    <option value="TB">TB</option>
    <option value="TM">TM</option>
    <option value="TN">TN</option>
    <option value="TA">TA</option>
    <option value="TAS">TAS</option>
    <option value="TN">TN</option>
    <option value="TE">TE</option>
    <option value="TR">TR</option>
    <option value="TX">TX</option>
    <option value="12">12</option>
    <option value="TA">TA</option>
    <option value="TL">TL</option>
    <option value="TO">TO</option>
    <option value="TP">TP</option>
    <option value="TN">TN</option>
    <option value="TV">TV</option>
    <option value="TS">TS</option>
    <option value="TR">TR</option>
    <option value="TO">TO</option>
    <option value="UD">UD</option>
    <option value="UT">UT</option>
    <option value="UT">UT</option>
    <option value="UP">UP</option>
    <option value="VA">VA</option>
    <option value="VE">VE</option>
    <option value="VE">VE</option>
    <option value="VB">VB</option>
    <option value="VC">VC</option>
    <option value="VT">VT</option>
    <option value="VR">VR</option>
    <option value="VV">VV</option>
    <option value="VI">VI</option>
    <option value="VIC">VIC</option>
    <option value="VA">VA</option>
    <option value="VT">VT</option>
    <option value="WA">WA</option>
    <option value="WD">WD</option>
    <option value="WB">WB</option>
    <option value="WA">WA</option>
    <option value="WH">WH</option>
    <option value="WV">WV</option>
    <option value="WX">WX</option>
    <option value="WW">WW</option>
    <option value="WI">WI</option>
    <option value="WY">WY</option>
    <option value="65">65</option>
    <option value="54">54</option>
    <option value="YU">YU</option>
    <option value="YT">YT</option>
    <option value="53">53</option>
    <option value="ZA">ZA</option>
    <option value="33">33</option>
    </select>
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
