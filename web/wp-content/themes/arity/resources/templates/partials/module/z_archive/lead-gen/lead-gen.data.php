<?php

if(empty($data['h_el'])) {
  $data['h_el'] = 'h3';
}

// Production
$data['form_url'] = 'https://login.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
if(!empty(WP_ENV) && WP_ENV != 'production') {
  // Testing
  $data['form_url'] = 'https://test.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';
}

// Production
$data['form_oid'] = '00DG0000000jDz6';
if(!empty(WP_ENV) && WP_ENV != 'production') {
  // Testing
  $data['form_oid'] = '00Dc0000003vvzq';
}

return $data;
