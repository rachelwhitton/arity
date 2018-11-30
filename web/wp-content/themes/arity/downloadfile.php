<?php
if ((isset($_ENV['PANTHEON_ENVIRONMENT']) && $_ENV['PANTHEON_ENVIRONMENT'] == 'live') ||(isset($_ENV['PANTHEON_ENVIRONMENT']) && $_ENV['PANTHEON_ENVIRONMENT'] == 'dev')) {
    $json_text = file_get_contents('wp-content/uploads/private/dev.json');
    $stripe_data = json_decode($json_text, TRUE);
    echo '<pre>';print_r($stripe_data);echo '</pre>';  
  }

//echo '<pre>';print_r($_ENV);echo '</pre>';   
?>