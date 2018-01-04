<?php

// Production
if(empty($data['form_url'])) {
  $data['is_salesforce'] = true;
  $data['form_url'] = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
  $data['form_oid'] = '00Df4000001TyK5';

  // Set return url
  global $wp;
  $data['form_return_url'] = home_url( $wp->request );
  $data['form_return_url'] = trailingslashit($data['form_return_url']) . '#thank-you';

  // Testing
  if(!empty(WP_ENV) && WP_ENV != 'production') {
    $data['form_url'] = 'https://test.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
    $data['form_oid'] = '00D2F0000008zeT';
  }
}

$data['use_captcha'] = false;

// Classes
$data['classes'][] = 'email-form';

if(!empty($data['bkg_color'])) {
  $data['classes'][] = 'email-form--bkg-dark';
}

return $data;
