<?php

// Production
if(empty($data['form_url'])) {
  // $data['is_salesforce'] = true;
  $data['is_pardot'] = true;
  // $data['form_url'] = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
  $data['form_url'] = 'http://go.pardot.com/l/669483/2018-12-12/5j4';
  $data['form_oid'] = '00Df4000001TyK5';

  // Set return url
  global $wp;
  $data['form_return_url'] = home_url( $wp->request );
  $data['form_return_url'] = trailingslashit($data['form_return_url']) . '#thank-you';

  // Testing
  if(!empty(WP_ENV) && WP_ENV != 'production') {
    // $data['form_url'] = 'https://test.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
    $data['form_url'] = 'http://go.pardot.com/l/669483/2018-12-12/5j4';
    // $data['form_oid'] = '00D3B000000DYQX';
  }

  // Override for test
  // $data['form_url'] = 'http://go.pardot.com/l/669483/2018-12-12/5j4';
  $data['form_url'] = 'http://go.pardot.com/l/669483/2018-12-12/5j4';
  $data['form_oid'] = '00Df4000001TyK5';
}

// $data['use_captcha'] = true;
$data['use_captcha'] = false;

return $data;