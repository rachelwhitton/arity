<?php

// Classes
$data['classes'][] = 'promo';

$page_template = get_page_template_slug();
$page_template = strstr($page_template, '-', true);

if ($page_template == 't2a') {
  $data['classes'][] = 'promo--light';
}
// $data['classes'][] = 'promo--light';

return $data;
