<?php

// Production
if(empty($data['form_url'])) {
  $data['is_salesforce'] = true;
  $data['form_url'] = 'https://login.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
  $data['form_oid'] = '00DG0000000jDz6';

  // Set return url
  global $wp;
  $data['form_return_url'] = home_url( $wp->request );
  $data['form_return_url'] = trailingslashit($data['form_return_url']) . '#thank-you';

  // Testing
  if(!empty(WP_ENV) && WP_ENV != 'production') {
    $data['form_url'] = 'https://test.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
    $data['form_oid'] = '00D3B000000DYQX';
  }
}

$data['use_captcha'] = true;

return $data;