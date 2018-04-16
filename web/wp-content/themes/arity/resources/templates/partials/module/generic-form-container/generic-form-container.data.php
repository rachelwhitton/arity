<?php

// Production
if(empty($data['form_url'])) {
  $data['content'][0]['is_salesforce'] = true;
  $data['content'][0]['form_url'] = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
  $data['content'][0]['form_oid'] = '00Df4000001TyK5';

  // Set return url
  global $wp;
  $data['content'][0]['form_return_url'] = home_url( $wp->request );
  $data['content'][0]['form_return_url'] = trailingslashit($data['content'][0]['form_return_url']) . '#thank-you';

  // Testing
  if(!empty(WP_ENV) && WP_ENV != 'production') {
    $data['content'][0]['form_url'] = 'https://test.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
    $data['content'][0]['form_oid'] = '00DW0000008xyd5';
  }
}

// $data['content'][0]['form_url'] = $data['form_url'];
// $data['content'][0]['form_oid'] = $data['form_oid'];
// $data['content'][0]['form_return_url'] = $data['form_return_url'];
// $data['content'][0]['is_salesforce'] = $data['is_salesforce'];

$data['use_captcha'] = false;

// Classes
$data['classes'][] = 'email-form';

if(!empty($data['bkg_color'])) {
  $data['classes'][] = 'email-form--bkg-dark';
}

return $data;
